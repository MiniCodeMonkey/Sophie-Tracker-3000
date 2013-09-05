<?php

class EventTypesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('event_types')->truncate();

		$event_types = array(
			array('name' => 'Feed', 'icon' => 'icon-baby-bottle', 'is_primary' => true, 'color_name' => 'primary', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Pump', 'icon' => 'icon-tint', 'is_primary' => true, 'color_name' => 'warning', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Diaper', 'icon' => 'icon-baby-diaper', 'is_primary' => true, 'color_name' => 'success', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Sleep', 'icon' => 'icon-baby-crib', 'is_primary' => false, 'color_name' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Activity', 'icon' => 'icon-baby-rattle', 'is_primary' => false, 'color_name' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Medicine', 'icon' => 'icon-medkit', 'is_primary' => false, 'color_name' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Doctor', 'icon' => 'icon-user-md', 'is_primary' => false, 'color_name' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Bath', 'icon' => 'icon-tint', 'is_primary' => false, 'color_name' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Supplies', 'icon' => 'icon-shopping-cart', 'is_primary' => false, 'color_name' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Milestone', 'icon' => 'icon-trophy', 'is_primary' => false, 'color_name' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('name' => 'Note', 'icon' => 'icon-pencil', 'is_primary' => false, 'color_name' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime),
		);

		DB::table('event_types')->insert($event_types);
	}

}
