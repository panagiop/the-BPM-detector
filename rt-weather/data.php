<?php
// You have to replace YOUR_API_KEY with the key you obtain
// when you register in wunderground.com
$json_string = file_get_contents("http://api.wunderground.com/api/YOUR_API_KEY/geolookup/conditions/q/CA/San_Francisco.json"); 
$parsed_json = json_decode($json_string); 
$location = $parsed_json->{'location'}->{'city'}; 
$temp_c = $parsed_json->{'current_observation'}->{'temp_c'}; 
$time = time() * 1000;
$myarray = array($time, $temp_c);
echo json_encode($myarray);
?>