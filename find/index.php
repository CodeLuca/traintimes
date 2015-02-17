<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

    define("API_KEY", '31a6a0799fe07d20d871ac521b77e690');
    define("APP_ID", '6059eba0');

?>

<?php

    include("../stations.php");

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link rel="stylesheet" type="text/css" href="../style/wheel.css">
    
        <!-- Script Links  -->
        <noscript></noscript>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- /Script Links -->
        
        <!-- Title & Meta  -->
        
        <title>TrainTimes.COM - Check, Track and Watch Trains.</title>
        
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="keywords" content="">
	    <link rel="icon" href="/img/favicon.png">
        <!-- /Title & Meta -->
    
</head>

<body>
    

        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../">TrainTimes</a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                    <li><a href="../search/" data-toggle="modal"><i class="fa fa-gamepad"></i><span class="glyphicon glyphicon glyphicon-search" style="padding-right: 1px;"></span> Search Trains</a>
                        </li>
                        <li><a href="../boards/"><i class='fa fa-comment'></i><span class="glyphicon glyphicon-send" style="padding-right: 3px;"></span> Live Departure Boards</a>
                         </li>
                         
                         <li><a href="../find" data-toggle="modal"><i class="fa fa-gamepad"></i><span class="glyphicon glyphicon-map-marker" style="padding-right: 1px;"></span> Find Nearest Station</a>
                        </li>
                    </ul>
                   
                </div>
            </div>
        </nav>
        
        <div class="container">

        <div style="text-align: center; margin-right: auto; margin-left: auto;">
            <h1>TrainTimes</h1>
            <?php 
                if(isset($_REQUEST['lat'])) {
                    echo '
                        <script>
                            var go = true;
                        </script>
                    ';
                } else {
                    echo '
                        <script>
                            var go = false;
                        </script>
                    ';
                }
            ?>
                <script>
                
                    $(document).ready(function(){
                        $('.check-bar').delay(250).animate({"opacity":1}, 400);
                        $('.track-bar').delay(750).animate({"opacity":1}, 400);
                        $('.and-bar').delay(1250).animate({"opacity":1}, 400);
                        $('.watch-bar').delay(1750).animate({"opacity":1}, 400);
                        if(!go) {
                            getLocation();
                        }
                    });
                    
                        function getLocation(){
                            navigator.geolocation.getCurrentPosition(showPosition);
                        }
                        
                        function showPosition(position){
                            var tlong = position.coords.longitude;
                            var tlat = position.coords.latitude;
                            tlong = tlong.toFixed(10);
                            tlat = tlat.toFixed(10);
                            window.location.href = "index.php?lat=" + tlat + "&long=" + tlong; 
                        }
                </script>
                
                <?php
                    $station = null;
                    if(isset($_REQUEST['lat'])) {
                                        
                        $lat = $_GET['lat'];
                        $long = $_GET['long'];
                        $response = file_get_contents('http://transportapi.com/v3/uk/train/stations/near.json?lon=' . $long .'&lat='. $lat .'&api_key=31a6a0799fe07d20d871ac521b77e690&app_id=6059eba0');
                        $data = json_decode($response, true);
                        $station = $data['stations'][0]['name'];
                    }
                ?>
                
                <h4 style="margin-bottom: 32px; color: #999999; margin-top: -7px;">
                    <noscript>
                    
                    <?php
                    
                        if($station === null) {
                            echo 'Find the nearest station.';
                        } else {
                            echo 'Your nearest station is ' . $station . '.';
                        }
                    
                    ?>
                        
                    </noscript>
                    
                    <?php
                    
                        if($station === null) {
                            echo '<span class="check-bar" style="opacity: 0;">Find </span><span class="track-bar" style="opacity: 0;">the </span> <span class="and-bar" style="opacity: 0;">nearest </span> <span class="watch-bar" style="opacity: 0;">station.</span>';
                        } else {
                            echo '<span class="check-bar" style="opacity: 0;">The </span><span class="track-bar" style="opacity: 0;">nearest </span> <span class="and-bar" style="opacity: 0;">station is </span> <span class="watch-bar" style="opacity: 0;">' . $station . '.</span>';
                        }
                    
                    ?>
                </h4>
            <hr>
        </div>
    
        <div id="all-content">
            
            <?php
            
                if(!isset($_REQUEST['lat'])) {
                 
                    ?>
                    
                        <div class="wheel-container" style="margin-top: 12%; margin-left: 47%;">
                            <div class="wheel">
                    	        <div class="wBall" id="wBall_1">
                    	          <div class="wInnerBall">
                    	          </div>
                    	        </div>
                    	        <div class="wBall" id="wBall_2">
                    	          <div class="wInnerBall">
                    	          </div>
                    	        </div>
                    	        <div class="wBall" id="wBall_3">
                    	          <div class="wInnerBall">
                    	          </div>
                    	        </div>
                    	        <div class="wBall" id="wBall_4">
                    	          <div class="wInnerBall">
                    	          </div>
                    	        </div>
                    	        <div class="wBall" id="wBall_5">
                    	          <div class="wInnerBall">
                    	          </div>
                	          </div>
                	         </div>
                        </div>
                    
                    <?php
                 
                    die();
                    
                }
            
            ?>
            
        <center>
            <h2 id ="potato">
            <?php
                if(isset($_REQUEST['lat'])) {
                                    
                    $lat = $_GET['lat'];
                    $long = $_GET['long'];
                    $response = file_get_contents('http://transportapi.com/v3/uk/train/stations/near.json?lon=' . $long .'&lat='. $lat .'&api_key=31a6a0799fe07d20d871ac521b77e690&app_id=6059eba0');
                    $data = json_decode($response, true);
                    $station = $data['stations'][0]['name'];
                    echo("<strong>Can't find it? </strong>Ask our friendly map below.");
                    $link = "https://www.google.com/maps/dir/". $lat . "," . $long ."/" . $station . "+Train+Station";
                    $link = str_replace(' ', '+', $link);
                    ?>
                    <hr>
            <?php echo'
                <iframe width="100%" height="500px" frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?q=' . $station . '+Train+Station&key=AIzaSyD5rzIsuj84cB9-T_t5f-WJdykwoP40cdU"></iframe> 
                    ';
            ?>
               <?php
                }
            ?>
        
        </div>
    </body>
</html>
