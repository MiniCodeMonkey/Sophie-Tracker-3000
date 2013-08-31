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
		$feedType = EventType::where('name', 'Feed')->firstOrFail();
		$lastFeed = $feedType->events()->orderBy('created_at', 'DESC')->first();

		return Response::json(array(
			'last_feed' => array(
				'time' => formatDateDiff($lastFeed->created_at),
				'type' => $lastFeed->subtype,
				'value' => $lastFeed->value
			)
		));
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
				'time' => $event->created_at,
				'subtype' => $event->subtype,
				'value' => $event->value
			);
		}

		return Response::json($list);
	}

}
