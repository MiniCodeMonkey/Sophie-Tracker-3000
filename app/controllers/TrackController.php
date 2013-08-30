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
		$event->save();

		return Response::json(array('success' => true));
	}

}
