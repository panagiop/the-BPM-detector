<?php
session_start();
//Change the fields below according to your db settings
//See also the README.md file for db's tables creation
$mysql_host = "YOUR_HOST_NAME";
$mysql_database = "YOUR_DB";
$mysql_user = "YOUR_USERNAME";
$mysql_password = "YOUR_PASSWORD";
$con = mysql_connect($mysql_host,$mysql_user,$mysql_password);

if(!$con){
	die('could not connect:' . mysql_error());
}

mysql_select_db($mysql_database,$con);

mysql_query("set names 'utf8'");

$login = 0; //A flag that indicates if a user is logged in

include_once 'val_functions.php';

if (isset($_POST['logout_button'])){
	$login=0;
	session_destroy();
	echo "You are logged out.";
	header("Location: index.php");
}

if (isset($_POST['login_button'])){
	$uname = sanitizeString($_POST['uname']);
	$pre_pass = sanitizeString($_POST['pass']);
	$sql ="select randsalt,uname,pass from usr where uname='$uname'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
    $hashed_pass = sha1($row['randsalt'].$pre_pass); 
	if ($hashed_pass == $row['pass']){
		if (mysql_num_rows($res) > 0)
		{
			$login = 1;
			$_SESSION['uname'] = $uname;
			$_SESSION['pass'] = $pass;
			echo "You are logged in.";
			header("Location: index.php");
		} else {
			echo "Wrong username/password combination";
			echo "<a href=\"index.php\">Try again</a>";
		}
	} else {
		echo "There was a problem with your user name or password";
	}
} 
else if (isset($_SESSION['uname'])){
	$uname = $_SESSION['uname'];
	$pass = $_SESSION['pass'];
    $login = 1;
}
?>
