<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

    define("API_KEY", '31a6a0799fe07d20d871ac521b77e690');
    define("APP_ID", '6059eba0');

?>

<?php

    require_once(__DIR__ . "/../stations.php");

    include("../stations.php");

?>

<!DOCTYPE html> 
<html>

<head>
    
    
    <link href="../select2-3.5.2/select2.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    
        <!-- Script Links  -->
        <noscript></noscript>
        
                <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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

    <?php
    
            function first($stations, $string) {
                
                if(strlen($string) == 3 || sizeof($string) == 3) {
                    
                    return $stations[$string];
                    
                }
                
                return $string;
                
            }
    
    ?>

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
                        <li><a href="../find/" data-toggle="modal"><i class="fa fa-gamepad"></i><span class="glyphicon glyphicon-map-marker" style="padding-right: 1px;"></span> Find Nearest Station</a>
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
                        $("#select2").select2();
                        $('.check-bar').delay(250).animate({"opacity":1}, 400);
                        $('.track-bar').delay(750).animate({"opacity":1}, 400);
                        $('.and-bar').delay(1250).animate({"opacity":1}, 400);
                        $('.watch-bar').delay(1750).animate({"opacity":1}, 400);
                        
                    });
                    
                </script>
                
                        <?php
            if($_SERVER['REQUEST_METHOD'] === "POST") {
                            $stationName = $_POST['stationNAME'];
                            
                            if(!array_search($_POST['stationNAME'], $stations) && $stations[$_POST['stationNAME']] == null) {
                                                
                                echo '
                                
                                    <script>
                                    
                                        window.location = "index.php?err_code=3";
                                    
                                    </script>
                                
                                ';
                                die();
                
                            }
                            
                            if(strlen($stationName) > 3) {
                                $stationName = array_search($_POST['stationNAME'], $stations);
                            }
                $url = 'http://transportapi.com/v3/uk/train/station/' . $stationName .'/live.json?limit=18&api_key=' . API_KEY . '&app_id=' . APP_ID;
                $contents = array(file_get_contents($url));
                $data = json_decode($contents[0], true);
                
                            $stationName = $_POST['stationNAME'];
                            
                }
                
                ?>
                
                <h4 style="margin-bottom: 32px; color: #999999; margin-top: -7px;">
                    <span class="check-bar" style="opacity: 0;">View </span><span class="track-bar" style="opacity: 0;">live </span> <span class="and-bar" style="opacity: 0;">departure </span> <span class="watch-bar" style="opacity: 0;">boards<?php if(isset($stationName)) { echo ' at ' . first($stations, $stationName) . '.'; } else {echo '.';} ?></span>
                </h4>
            <hr>
        </div>
        
        <?php
            $bool = false;
            if($_SERVER['REQUEST_METHOD'] === "POST") {
                        if($bool == false){
                            $stationName = $_POST['stationNAME'];
                            
                            if(strlen($stationName) > 3) {
                                $stationName = array_search($_POST['stationNAME'], $stations);
                            }
                            
                        }
                $bool = true;
                $url = 'http://transportapi.com/v3/uk/train/station/' . $stationName .'/live.json?limit=18&api_key=' . API_KEY . '&app_id=' . APP_ID;
                $contents = array(file_get_contents($url));
                $data = json_decode($contents[0], true);
                
                            $stationName = $_POST['stationNAME'];
                
                ?>
                    
        <div id="all-content">
                
                    <div class="row">
                        
                        <div class="col-md-6">
                            
                            <form action="<?php echo htmlspecialchars(stripslashes($_SERVER['PHP_SELF'])); ?>">
                                <button type="submit" class="form-control btn btn-primary">Go Back</button>
                            </form><br>
                            
                        </div>
                        
                        <div class="col-md-6">
                            
                            <form action="<?php echo htmlspecialchars(stripslashes($_SERVER['PHP_SELF'])); ?>" method="POST">
                                <textarea name="stationNAME" style="display: none;"><?php echo $stationName; ?></textarea>
                                <button type="submit" class="form-control btn btn-danger">Reload Board</button>
                            </form><br>
                            
                        </div>
                        
                    </div>  
                
                <?php
                
        ?>
                <div class="container" style="width: 95%;">
                <div class="row">
                
                <?php
                $every_third = 0;
                foreach($data['departures'] as $service) {
                    foreach($service as $train) {
                        
                        if ($train['best_departure_estimate_mins'] < 1){
                            echo'';
                        } else {
                        
                        echo '<div class="col-md-4">';
                        echo '<div class="panel panel-default" style="height: 200px; max-height: 200px;">';
                        echo '<div class="panel-heading"><strong>' . $train['destination_name'] . '</strong>';
                        echo '</div>';
                        echo '<div class="panel-body">';
                            
                        echo 'Destination: ' . $train['destination_name'] . '<br>';
                        echo 'Departure time: ' . $train['aimed_departure_time'] . '<br>';
                        echo 'Minutes until service departs: ' . $train['best_departure_estimate_mins'] . '<br>';
                        //echo 'Operator: ' . $train['operator'] . '<br>';
                        if ($train['operator'] == "SW"){
                            echo ' South West Trains<br>';
                        } else if ($train['operator'] == "XC"){
                            echo 'Operator: Cross Country <br>';
                        } else if ($train['operator'] == "GW"){
                            echo 'Operator: First Great Western <br>';
                        } else if ($train['operator'] == "VT"){
                            echo 'Operator: Virgin Trains <br>';
                        } else if ($train['operator'] == "ML"){
                            echo 'Operator: Midland Mainline <br>';
                        } else if ($train['operator'] == "SN"){
                            echo 'Operator: Southern <br>';
                        } else if ($train['operator'] == "SE"){
                            echo 'Operator: South Eastern Trains <br>';
                        } else if ($train['operator'] == "GR"){
                            echo 'Operator: East Coast <br>';
                        } else if ($train['operator'] == "TP"){
                            echo 'Operator: Transpennine Express <br>';
                        } else if ($train['operator'] == "NT"){
                            echo 'Operator: Northern Rail <br>';
                        } else if ($train['operator'] == "AW"){
                            echo 'Operator: Arriva Trains Wales <br>';
                        } else if ($train['operator'] == "GX"){
                            echo 'Operator: Gatwick Express <br>';
                        } else if ($train['operator'] == "GX"){
                            echo 'Operator: Gatwick Express <br>';
                        }
                        else {
                           echo 'Operator: ' . $train['operator'] . '<br>'; 
                        }
                            
                        if($train['platform'] == null){
                        
                        echo 'Platform: replacement road service <br>';
                            
                        }
                        else {
                           
                           echo 'Platform: ' . $train['platform'] . '<br>';
                            
                        }
                        // echo 'Status: ' . $train['status'] . '<br><br>';
                        if($train['status'] == 'ON TIME'){
                            echo 'Status: on time. <br> <br>';
                        } else if ($train['status'] == 'STARTS HERE'){
                            echo 'Status: this service starts here. <br> <br>';
                        }
                        else if ($train['status'] == 'LATE'){
                            echo 'Status: this service is currently delayed. <br> <br>';
                        }
                        else if ($train['status'] == 'EARLY'){
                            echo 'Status: this service is currently ahead of schedule.<br> <br>';
                        }
                        else if ($train['status'] == 'BUS'){
                            echo 'Status: this service is a replacement bus service.<br> <br> <br>';
                        }
                        else {
                    
                            echo 'Status: currently no report. <br> <br>';
                    
                        }
                    }
                    echo '<br></div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '<br><br>';
                ?>
                <?php
                }
                
                ?>
                </div>
                </div>
                </div>
                <?php
            } else {
                
                if(isset($_REQUEST['err_code']) && $_REQUEST['err_code'] == "3") {
                    
                                        echo '
                
                                <div class="missed-stat">
                                    
                                    <div class="alert alert-danger" style="width: 100%; text-align: center;">
                                        
                                        <strong>Oh fiddlesticks! </strong>We couldn\'t find your station.
                                        
                                    </div>
                                    
                                    <hr>
                                    
                                </div>
                ';
                
                }
                    
                    ?>
                    
                
                    <form action="<?php echo htmlspecialchars(stripslashes($_SERVER['PHP_SELF'])); ?>" method="POST" style="margin-top: 25px;">
                            <select class="choice" name="stationNAME" placeholder="Select your station" style="width:100%; margin-bottom: 20px;">
                                <option></option>
                                <?php
                                foreach($stations as $code => $station) {
                                    echo '<option value="' . $code . '">' . $station . ' (' . $code .')</option>';
                                }
                                ?>
                       </select>
                        <button type="submit" class="form-control btn btn-primary">Submit</button>
                    </form>
                    
                <?php                
                
            }
        
        ?>
        <br>
        </div>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.js"></script>
        <script>
            $(document).ready(function() {
                $(".choice").select2({
                    placeholder: "Select a Station",
                    allowClear: true,
                     minimumInputLength: 3
                });
            });
        </script>
</body>
</html>