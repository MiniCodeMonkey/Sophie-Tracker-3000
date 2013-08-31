<?php

class TrackController extends BaseController {

	public function postNew()
	{
		// Make sure that the event type is valid
		$eventType = EventType::where('name', Input::get('type'))->firstOrFail();

		// Create new event
		$event = new TrackerEvent;
		$event->type_id = $eventType->id;
		$event->subtype = Input::get('subtype');
		$event->value = Input::get('value');
		$event->created_at = new DateTime;
		$event->updated_at = new DateTime;
		$eventType->events()->save($event);

		return Response::json(array('success' => true));
	}

	public function getStats()
	{
		$result = array();
		$eventTypeNames = array('Feed', 'Pump', 'Diaper');

		foreach ($eventTypeNames as $eventTypeName) {
			$feedType = EventType::where('name', $eventTypeName)->firstOrFail();
			$last = $feedType->events()->orderBy('created_at', 'DESC')->first();

			$result[strtolower($eventTypeName)] = array(
				'time' => formatDateDiff($last->created_at),
				'type' => $last->subtype,
				'value' => $last->value
			);
		}

		return Response::json($result);
	}

	public function getList()
	{
		$events = TrackerEvent::orderBy('created_at', 'DESC')->take(40)->get();
		$list = array();

		foreach ($events as $event) {
			$list[] = array(
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

		return Response::json($list);
	}

}
