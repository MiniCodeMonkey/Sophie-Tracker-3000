<?php

class DashboardController extends BaseController {

	public function show()
	{
		$timeLevels = array(
			15 => 'Snack',
			35 => 'Regular',
			50 => 'Long'
		);

		$bottleLevels = array(
			1 => 'Snack',
			3 => 'Regular',
			4.5 => 'Really Hungry'
		);

		$pumpLevels = array(
			1 => 'Small pump',
			3 => 'Regular pump',
			4.5 => 'Over-the-top-filled pump'
		);

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
