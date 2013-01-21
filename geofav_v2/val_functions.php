<?php
function sanitizeString($var){
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripslashes($var);
	return mysql_real_escape_string($var);
}

function randsalt() {
	return substr(sha1(mt_rand()),0,22);
}

function val_firstname($input) {
	 if ($input == "") {
		echo "No firstname was entered<br />";
		return "error";
	} else {
		return "";
	}
}

function val_lastname($input) {
	if ($input == "") {
		echo "No lastname was entered<br />";
		return "error";
	} else {
		return "";
	}
}

function val_uname($input) {
	if ($input == "") {
		echo "No Username was entered<br />";
		return "error";
	}
	else if (strlen($input) < 5) {
		echo "Usernames must be at least 5 characters<br />";
		return "error";
	}
	else if (preg_match("/[^a-zA-Z0-9_-]/", $input)) {
		echo "Only letters, numbers, - and _ in usernames<br />";
		return "error";
	} else {
	return "";		
	}
}

function val_pass($input) {
	if ($input == "") {
		echo "No Password was entered<br />";
		return "error";
	}
	else if (strlen($input) < 6) {
		echo "Passwords must be at least 6 characters<br />";
		return "error";
	}
	else if (!preg_match("/[a-z]/", $input) ||
			 !preg_match("/[A-Z]/", $input) ||
			 !preg_match("/[0-9]/", $input)) {
		echo "Passwords require 1 each of a-z, A-Z and 0-9<br />";
		return "error";
	} else {
	return "";
	}
}

function val_email($input) {
	if ($input == "") {
		echo "No Email was entered<br />";
		return "error";
	} 
	else if (!((strpos($input, ".") > 0) && (strpos($input, "@") > 2)) || preg_match("/[^a-zA-Z0-9.@_-]/", $input)){
		echo "The Email address is invalid<br />";
		return "error";
	} else {
		return "";
	}
}
?>
