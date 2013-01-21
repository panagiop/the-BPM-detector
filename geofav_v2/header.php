<!DOCTYPE html>
<html>
<head>
	<title>GeoFav</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php include_once 'connect.php';
$sql="SELECT * from usr where uname='$uname'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$id= $row['id'];
?>

<div data-role="page" data-fullscreen="true">
  <div data-role="header">
    <h1>GeoFav</h1>
    <?php if($login == 1){?>
    <h5>Hi <?php echo "$uname"."!"; ?></h5><? } ?>
    <?php if($login == 1){?>
    <div data-role="navbar">
      <ul>
        <li><a href="index.php" data-icon="home" class="ui-btn-active">Home</a></li>
        <li><a href="whereami.php" data-icon="search" data-ajax="false">Where Am I?</a></li>
        <li><a href="places.php" data-icon="grid"  >My Places</a></li>
      </ul>
    </div>
  </div>
  <? } else {?>
  <div data-role="navbar">
    <ul>
      <li><a href="index.php" data-icon="home" class="ui-btn-active">Home</a></li>
      <li><a href="whereami.php" data-icon="search" data-ajax="false">Where Am I?</a></li>
    </ul>
  </div>
  </div>
  <? }?>
  <?php if($login == 1){?>
  <div data-role="content"><p>Welcome to GeoFav! You can save the location you are at this moment in "Where Am I?" section and if you like it save it as one of your favorite places</p>
    <ul>
      <li><a href="logout.html" data-icon="arrow-d" data-role="button" data-rel="dialog">Logout</a></li>
      <li><a href="register.html" data-icon="arrow-d" data-role="button" data-rel="dialog">Register</a></li>
    </ul>
  </div>
  <div data-role="footer"><h4>Powered by intergalacdev.net63.net</h4></div>
  <? } else {?>
  <div data-role="content"><p>Welcome to GeoFav! You can save the location you are at this moment in "Where Am I?" section and if you like it save it as one of your favorite places</p>
    <ul>
      <li><a href="login.html" data-icon="arrow-d" data-role="button" data-rel="dialog">Login</a></li>
      <li><a href="register.html" data-icon="arrow-d" data-role="button" data-rel="dialog">Register</a></li>
    </ul>
  </div>
  <div data-role="footer"><h4>Powered by intergalacdev.com</h4></div>
  <? } ?>
</div>
</body>
</html>
