<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'DashboardController@show');
Route::controller('track', 'TrackController');

Route::get('import', function () {
	$entries = DB::table('entries')->where('type', 3)->get();

	// Make sure that the event type is valid
	$eventType = EventType::where('name', 'Diaper')->firstOrFail();

	// Create new event
	foreach ($entries as $entry) {
		$subtype = '';

		if ($entry->diaper_dirty == 1 && $entry->diaper_wet == 1) {
			$subtype = 'both';
		} elseif ($entry->diaper_dirty == 1) {
			$subtype = 'dirty';
		} else {
			$subtype = 'wet';
		}

		$event = new TrackerEvent;
		$event->subtype = $subtype;
		$event->created_at = DateTime::createFromFormat('U', $entry->date - (3600 * 4));
		$event->updated_at = DateTime::createFromFormat('U', $entry->date - (3600 * 4));
		$eventType->events()->save($event);
	}

	$entries = DB::table('entries')->where('type', 1)->get();

	// Make sure that the event type is valid
	$eventType = EventType::where('name', 'Feed')->firstOrFail();

	// Create new event
	foreach ($entries as $entry) {
		$subtype = '';

		if ($entry->bottle_ounces > 0) {
			$subtype = 'formula';
			$value = $entry->bottle_ounces / 10;
		} elseif ($entry->pumped_ounces > 0) {
			$subtype = 'pumped';
			$value = $entry->pumped_ounces / 10;
		} elseif ($entry->feeding_side == 1) {
			if (is_null($entry->parent_id))
				continue;

			$subtype = 'left';
			$value = $entry->feeding_duration;
		} elseif ($entry->feeding_side == 2) {
			if (is_null($entry->parent_id))
				continue;
			
			$subtype = 'right';
			$value = $entry->feeding_duration;
		}

		$event = new TrackerEvent;
		$event->subtype = $subtype;
		$event->value = $value;
		$event->created_at = DateTime::createFromFormat('U', $entry->date - (3600 * 4));
		$event->updated_at = DateTime::createFromFormat('U', $entry->date - (3600 * 4));
		$eventType->events()->save($event);
	}
});