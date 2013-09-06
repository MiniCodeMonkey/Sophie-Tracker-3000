<?php

class TrackController extends BaseController {

	public function postNew()
	{
		// Make sure that the event type is valid
		$eventType = EventType::where('name', Input::get('type'))->firstOrFail();

		$subtype = Input::get('subtype');
		$value = Input::get('value');

		if ($eventType->name == 'Sleep') {
			$lastSleepEvent = $eventType->events()
				->orderBy('created_at', 'DESC')
				->first();

			if ($lastSleepEvent && $lastSleepEvent->subtype == 'start') {
				$subtype = 'end';
			} else {
				$subtype = 'start';
			}
		}

		// Create new event
		$event = new TrackerEvent;
		$event->subtype = $subtype;
		$event->value = $value;
		$event->created_at = new DateTime;
		$event->updated_at = new DateTime;
		$eventType->events()->save($event);

		return Response::json(array(
			'success' => true,
			'event' => $this->formatEvent($event)
		));
	}

	public function postDelete()
	{
		// Fetch event
		$event = TrackerEvent::findOrFail(Input::get('id'));

		$response = array(
			'success' => true,
			'event' => $this->formatEvent($event, true)
		);

		// Delete event
		$event->delete();

		return Response::json($response);
	}

	public function postUpdate()
	{
		// Fetch event
		$event = TrackerEvent::findOrFail(Input::get('id'));
		$newCreatedAt = $event->created_at->sub(new DateInterval('PT' . Input::get('minutes') . 'M'));
		$event->created_at = $newCreatedAt;
		$event->save();

		$response = array(
			'success' => true,
			'event' => $this->formatEvent($event, true)
		);

		return Response::json($response);
	}

	public function getStats()
	{
		$result = array();
		$eventTypeNames = array('Feed', 'Pump', 'Diaper', 'Sleep');

		foreach ($eventTypeNames as $eventTypeName) {
			$feedType = EventType::where('name', $eventTypeName)->firstOrFail();
			$last = $feedType->events()->orderBy('created_at', 'DESC')->first();

			$result[strtolower($eventTypeName)] = array(
				'time' => is_null($last) ? '' : formatDateDiff($last->created_at),
				'type' => is_null($last) ? '' : $last->subtype,
				'value' => is_null($last) ? '' : $last->value
			);
		}

		return Response::json($result);
	}

	public function getList()
	{
		$events = TrackerEvent::orderBy('created_at', 'DESC')->take(40)->get();
		$list = array();

		foreach ($events as $event) {
			$list[] = $this->formatEvent($event);
		}

		return Response::json($list);
	}

	private function formatEvent($event, $reverted = false) {
		return array(
			'id' => $event->id,
			'reverted' => $reverted,
			'type' => array(
				'name' => $event->type->name,
				'icon' => $event->type->icon,
				'color_name' => $event->type->color_name,
				'is_primary' => $event->type->is_primary
			),
			'time' => $event->created_at->format('l m/d/y g:ia'),
			'subtype' => $event->subtype,
			'value' => $event->value
		);
	}

}
