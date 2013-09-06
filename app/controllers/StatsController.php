<?php

class StatsController extends BaseController {

	public function getIndex()
	{
		return View::make('stats');
	}

	public function getUpdate()
	{
		$profile = $this->profile();
		return Response::json(array(
			'profile' => $profile,
			'diaper_graph' => $this->diaperGraph(),
			'diaper_stats' => $this->diaperStats(),
			'last_fed' => $this->lastFed(),
			'feed_time' => $this->feedTime(),
			'day_chart' => $this->dayChart($profile['sleeping']),
		));
	}

	private function profile()
	{
		$now = new DateTime;
		$last = array();
		$eventTypeNames = array('Bath', 'Feed', 'Diaper', 'Sleep');

		foreach ($eventTypeNames as $eventTypeName) {
			$lastEntry = EventType::where('name', $eventTypeName)
				->firstOrFail()
				->events()
				->orderBy('created_at', 'DESC')
				->first();

			$last[strtolower($eventTypeName)] = array(
				'timestamp' => is_null($lastEntry) ? 0 : $lastEntry->created_at->getTimestamp(),
				'time' => is_null($lastEntry) ? '' : formatDateDiff($lastEntry->created_at),
				'type' => is_null($lastEntry) ? '' : $lastEntry->subtype,
				'value' => is_null($lastEntry) ? '' : $lastEntry->value
			);
		}

		return array(
			'age' => formatAge(new DateTime('2013-08-20 20:59:00')),
			'sleeping' => ($last['sleep']['type'] == 'start'),
			'attributes' => array(
				'hygiene' => 1.0 - (($now->getTimestamp() - $last['bath']['timestamp']) / 3600 / 240),
				'hunger' => 1.0 - (($now->getTimestamp() - $last['feed']['timestamp']) / 3600 / 20),
				'bladder' => 1.0 - (($now->getTimestamp() - $last['diaper']['timestamp']) / 3600 / 10),
				'energy' => 1.0 - (($now->getTimestamp() - $last['sleep']['timestamp']) / 3600 / 8),
			)
		);
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
					'fillColor' => 'rgba(255,255,255,0.0)',
					'strokeColor' => 'rgba(255,255,255,1.0)',
					'pointColor' => 'rgba(255,255,255,1.0)',
					'pointStrokeColor' => '#FFF',
					'data' => $this->constructData($labels, array($data['wet'], $data['dirty'], $data['both']))
				),
				array(
					'fillColor' => 'rgba(200,200,200,0.0)',
					'strokeColor' => 'rgba(200,200,200,1.0)',
					'pointColor' => 'rgba(200,200,200,1.0)',
					'pointStrokeColor' => '#FFF',
					'data' => $this->constructData($labels, $data['wet'])
				),
				array(
					'fillColor' => 'rgba(110,110,110,0.0)',
					'strokeColor' => 'rgba(110,110,110,1.0)',
					'pointColor' => 'rgba(110,110,110,1.0)',
					'pointStrokeColor' => '#FFF',
					'data' => $this->constructData($labels, $data['dirty'])
				),
				array(
					'fillColor' => 'rgba(50,50,50,0.0)',
					'strokeColor' => 'rgba(50,50,50,1.0)',
					'pointColor' => 'rgba(50,50,50,1.0)',
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

		// Find average used diapers last 48 hours
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
			'formatted_time' => is_null($last) ? '' : formatDateDiff($last->created_at),
			'timestamp' => is_null($last) ? '' : $last->created_at,
			'type' => is_null($last) ? '' : $last->subtype,
			'value' => is_null($last) ? '' : $last->value,
			'icon' => $icon
		);
	}

	private function feedTime()
	{
		// Find all feedings for last 24 hours
		$oneDayAgo = new DateTime;
		$oneDayAgo->sub(new DateInterval('PT24H'));

		$feed = EventType::where('name', 'Feed')->firstOrFail();
		$feedings = $feed->events()
			->where('created_at', '>', $oneDayAgo)
			->orderBy('created_at', 'ASC')
			->get();

		$timeBetween = array();
		$previous = NULL;
		foreach ($feedings as $feeding) {
			if (is_null($previous)) {
				$previous = $feeding;
			} else {
				$timeBetween[] = $feeding->created_at->getTimestamp() - $previous->created_at->getTimestamp();
				$previous = $feeding;
			}
		}

		$average_diff = array_sum($timeBetween) / count($timeBetween);

		$nextFeed = $previous->created_at->add(new DateInterval('PT'. ceil($average_diff) .'S'));

		return array(
			'average_diff' => $average_diff / 3600,
			'next_feed' => $nextFeed,
			'next_feed_formatted' => ($nextFeed < new DateTime) ? 'soon' : formatDateDiff($nextFeed)
		);
	}

	private function dayChart($isSleeping)
	{
		$start = new DateTime('today midnight');
		$end = clone $start;
		$end->add(new DateInterval('PT24H'));

		$events = TrackerEvent::where('created_at', '>', $start)
			->orderBy('created_at', 'ASC')
			->get();

		$result = array();
		foreach ($events as $event) {
			$percent = ($event->created_at->getTimestamp() - $start->getTimestamp()) / (3600 * 24);

			if ($event->type->name == 'Sleep' && $event->subtype == 'end') {
				// Find last sleep start and update the the width
				for ($i = count($result) - 1; $i > 0; $i--) {
					if ($result[$i]['type'] == 'Sleep' && $result[$i]['subtype'] == 'start') {
						$percent = ($event->created_at->getTimestamp() - $result[$i]['timestamp']) / (3600 * 24);
						$result[$i]['width'] = $percent;
						$result[$i]['value'] = floor(($event->created_at->getTimestamp() - $result[$i]['timestamp']) / 60);
						break;
					} 
				}
			} else {
				$width = 0.01;

				if ($event->type->name == 'Feed') {
					if ($event->subtype == 'left' || $event->subtype == 'right') {
						$width = 0.005 * ($event->value / 8);
					} else {
						$width = 0.005 * $event->value;
					}
				}
				$result[] = array(
					'type' => $event->type->name,
					'timestamp' => $event->created_at->getTimestamp(),
					'time' => $event->created_at->format('g:ia'),
					'time_percent' => $percent,
					'width' => $width,
					'subtype' => $event->subtype,
					'value' => $event->value
				);
			}
		}

		// If sleeping, set last "start" sleep to end at current timestamp in the output
		if ($isSleeping) {
			// Find last sleep start and update the the width
			$now = new DateTime;
			for ($i = count($result) - 1; $i > 0; $i--) {
				if ($result[$i]['type'] == 'Sleep' && $result[$i]['subtype'] == 'start') {
					$percent = ($now->getTimestamp() - $result[$i]['timestamp']) / (3600 * 24);
					$result[$i]['width'] = $percent;
					break;
				} 
			}
		}

		return $result;
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
