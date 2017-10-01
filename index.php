<?php

$cmd = isset($cmd) ? $cmd :"wordpress";

if (strpos($_SERVER['REQUEST_URI'],"prototype")){
	$cmd = "prototype";
}


if (strpos($_SERVER['REQUEST_URI'],"styleguide")){
	$cmd = "styleguide";
}






/* Load in the framework */
$framework_root = "";
$site_root = dirname( __FILE__ );

if(file_exists(dirname( __FILE__ )."/framework"))
	$framework_root = dirname( __FILE__ )."/framework/";
else if(file_exists(dirname( __FILE__ )."/../framework"))
	$framework_root = dirname( __FILE__ )."/../framework/";
else if(file_exists(dirname( __FILE__ )."../../framework"))
	$framework_root = dirname( __FILE__ )."../../framework/";
else if(file_exists(dirname( __FILE__ )."../../../framework"))
	$framework_root = dirname( __FILE__ )."../../../framework/";





require_once($framework_root."load.php");

?>