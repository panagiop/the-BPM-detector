<!DOCTYPE html>
<html>
<head>
	<title>Where Am I?!</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
</head>
<body>
    <?php include 'connect.php';?>
    <script type="text/javascript">
    $(document).ready(function(){
        getLocation();
    });
    function getLocation(){
        if (navigator.geolocation)
           {
            navigator.geolocation.getCurrentPosition(showPosition,showError,{enableHighAccuracy: true, timeout:20000});
            } else {
            alert("Geolocation is not supported by this browser.")
            }
        }
        function showPosition(position)
        {
            lat = position.coords.latitude;
            lon = position.coords.longitude;
            document.cookie = 'lat='+lat; 
            document.cookie = 'lon='+lon;     
            latlon = new google.maps.LatLng(lat, lon)
            mapholder = document.getElementById('map_canvas')
            var myOptions = {
                center:latlon,zoom:15,
                mapTypeId:google.maps.MapTypeId.ROADMAP,
                mapTypeControl:false,
                navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
            };
            var map=new google.maps.Map(document.getElementById("map_canvas"),myOptions);
            var marker=new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
        }
        function showError(error)
        {
            switch(error.code)
            {
                case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.")
                break;
                case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable...Maybe you have to activate your GPS.")
                break;
                case error.TIMEOUT:
                alert("The request to get user location timed out.")
                break;
                case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.")
                break;
            }
        }
        </script>

        <?php if($login==1){?>
        <div data-role="page" data-fullscreen="true" >
        <div data-role="header" data-position="fixed">
            <h1>GeoFav</h1>
            <h5>Hi <?php echo "$uname"."!"; ?></h5>
            <?php } ?>
            <?php if($login==1){?>
            <div data-role="navbar">
                <ul>
                    <li><a href="index.php" data-icon="home" >Home</a></li>
                    <li><a href="whereami.php" data-icon="search" data-ajax="false" class="ui-btn-active">Where Am I?</a></li>
                    <li><a href="save.php?lat=<?php echo $_COOKIE['lat'];?>&lon=<?php echo $_COOKIE['lon'];?>" data-ajax="false" data-icon="info">Save this location</a></li>
                </ul>
            </div>
        </div>
        <div id="map_canvas" style="height : 100%; width : 100%; top : 0; left : 0; position : absolute; z-index:0;"></div> 
        <div data-role="content"></div>
        <div data-role="footer" data-position="fixed"><h5>Powered by intergalacdev.net63.net</h5></div>
    </div>
    <?php } else if($login==0) {?>
    <div data-role="page" data-fullscreen="true" >
        <div data-role="header" data-position="fixed">
            <h1>GeoFav</h1>
            <div data-role="navbar">
                <ul>
                    <li><a href="index.php" data-icon="home" >Home</a></li>
                    <li><a href="whereami.php" data-icon="search" data-ajax="false" class="ui-btn-active">Where Am I?</a></li>
                </ul>
            </div>
        </div>
        <div id="map_canvas" style="height : 100%; width : 100%; top : 0; left : 0; position : absolute; z-index:0;"></div> 
        <div data-role="content"></div>
        <div data-role="footer" data-position="fixed"><h5>Powered by intergalacdev.com</h5></div>
    </div>
    <?php } ?>
</body>
</html>
