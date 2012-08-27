<?php
/*
Plugin Name: Event-O-Matic-JSON
Plugin URI: http://webanyti.me
Description: Outputs your Event-O-Matic events into a nice JSON format, needed for a project so I thought I might as well release it.
Version: 1.0
Author: Callum Silcock
Author URI: http://webanyti.me
Copyright (c) 2012 Callum Silcock (http://webanyti.me)

This is a WordPress plugin (http://wordpress.org).

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
---------------------------------------------------------------------------------------*/

add_action('admin_enqueue_scripts', 'generate_event_json', 10); 
//Run when in admin section to save precious query times


function generate_event_json() {


	if(class_exists('Event')) : 
	// Checks to see if Event-O-Matic is alive otherwise bail

	$event_call = new Event();

	$events = $event_call->getAll();

	$timeline = new stdClass;

	$timeline->headline = 'Event-O-Matic JSON Feed';
	$timeline->type = 'default';
	$timeline->text = 'Created to be used with the Timeline plugin <a href="http://timeline.verite.co/">here</a>';
	//Timeline.js needs a splash screen for some reason, edit that info here

	foreach($events as $event){

		$headline = $event['name'];
		$text = $event['description'];
		$media = $event['image'];
		$startDate = $event['dateStart'];
		$endDate = $event['dateEnd'];

		$dateSplit = str_split($startDate, 10);

		$startDate = str_replace('-',',',$dateSplit[0]);

		$timeline->date[] = array(
				'startDate' => $startDate, 
				'headline' => $headline, 
				'text' => $text, 
				'asset' => array(
					'media' => $media, 
					'credit' => '', 
					'caption' => ''
					)
				);

		$response = new stdClass;
		$response->timeline = $timeline;

		//Stick all the events in the $response var in a nice formatted format

	}

	$path = wp_upload_dir();

	//Grab the uploads path

	$fp = fopen($path['basedir'] . '/events.json', 'w');
	fwrite($fp, json_encode($response));
	fclose($fp);

	//Write or Overwrite the file

	endif;

}

//And were outta here....

?>