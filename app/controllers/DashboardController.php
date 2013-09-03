<?php

class DashboardController extends BaseController {

	public function show()
	{
		$eventTypeCategories = array(
			'primary' => EventType::where('is_primary', true)
							->orderBy('is_primary', 'DESC')
							->orderBy('id', 'ASC')
							->get(),
			'secondary' => EventType::where('is_primary', false)
							->orderBy('is_primary', 'DESC')
							->orderBy('id', 'ASC')
							->get()
		);

		return View::make('dashboard', compact('eventTypeCategories', 'timeLevels', 'bottleLevels', 'pumpLevels'));
	}
	
}
