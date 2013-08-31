<?php
class EventType extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function events()
	{
		return $this->hasMany('TrackerEvent', 'type_id');
	}
}
