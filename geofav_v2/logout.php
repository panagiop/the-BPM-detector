<?php
include_once 'connect.php';
if(isset($_POST['logout_button'])){
$login = 0;
echo "<p>You are loggged out!</p>";
header("Location: index.php");
} 
else 
{
echo "An error has occured :(";
}
?>
