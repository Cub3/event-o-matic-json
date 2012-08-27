event-o-matic-json
==================

Outputs your Event-O-Matic events into a nice JSON format, needed for a project so I thought I might as well release it.

I created it so it would feed info from Event-O-Matic straight through to the Timeline.Js plugin (and in the format it requires), the plugin can still be used just for the JSON but you can easily use it for both.

Find the Event-O-Matic plugin here: http://wordpress.org/extend/plugins/event-o-matic/
Find Timeline.JS here: http://timeline.verite.co/

---

Timeline.JS Config Instructions:

* Grab all the files from above
* Setup your css / js / script calls (for ref i've put mine in my theme dir under /library/css/ || /library/js/)
* Use the following variable data

	var timeline_config = {
		width: 	"100%",
		height: "",
		source: "<?php $path = wp_upload_dir(); echo $path['baseurl'] ?>/events.json",
		css: 	'<?php echo get_template_directory_uri(); ?>/library/css/timeline.css',	//OPTIONAL
		js: 	'<?php echo get_template_directory_uri(); ?>/library/js/timeline-min.js'	//OPTIONAL
	}

---

Version: 1.0
Author: Callum Silcock
Author URI: http://webanyti.me
Copyright (c) 2012 Callum Silcock (http://webanyti.me)

This is a WordPress plugin (http://wordpress.org).