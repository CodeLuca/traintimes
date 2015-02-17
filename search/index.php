<?php
    
    require("stations.php");

    define("API_KEY", '31a6a0799fe07d20d871ac521b77e690');
    define("APP_ID", '6059eba0');

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link href="../select2-3.5.2/select2.css" rel="stylesheet"/>
    
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
                    <li><a href="#" data-toggle="modal"><i class="fa fa-gamepad"></i><span class="glyphicon glyphicon glyphicon-search" style="padding-right: 1px;"></span> Search Trains</a>
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
                    
                    Watch live departure boards.
                        
                    </noscript>
                    
                    <span class="check-bar" style="opacity: 0;">Find </span><span class="track-bar" style="opacity: 0;">a </span> <span class="and-bar" style="opacity: 0;">train </span> <span class="watch-bar" style="opacity: 0;">to catch.</span>
                </h4>
            <hr>
        </div>
                
                    <?php
                    
                        if($_SERVER['REQUEST_METHOD'] == "POST") {
                            
                            ?>
                            
                                <div class="row">
                        
                                    <div class="col-md-6">
                                        
                                        <form action="<?php echo htmlspecialchars(stripslashes($_SERVER['PHP_SELF'])); ?>">
                                            <button type="submit" class="form-control btn btn-primary">Go Back</button>
                                        </form><br>
                                        
                                    </div>
                                    
                                    <div class="col-md-6">
                                        
                                        <form action="<?php echo htmlspecialchars(stripslashes($_SERVER['PHP_SELF'])); ?>" method="POST">
                                            <textarea name="departing" style="display: none;"><?php echo $_POST['departing']; ?></textarea>
                                            <textarea name="arriving" style="display: none;"><?php echo $_POST['arriving']; ?></textarea>
                                            <textarea name="time-option" style="display: none;"><?php echo $_POST['time-option']; ?></textarea>
                                            <textarea name="date-option" style="display: none;"><?php echo $_POST['date-option']; ?></textarea>
                                            <textarea name="customhours" style="display: none;"><?php echo $_POST['customhours']; ?></textarea>
                                            <textarea name="customminutes" style="display: none;"><?php echo $_POST['customminutes']; ?></textarea>
                                            <textarea name="customyear" style="display: none;"><?php echo $_POST['customyear']; ?></textarea>
                                            <textarea name="custommonth" style="display: none;"><?php echo $_POST['custommonth']; ?></textarea>
                                            <textarea name="customday" style="display: none;"><?php echo $_POST['customday']; ?></textarea>
                                            <button type="submit" class="form-control btn btn-danger">Reload Board</button>
                                        </form><br>
                                        
                                    </div>
                                    
                                </div>
                            
                            <?php
                            
                        }
                    
                    ?>
        
        <?php
            if($_SERVER['REQUEST_METHOD'] === "POST") {
                
            $departing = true;
            if(!array_search($_POST['departing'], $stations) && !isset($stations[$_POST['departing']])) {
                $departing = false;
            }
            
            if(!array_search($_POST['arriving'], $stations) && !isset($stations[$_POST['arriving']])) {
                if(!$departing) {
                    echo '<script>window.location = "/search?err_code=2";</script>';
                } else {
                    echo '<script>window.location = "/search?err_code=1";</script>';
                }
                die();
            }
                
            $datetrain = date("Y-m-d");
            $timetrain = date("H:i");
            
            $checktime = false;
            
            function first($stations, $string) {
                
                if(strlen($string) == 3 || sizeof($string) == 3) {
                    
                    return $stations[$string];
                    
                }
                
                return $string;
                
            }
            
            function second($stations, $string) {
                
                if(strlen($string) == 3 || sizeof($string) == 3) {
                    
                    return $stations[$string];
                    
                }
                
                return $string;
                
            }
            
            function checkone($stations, $string) {
                
                if(sizeof($string) > 3 || strlen($string) > 3) {
                    
                    return array_search($string, $stations);
                    
                }
                
                return $string;
                
            }
            
            function displayCustomDate() {
                
                return $_POST['customday'] . '-' . $_POST['custommonth'] . '-' . $_POST['customyear'];
                
            }
            
            $time_option = $_POST['time-option'];
            $date_option = $_POST['date-option'];
            
            $time_curr   = true;
            $date_curr   = true;
            
            if($time_option == "Find Train at Other Time") {
                $time_curr = false;
            }
            
            if($date_option == "Find Train on Other Date") {
                $date_curr = false;  
            }
            
            if($time_curr && $date_curr) {
                
                echo('Next train from <strong>' . first($stations, $_POST['departing']) . '</strong>');
                echo(' to <strong>' . second($stations, $_POST['arriving']) . '</strong><br><br>');
                $url = 'http://transportapi.com/v3/uk/train/station/' . checkone($stations, $_POST['departing']) . '/' . $datetrain . '/' . $timetrain . '/timetable.json?limit=13&calling_at=' . checkone($stations, $_POST['arriving']) . '&api_key=' . API_KEY . '&app_id=' . APP_ID;
                $checktime = true;
                
            } else if (!$time_curr && $date_curr) {
                
                echo('Trains from <strong>' . first($stations, $_POST['departing']) . '</strong>');
                echo(' to <strong>' . second($stations, $_POST['arriving']) . '</strong> at ' . $_POST['customhours'] . ':' . $_POST['customminutes'] . ' <strong>on</strong> ' . displayCustomDate() . ':<br><br>');
                $url = 'http://transportapi.com/v3/uk/train/station/' . checkone($stations, $_POST['departing']) . '/' . $datetrain . '/' . $_POST['customhours'] . ':' . $_POST['customminutes'] . '/timetable.json?limit=13&calling_at=' . checkone($stations, $_POST['arriving']) . '&api_key=' . API_KEY . '&app_id=' . APP_ID;
                
            } else if($time_curr && !$date_curr) {
                
                echo('Trains from <strong>' . first($stations, $_POST['departing']) . '</strong>');
                echo(' to <strong>' . second($stations, $_POST['arriving']) . '</strong> at ' . $_POST['customhours'] . ':' . $_POST['customminutes'] . ' <strong>on</strong> ' . displayCustomDate() . ':<br><br>');
                $url = 'http://transportapi.com/v3/uk/train/station/' . checkone($stations, $_POST['departing']) . '/'. $_POST['customyear'] . '-' . $_POST['custommonth'] . '-' . $_POST['customday'] . '/' . date("H") . ':' . date("i") . '/timetable.json?limit=13&calling_at=' . checkone($stations, $_POST['arriving']) . '&api_key=' . API_KEY . '&app_id=' . APP_ID;
                
            } else if(!$time_curr && !$date_curr) {
                
                echo('Trains from <strong>' . first($stations, $_POST['departing']) . '</strong>');
                echo(' to <strong>' . second($stations, $_POST['arriving']) . '</strong> at ' . $_POST['customhours'] . ':' . $_POST['customminutes'] . ' <strong>on</strong> ' . displayCustomDate() . ':<br><br>');
                $url = 'http://transportapi.com/v3/uk/train/station/' . checkone($stations, $_POST['departing']) . '/'. $_POST['customyear'] . '-' . $_POST['custommonth'] . '-' . $_POST['customday'] . '/' . $_POST['customhours'] . ':' . $_POST['customminutes'] . '/timetable.json?limit=13&calling_at=' . checkone($stations, $_POST['arriving']) . '&api_key=' . API_KEY . '&app_id=' . APP_ID;
                
            } else {
                
                echo '
                
                    <script>
                    
                        window.location = "index.php?err_code=3";
                    
                    </script>
                
                ';
                die();
                
            }
            
                //$url = 'http://transportapi.com/v3/uk/train/station/' . $_POST['departing'] . '/' . $datetrain . '/' . $timetrain . '/timetable.json?limit=7&calling_at=' . $_POST['arriving'] . '&api_key=' . API_KEY . '&app_id=' . APP_ID;
                $contents = array(file_get_contents($url));
                $data = json_decode($contents[0], true);
    
             ?>
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>Departure Time</th>
                    
                        
                    <th>Platform</th>
                
                
                    
                    <th>Operator</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($data['departures'] as $station) {
                    $count = 0;
                    foreach($station as $train) {
                        $count++;
                        if($count != 1 || !$checktime) {
                            echo('<tr>');
                        } else {
                            echo('<tr style="background-color: rgba(110, 231, 60, 0.2);">');
                        }
                        echo('<td>'. $train['aimed_departure_time'] .'</td>');
                         if ($train['platform'] == null){
                        echo'<td>no platform given, may be a replacement road service</td>';
                        }
                        else{
                        echo('<td>'. $train['platform'] .'</td>');
                        }
                        echo('<td>');
                        
                        if ($train['operator'] == "SW"){
                            echo ' South West Trains<br>';
                        } else if ($train['operator'] == "XC"){
                            echo 'Cross Country <br>';
                        } else if ($train['operator'] == "GW"){
                            echo 'First Great Western <br>';
                        } else if ($train['operator'] == "VT"){
                            echo 'Virgin Trains <br>';
                        } else if ($train['operator'] == "ML"){
                            echo 'Midland Mainline <br>';
                        } else if ($train['operator'] == "SN"){
                            echo 'Southern <br>';
                        } else if ($train['operator'] == "SE"){
                            echo 'South Eastern Trains <br>';
                        } else if ($train['operator'] == "GR"){
                            echo 'East Coast <br>';
                        } else if ($train['operator'] == "TP"){
                            echo 'Transpennine Express <br>';
                        } else if ($train['operator'] == "NT"){
                            echo 'Northern Rail <br>';
                        } else if ($train['operator'] == "AW"){
                            echo 'Arriva Trains Wales <br>';
                        } else if ($train['operator'] == "IL"){
                            echo 'Island Line <br>';
                        } else if ($train['operator'] == "GX"){
                            echo 'Island Line <br>';
                        }
                        else {
                           echo '' . $train['operator'] . '<br>'; 
                        }
                        echo ('</td>');
                        echo('</tr>');
                        // echo 'Departure Time: ' . $train['aimed_departure_time'] .  ' ' . "<br> Arrival Time: " . $train['aimed_arrival_time'] . '<br>';
                        // echo '' . $train['operator'] . '<br>';
                        // echo 'Platform: ' . $train['platform'] . '<br><br>';
                        }
                    }
                echo('</tbody></table>');
                    if(sizeof($station) == 0) {
                        echo '<div style="text-align: center;"><div class="alert alert-danger"  style="margin-top: 20px;" role="alert">Sorry, either there is no direct route, or the station is typed incorrectly.</div></div>';
                    }
            ?>
                <?php
                echo '<br><br>';
                
            } else {
                
                ?>
                
                    <?php
                    
                        if($_REQUEST['err_code'] == '1') {
                            
                            ?>
                            
                                <div class="missed-stat">
                                    
                                    <div class="alert alert-danger" style="width: 100%; text-align: center;">
                                        
                                        <strong>Oh no! </strong>We couldn't find your station for departure.
                                        
                                    </div>
                                    
                                    <hr>
                                    
                                </div>
                            
                            <?php
                            
                        } else 
                    
                        if($_REQUEST['err_code'] == '2') {
                            
                            ?>
                            
                                <div class="missed-stat">
                                    
                                    <div class="alert alert-danger" style="width: 100%; text-align: center;">
                                        
                                        <strong>Oh no! </strong>We couldn't find your station for departure or arrival.
                                        
                                    </div>
                                    
                                    <hr>
                                    
                                </div>
                            
                            <?php
                            
                        } else 
                    
                        if($_REQUEST['err_code'] == '3') {
                            
                            ?>
                            
                                <div class="missed-stat">
                                    
                                    <div class="alert alert-danger" style="width: 100%; text-align: center;">
                                        
                                        <strong>Oh fiddlesticks! </strong>We're sorry, an internal error occurred.
                                        
                                    </div>
                                    
                                    <hr>
                                    
                                </div>
                            
                            <?php
                            
                        }
                    
                    ?>
                
                    <div class="incorrect-d" style="display: none;">
                        
                        <div class="alert alert-danger" style="width: 100%; text-align: center;">
                            
                            <strong>Oh no! </strong>We couldn't find your station for departure.
                            
                        </div>
                        
                        <hr>
                        
                    </div>
                
                    <div class="incorrect-a" style="display: none;">
                        
                        <div class="alert alert-danger" style="width: 100%; text-align: center;">
                            
                            <strong>Oh no! </strong>We couldn't find your station for arrival.
                            
                        </div>
                        
                        <hr>
                        
                    </div>              
                
                    <form action="<?php echo htmlspecialchars(stripslashes($_SERVER['PHP_SELF'])); ?>" method="POST">
                        
                        <select class="box1 choice" name="departing" placeholder="Select your station to depart from" style="width:100%; margin-bottom: 20px;" required>
                                <option></option>
                                <?php
                                foreach($stations as $code => $station) {
                                    echo '<option value="' . $code . '">' . $station . ' (' . $code .')</option>';
                                }
                                ?>
                       </select>
                        <select class="box2 choice" name="arriving" placeholder="Select your station to arrive at" style="width:100%; margin-bottom: 20px;" required>
                                <option></option>
                                <?php
                                foreach($stations as $code => $station) {
                                    echo '<option value="' . $code . '">' . $station . ' (' . $code .')</option>';
                                }
                                ?>
                       </select>

                        <!-- DATE INIT -->
                       
                            <div class="row" style="margin-bottom: 8px;">
                            
                                <div class="col-md-8">
                                    
                                    <?php
                                    
                                        echo "
                                        
                                        <script>
                                        
                                            $(document).ready(function(){
                                                
                                                $('.customyear').val(" . date("Y") . ");
                                            $('.custommonth').val(" . date("m") . ");
                                            $('.customday').val(" . date("d") . ");
                                                
                                            });
                                        
                                        </script>
                                        
                                        ";
                                    
                                    ?>
                                    
                                    <script type="text/javascript">
                                        
                                        function showOption() {
                                            
                                            var option = $('.date-init').val();
                                            
                                            if(option == "Find Train on Other Date") {
                                                
                                                $('.train-nearest').fadeOut(400);
                                                $('.train-after').delay(500).fadeIn(400);
                                                
                                            } else {
                                                
                                                $('.train-after').fadeOut(400);
                                                
                                            }
                                            
                                            if(option == "Find Train on Today\'s Date") {
                                                
                                                $('.train-after').fadeOut(400);
                                                $('.train-nearest').delay(500).fadeIn(400);
                                                
                                            } else {
                                                
                                                $('.train-nearest').fadeOut(400);
                                                
                                            }
                                            
                                        }
                                        
                                    </script>
                                    
                                    <label><strong>Date: </strong></label><select style="width: 100%; text-align: center; " name="date-option" onchange="showOption();" class="date-init form-control"  required>
                                        
                                        <option>Find Train on Today's Date</option>
                                        <option>Find Train on Other Date</option>
                                        
                                    </select>
                                    
                                </div>
                                
                                <script type="text/javascript">
                                    
                                    function checkTimes() {
                                        
                                        var years = $('.customyear').val();
                                        var months = $('.custommonth').val();
                                        var days = $('.customday').val();
                                        
                                        if(years.toString().length == 0 && months.toString().length == 0 && days.toString().length == 0) {
                                            
                                            $('.date-init').val('Find Train on Today\'s Date');
                                                
                                                $('.train-after').fadeOut(400);
                                                $('.train-nearest').delay(500).fadeIn(400);
                                            
                                            var year = d.getYear();
                                            if(year.toString().length == 1) {
                                                year = 0 + year.toString();
                                            }
                                            
                                            var month = d.getMonth();
                                            if(month.toString().length == 1) {
                                                month = 0 + month.toString();
                                            }
                                            
                                            var day = d.getDay();
                                            if(day.toString().length == 1) {
                                                day = 0 + day.toString();
                                            }
                                            
                                            $('.customyear').val(year);
                                            $('.custommonth').val(month);
                                            $('.customday').val(day);
                                            
                                            //surely its better to start php on line 482 and put the current date in using date("d/m/Y"); so, for the first box date("d") second date("m") third date("m")
                                        }
                                        
                                    }
                                    
                                </script>
                                
                                <div class="col-md-4 train-after" style="display: none; text-align: center; margin-left: auto; margin-right: auto;">
                                    
                                    <input type="text" name="customday" onkeyup="checkTimes();" placeholder="DD" style="margin-left: 10px; display: inline-block; width: 25%; margin-top: 25px; margin-right: 4px;" class="form-control customday" autocomplete="off" maxlength="2" minlength="2" onkeydown="return ( event.ctrlKey || event.altKey 
                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                        || (95<event.keyCode && event.keyCode<106)
                        || (event.keyCode==8) || (event.keyCode==9) 
                        || (event.keyCode>34 && event.keyCode<40) 
                        || (event.keyCode==46) )"><strong>/</strong>
                                    <input type="text" name="custommonth" onkeyup="checkTimes();" placeholder="MM" style="display: inline-block; width: 25%; margin-right: 4px;" class="form-control custommonth" autocomplete="off" maxlength="2" minlength="2" onkeydown="return ( event.ctrlKey || event.altKey 
                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                        || (95<event.keyCode && event.keyCode<106)
                        || (event.keyCode==8) || (event.keyCode==9) 
                        || (event.keyCode>34 && event.keyCode<40) 
                        || (event.keyCode==46) )"><strong>/</strong>
                                    <input type="text" name="customyear" onkeyup="checkTimes();" placeholder="YYYY" style="display: inline-block; width: 25%; margin-right: 4px;" class="form-control customyear" autocomplete="off" onkeydown="return ( event.ctrlKey || event.altKey 
                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                        || (95<event.keyCode && event.keyCode<106)
                        || (event.keyCode==8) || (event.keyCode==9) 
                        || (event.keyCode>34 && event.keyCode<40) 
                        || (event.keyCode==46) )">
                                
                                </div>
                                
                                <div class="col-md-4 train-nearest" style="padding-top: 33px;">
                                
                                    <span class="glyphicon glyphicon-ok" style="padding-right: 3.5px;"></span>Awesome! We'll find the train nearest to: <strong><?php echo date("d/m/Y"); ?></strong>. 
                                    
                                </div>
                                
                            </div>
                        
                        <!-- /DATE INIT -->

                        <!-- TIME INIT -->

                        <div class="row" style="margin-bottom: 8px;">
                            
                            <div class="col-md-8">
                                
                                <script type="text/javascript">
                                
                                    $(document).ready(function(){
                                        
                                        var d = new Date();
                                        
                                        var hours = d.getHours();
                                        if(hours.toString().length == 1) {
                                            hours = 0 + hours.toString();
                                        }
                                        
                                        var mins = d.getMinutes();
                                        if(mins.toString().length == 1) {
                                            mins = 0 + mins.toString();
                                        }
                                        
                                        $('.customhours').val(hours);
                                        $('.customminutes').val(mins);
                                        
                                    });
                                    
                                    function showOption2() {
                                        
                                        var option = $('.options-init').val();
                                        
                                        if(option == "Find Train at Other Time") {
                                            
                                            $('.time-nearest').fadeOut(400);
                                            $('.time-after').delay(500).fadeIn(400);
                                            
                                        } else {
                                            
                                            $('.time-after').fadeOut(400);
                                            
                                        }
                                        
                                        if(option == "Find Train at Current Time") {
                                            
                                            $('.time-after').fadeOut(400);
                                            $('.time-nearest').delay(500).fadeIn(400);
                                            
                                        } else {
                                            
                                            $('.time-nearest').fadeOut(400);
                                            
                                        }
                                        
                                    }
                                    
                                </script>
                                
                                <label><strong>Time: </strong></label><select style="width: 100%; text-align: center; margin-bottom: 5px;" name="time-option" onchange="showOption2();" class="options-init form-control" required>
                                    
                                    <option>Find Train at Current Time</option>
                                    <option>Find Train at Other Time</option>
                                    
                                </select>
                                
                            </div>
                            
                            <script type="text/javascript">
                                
                                function checkTimes2() {
                                    
                                    var hours = $('.customhours').val();
                                    var mins = $('.customminutes').val();
                                    
                                    if(hours.toString().length == 0 && mins.toString().length == 0) {
                                        
                                        $('.options-init').val("Find Train on Today's Date");
                                            
                                            $('.time-after').fadeOut(400);
                                            $('.time-nearest').delay(500).fadeIn(400);
                                        
                                        var hours = d.getHours();
                                        if(hours.toString().length == 1) {
                                            hours = 0 + hours.toString();
                                        }
                                        
                                        var mins = d.getMinutes();
                                        if(mins.length == 1) {
                                            mins = 0 + mins.toString();
                                        }
                                        
                                        $('.customhours').val(hours);
                                        $('.customminutes').val(mins);
                                        
                                    }
                                    
                                }
                                
                            </script>
                            
                            <div class="col-md-4 time-after" style="display: none; text-align: center; margin-left: auto; margin-right: auto;">
                                
                                <input type="text" name="customhours" pattern=".{2,2}" onkeyup="checkTimes2();" placeholder="HH" style="margin-left: 10px; display: inline-block; width: 25%; margin-top: 23px; margin-right: 4px;" class="form-control customhours" autocomplete="off" maxlength="2" minlength="2" onkeydown="return ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )"><strong>:</strong>
                                <input type="text" name="customminutes" pattern=".{2,2}" onkeyup="checkTimes2();" placeholder="MM" style="display: inline-block; width: 25%; margin-right: 4px;" class="form-control customminutes" autocomplete="off" maxlength="2" minlength="2" onkeydown="return ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )">
                            
                            </div>
                            
                            <div class="col-md-4 time-nearest" style="padding-top: 33px;">
                            
                                <span class="glyphicon glyphicon-ok" style="padding-right: 3.5px;"></span>Awesome! We'll find the train nearest to: <strong><?php echo date("H:i"); ?></strong>. 
                                
                            </div>
                            
                        </div>
                        
                        <?php
                        
                            echo "
                            
                                <script>
                                
                                    function validate() {
                                        
                                        var hours = $('.customhours').val();
                                        var mins  = $('.customminutes').val();
                                        
                                        var year = $('.customyear').val();
                                        var month = $('.custommonth').val();
                                        var day = $('.customday').val();
                                    
                                        if(parseInt(hours) > 23 || parseInt(hours) < 00) {
                                            
                                                $('.customhours').val(" . date("H") . ");
                                                $('.customminutes').val(" . date("i") . ");
                                            
                                        } else if(parseInt(mins) > 59 || parseInt(mins) < 00) {
                                            
                                                $('.customhours').val(" . date("H") . ");
                                                $('.customminutes').val(" . date("i") . ");
                                            
                                        }
                                        
                                        if(parseInt(month) > 12 || parseInt(month) < 00) {
                                            
                                            $('.custommonth').val(" . date("m") . ");
                                            
                                        }
                                        
                                        if(parseInt(day) > 31 || parseInt(day) < 00) {
                                            
                                            $('.customday').val(" . date("d") . ");
                                            
                                        }
                                        
                                        return true;
                                    }
                                
                                </script>
                            
                            ";
                        
                        ?>
                        
                        <button type="submit" class="form-control btn btn-primary" onclick="return validate();">Submit</button>
                    </form>
                
                <?php                
                
            }
        
        ?>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.js"></script>
        <script>
            $(document).ready(function() {
                $(".box1").select2({
                    placeholder: "Select a station to depart from",
                    allowClear: true,
                     minimumInputLength: 3
                });
                $(".box2").select2({
                    placeholder: "Select a to arrive at",
                    allowClear: true,
                     minimumInputLength: 3
                });
            });
        </script>
        
        </div>
    </div>
</body>
</html>