<?php

    include("stations.php");

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    
        <!-- Script Links  -->
        <noscript></noscript>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- /Script Links -->
        
        <!-- Title & Meta  -->
        
        <title>TrainTimes.com - Check, Track and Watch Trains.</title>
        
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
            <a class="navbar-brand" href="#">TrainTimes</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                    <li><a href="search/" data-toggle="modal"><i class="fa fa-gamepad"></i><span class="glyphicon glyphicon glyphicon-search" style="padding-right: 1px;"></span> Search Trains</a>
                        </li>
                        
                    
                        <li><a href="boards/"><i class='fa fa-comment'></i><span class="glyphicon glyphicon-send" style="padding-right: 3px;"></span> Live Departure Boards</a>
                        </li>
                            
                            <li><a href="find/" data-toggle="modal"><i class="fa fa-gamepad"></i><span class="glyphicon glyphicon-map-marker" style="padding-right: 1px;"></span> Find Nearest Station</a>
                        </li>
                    </ul>
        </div>
    </div>
</nav>
        
        <div class="container">

        <div style="text-align: center; margin-right: auto; margin-left: auto;">
            <h1>TrainTimes</h1>
                <script>
                    
                    $(document).ready(function(){
                        
                        $('.check-bar').delay(250).animate({"opacity":1}, 400);
                        $('.track-bar').delay(750).animate({"opacity":1}, 400);
                        $('.and-bar').delay(1250).animate({"opacity":1}, 400);
                        $('.watch-bar').delay(1750).animate({"opacity":1}, 400);
                        
                    });
                    
                </script>
                <h4 style="margin-bottom: 32px; color: #999999; margin-top: -7px;">
                    <noscript>
                    
                    Check, Find and Search Trains.
                        
                    </noscript>
                    
                    <span class="check-bar" style="opacity: 0;">Find, </span><span class="track-bar" style="opacity: 0;">Track</span> <span class="and-bar" style="opacity: 0;">and</span> <span class="watch-bar" style="opacity: 0;">Search Trains.</span>
                </h4>
            <hr>
        </div>
        
        <div class="row">
            
            <div class="col-md-5">
                
                <div class="page-header" style="text-align: center;">
                    
                    <h3><a href="search/">Search For Trains</a></h3>
                    
                </div><br>
                
            </div>
            
            <div class="col-md-5 col-md-push-2">
                
                <div class="page-header" style="text-align: center;">
                    
                    <h3><a href="boards/">Live Departure Boards</a></h3>
                    
                </div><br>
                
            </div>
            
        </div>
        
        Hey, here at TrainTimes we are dedicated to providing you the latest, most up to date train times. All data is provided by national rail, and to get a more up to date look at any time, just press the reload button on any page, simple!
        
    </div>
</body>
</html