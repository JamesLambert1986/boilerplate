<?php

require_once(dirname( __FILE__ ).'/extend_admin.php');

if(is_admin()){
	
	$cmd = "wordpress_admin";
	// Load in the framework classes via going to the project index page
	

	
	require_once(dirname( __FILE__ ).'../../../../../index.php');
}
?>