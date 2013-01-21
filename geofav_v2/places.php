<!DOCTYPE html>
<html>
<head>
	<title>Where Am I?!</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    table tr td {
      padding-right: 10px;
      text-align: center;
      }
    </style>
</head>
<body>
  <?php include 'connect.php';?>
  <div data-role="page" data-fullscreen="true">
    <div data-role="header">
      <h1>My Places</h1>
      <h5>Hi <?php echo "$uname"."!"; ?></h5>
      <div data-role="navbar">
        <ul>
          <li><a href="index.php" data-icon="home" >Go back</a></li>
        </ul>
      </div>
    </div>
    <div data-role="content">
      <?php 
      $sql="SELECT * from usr where uname='$uname'";
      $result = mysql_query($sql);
      $row = mysql_fetch_array($result);
      $id = $row['id'];
      $sql2 ="SELECT * from place where plusrid='$id'";
      $result2 = mysql_query($sql2);
      echo "<table>";
      echo "<tr><td><strong>Name</strong></td><td><strong>Type</strong></td><td><strong>Date</strong></td><td><strong>Take a look</strong></td></tr>";
      while($row2=mysql_fetch_array($result2)){
        $id = $row['id'];
        $plname = $row2['plname'];
        $pldesc = $row2['pldesc'];
        $plcat = $row2['plcat'];
        $pldate = $row2['pldate'];
        $pllat = $row2['pllat'];
        $pllon = $row2['pllon'];
        echo "<tr><td>$plname</td><td>$plcat</td><td>$pldate</td><td><a href='http://maps.google.com/?ll=$pllat,$pllon' data-role='button' target='_blank'>Map</a></td></tr>";
      }
      echo "</table>";
      ?>
    </div>
    <div data-role="footer"><h5>Powered by intergalacdev</h5></div>
  </div>
</body>
</html>

