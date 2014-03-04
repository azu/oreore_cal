<?php

class zusaar_api_wrapper extends event_api_wrapper{

	protected $user_id_key = "user_id";

	protected $api_url = 'http://www.zusaar.com/api/event/';

	protected $other_param = array('count' => 100);


	public function format_events($events_data){

		$data = json_decode($events_data, true);

		if(!$data['results_returned']){
			throw new UnexpectedValueException('events not found');
		}

		$events = array();

		foreach($data['event'] as $event){
			$events[] = array(
				'title' => $event['title'],
				'start' => date('Y-m-d H:i:s', strtotime($event['started_at'])),
				'end' => date('Y-m-d H:i:s', strtotime($event['ended_at'])),
				'url' => $event['event_url'],
				'allDay' => false,
			);
		}

		return $events;

	}
	
}
