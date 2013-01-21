<!DOCTYPE html>
<html>
<head>
	<title>Save this location</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div data-role="page" data-fullscreen="true">
		<div data-role="header">
			<h1>Save this location</h1>
		</div>
		<div data-role="content">
			<form action="save.php" method="post" name="saveposition">
				<table>
					<tr><td>Name of the place*</td><td><input type="text" id="plname" name="plname"></td></tr>
					<tr><td>Type of place*</td><td>
						<select id="plcat" name="plcat">
							<option value="Bar">Bar</option>
							<option value="Restaurant">Restaurant</option>
							<option value="Cafe">Cafe</option>
							<option value="Shopping center">Shopping center</option>
							<option value="Friend's place">Friend's place</option>
							<option value="Square">Square</option>
							<option value="Other">Other</option>
						</select>
					</td></tr>
					<tr><td>Description*</td><td><input type="text" id="pldesc" name="pldesc"></td></tr>
					<tr><td><input type="hidden" id="pllat" name="pllat" value=""></td></tr>
					<tr><td><input type="hidden" id="pllon" name="pllon" value=""></td></tr>
					<tr><td colspan=2><input type="submit" value="Save" name="savelocation" id="savelocation"></td></tr>
				</table>
			</form>
		</div>
		<div data-role="footer"></div>
	</div>

	<?php include 'connect.php';
	if(isset($_POST['savelocation'])){
		$sql ="SELECT * from usr where uname='$uname'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$id = $row['id'];
		$myid = mysql_insert_id();
		$date = date("Y/m/d");
		$lat = $_GET['lat'];
		$lon = $_GET['lon'];
		$sql2 ="INSERT INTO place(plid,plusrid,plname,pldesc,plcat,pldate,pllat,pllon) VALUES ('$myid','$id','$_POST[plname]','$_POST[pldesc]','$_POST[plcat]',NOW(),'$_COOKIE[lat]','$_COOKIE[lon]') ";
		if(mysql_query($sql2)){
			echo "<p>You have succesfully stored your location!</p>";
			header("Location: index.php");
		} else {
			echo "An error has occured :(";
		}
	}
	?>
</body>
</html>

