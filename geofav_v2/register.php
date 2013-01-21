<?php

include_once 'connect.php';
include_once 'val_functions.php';
if(isset($_POST['register_button'])){
        //sanitizing the registration's form fields
	$uname2 = sanitizeString($_POST[uname2]);
	$pre_pass2 = sanitizeString($_POST[pass2]);
	$randsalt2 = randsalt();
        $pass2 = sha1($randsalt2.$pre_pass2);
	$firstname2 = sanitizeString($_POST[firstname2]);
	$lastname2 = sanitizeString($_POST[lastname2]);
	$email2 = sanitizeString($_POST[email2]);
        //validating the form fields
        $error .= val_uname($uname2);
	$error .= val_pass($pass2);
	$error .= val_firstname($firstname2);
	$error .= val_lastname($lastname2);
	$error .= val_email($email2);
        //if no error has occured ...
	if ($error == "") {
	$usrpost = "SELECT * FROM usr WHERE uname='$uname2'";
	$usrquery = mysql_query($usrpost);
	$sql = "INSERT INTO usr(uname,pass,firstname,lastname,email,randsalt) VALUES ('$uname2','$pass2','$firstname2','$lastname2','$email2','$randsalt2')";
    
	$myquery = mysql_query($sql);
	if(mysql_num_rows($usrquery) > 0){
		echo "Already taken! <a href=\"index.php\"> Try again</a> \n";
	}
	if($myquery){
		echo "you sucessfully registered";
		header("Location: index.php");
	} 
	if (!$myquery) {
		die('Invalid query: ' . mysql_error());
	}
	} else {
	echo "<a href=\"register.html\"> Go back and try again</a> \n";
}
}
?>
