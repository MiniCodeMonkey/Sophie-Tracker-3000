<?php

class StatsController extends BaseController {

	public function getIndex()
	{
		return View::make('stats');
	}

	public function getUpdate()
	{
		return Response::json(array(
			'diaper_graph' => $this->diaperGraph(),
			'diaper_stats' => $this->diaperStats(),
			'last_fed' => $this->lastFed()
		));
	}

	private function diaperGraph()
	{
		$oneWeekAgo = new DateTime;
		$oneWeekAgo->sub(new DateInterval('P7D'));

		$feedType = EventType::where('name', 'Diaper')->firstOrFail();
		$diaperChanges = $feedType->events()
			->select(DB::raw('DATE(created_at) AS date, COUNT(*) AS count, subtype'))
			->where('created_at', '>', $oneWeekAgo)
			->orderBy('created_at', 'ASC')
			->groupBy(DB::raw('DATE(created_at), subtype'))
			->get();

		$labels = array();
		foreach ($diaperChanges as $day) {
			$today = new DateTime;
			$yesterday = new DateTime;
			$yesterday->sub(new DateInterval('PT24H'));

			$datetime = new DateTime($day->date);
			if ($datetime->format('Y-m-d') == $today->format('Y-m-d')) {
				$formattedDate = 'Today';
			} elseif ($datetime->format('Y-m-d') == $yesterday->format('Y-m-d')) {
				$formattedDate = 'Yesterday';
			} else {
				$formattedDate = $datetime->format('l');
			}

			if (!in_array($formattedDate, $labels)) {
				$labels[] = $formattedDate;
			}

			$data[$day->subtype][$formattedDate] = $day->count;
		}

		return array(
			'labels' => $labels,
			'datasets' => array(
				array(
					'fillColor' => 'rgba(255,255,255,0.1)',
					'strokeColor' => 'rgba(255,255,255,1.0)',
					'pointColor' => 'rgba(255,255,255,1.0)',
					'pointStrokeColor' => '#FFF',
					'data' => $this->constructData($labels, array($data['wet'], $data['dirty'], $data['both']))
				),
				array(
					'fillColor' => 'rgba(255,255,255,0.5)',
					'strokeColor' => 'rgba(255,255,255,1.0)',
					'pointColor' => 'rgba(255,255,255,1.0)',
					'pointStrokeColor' => '#FFF',
					'data' => $this->constructData($labels, $data['wet'])
				),
				array(
					'fillColor' => 'rgba(255,255,255,0.5)',
					'strokeColor' => 'rgba(255,255,255,1.0)',
					'pointColor' => 'rgba(255,255,255,1.0)',
					'pointStrokeColor' => '#FFF',
					'data' => $this->constructData($labels, $data['dirty'])
				),
				array(
					'fillColor' => 'rgba(255,255,255,0.5)',
					'strokeColor' => 'rgba(255,255,255,1.0)',
					'pointColor' => 'rgba(255,255,255,1.0)',
					'pointStrokeColor' => '#FFF',
					'data' => $this->constructData($labels, $data['both'])
				)
			)
		);
	}


	private function diaperStats()
	{
		// Find available diapers
		$supplies = EventType::where('name', 'Supplies')->firstOrFail();
		$diapersPurchased = $supplies->events()
			->where('subtype', 'diaper')
			->sum('value');

		// Find used diapers
		$diapers = EventType::where('name', 'Diaper')->firstOrFail();
		$diapersUsed = $diapers->events()
			->count();

		// Calculate available diapers
		$diapersAvailable = $diapersPurchased - $diapersUsed;

		// Find average used diapers last 24 hours
		$twoDaysAgo = new DateTime;
		$twoDaysAgo->sub(new DateInterval('PT48H'));

		$diapers = EventType::where('name', 'Diaper')->firstOrFail();
		$averageUsed = $diapers->events()
			->where('created_at', '>', $twoDaysAgo)
			->count();

		$diapersPerHour = $averageUsed / 48;

		$runOutDate = new DateTime;
		$runOutDate->add(new DateInterval('PT'. floor($diapersAvailable / $diapersPerHour) .'H'));

		// Return data
		if ($diapersPurchased) {
			return array(
				'available' => $diapersAvailable,
				'used_per_day' => $diapersPerHour * 24,
				'run_out' => array(
					'date' => $runOutDate->format('F j, Y'),
					'days' => $runOutDate->diff(new DateTime)->d
				)
			);
		} else {
			return array();
		}
	}

	private function lastFed()
	{
		$feedType = EventType::where('name', 'Feed')->firstOrFail();
		$last = $feedType->events()
			->orderBy('created_at', 'DESC')
			->first();

		if (!is_null($last)) {
			$icons = array(
				'left' => 'icon-arrow-left',
				'right' => 'icon-arrow-right',
				'pumped' => 'icon-tint',
				'formula' => 'icon-magic'
			);

			$icon = $icons[$last->subtype];
		}

		return array(
			'time' => is_null($last) ? '' : formatDateDiff($last->created_at),
			'type' => is_null($last) ? '' : $last->subtype,
			'value' => is_null($last) ? '' : $last->value,
			'icon' => $icon
		);
	}

	private function constructData($labels, $data) {
		$result = array();

		foreach ($labels as $label) {
			$sum = 0;

			if (!isAssoc($data)) {
				foreach ($data as $entry) {
				if (isset($entry[$label])) {
						$sum += $entry[$label];
					}
				}
			} else {
				if (isset($data[$label])) {
					$sum = $data[$label];
				}
			}

			$result[] = $sum;
		}

		return $result;
 	}

}
