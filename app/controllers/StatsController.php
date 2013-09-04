<?php

class StatsController extends BaseController {

	public function getIndex()
	{
		return View::make('stats');
	}

	public function getDiaper()
	{
		$oneWeekAgo = new DateTime;
		$oneWeekAgo->sub(new DateInterval('P7D'));

		$feedType = EventType::where('name', 'Diaper')->firstOrFail();
		$diaperChanges = $feedType
			->events()
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

		return Response::json(array(
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
		));
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
