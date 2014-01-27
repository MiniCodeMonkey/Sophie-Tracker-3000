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

		$medicineTypes = DB::table('events')
			->select(DB::raw('DISTINCT subtype'))
			->where('type_id', 6)
			->where('subtype', '!=', '')
			->get();

		$foodTypes = DB::table('events')
			->select(DB::raw('DISTINCT subtype'))
			->where('type_id', 12)
			->where('subtype', '!=', '')
			->get();

		return View::make('dashboard', compact('eventTypeCategories', 'medicineTypes', 'foodTypes'));
	}
	
}
