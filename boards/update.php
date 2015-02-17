<div id="all-content">
            
<?php
        // ini_set('display_errors',1);
        // ini_set('display_startup_errors',1);
        // error_reporting(-1);
        
            if($_SERVER['REQUEST_METHOD'] === "POST") {
                
                $url = 'http://transportapi.com/v3/uk/train/station/' . $_POST['stationNAME'] .'/live.json?limit=10&api_key=' . API_KEY . '&app_id=' . APP_ID;
                $contents = array(file_get_contents($url));
                $data = json_decode($contents[0], true);
                echo('<strong>Displaying station board for</strong>: ' . $_POST['stationNAME'] . '<br> <br>');
                ?>
                
                <div class="row">
                
                <?php
                $every_third = 0;
                foreach($data['departures'] as $service) {
                    foreach($service as $train) {
                            echo '<div class="col-md-4">';
                        echo '<div class="panel panel-default">';
                        echo '<div class="panel-heading"><strong>' . $train['destination_name'] . '</strong>';
                        echo '</div>';
                        echo '<div class="panel-body">';
                        
                        if ($train['best_departure_estimate_mins'] < 1){
                            echo'';
                        }
                        else {
                            
                        echo 'Destination: ' . $train['destination_name'] . '<br>';
                        echo 'Departure time: ' . $train['aimed_departure_time'] . '<br>';
                        echo 'Minutes until service departs: ' . $train['best_departure_estimate_mins'] . '<br>';
                        //echo 'Operator: ' . $train['operator'] . '<br>';
                        if ($train['operator'] == "SW"){
                            echo 'Operator: South West <br>';
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
                        } else if ($train['operator'] == "GX"){
                            echo 'Operator: Gatwick Express <br>';
                        }
                        else {
                           echo 'Operator: ' . $train['operator'] . '<br>'; 
                        }
                        //echo 'Platform: ' . $train['platform'] . '<br>';
                        if($train['platform'] == null){
                            
                        echo '';
                            
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
                            echo 'Status: this service is currently ahead of schedule and is due to arrive in ' . $train['best_arrival_estimate_mins'] . ' minutes.  <br> <br>';
                        }
                        else if ($train['status'] == 'BUS'){
                            echo 'Status: a replacement bus service is running and will leave at ' . $train['aimed_departure_time'] .  '.<br> <br>';
                        }
                        else {
                    
                            echo 'Status: currently no report. <br> <br>';
                    
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '<br><br>';
                }
                
                ?>
                </div>
                <?php
                
            } else {
                
                ?>
                
                    <form action="<?php echo htmlspecialchars(stripslashes($_SERVER['PHP_SELF'])); ?>" method="POST">
                        <input type="text" name="stationNAME" placeholder="Enter Your Station" style="width: 100%; margin-bottom: 5px;" class="form-control" autocomplete="off">
                        <button type="submit" class="form-control btn btn-primary">Submit</button>
                    </form>
                
                <?php                
                
            }
        
        ?>
            
        </div>