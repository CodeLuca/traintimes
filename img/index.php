<?php

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        echo 'we good';
        
        $stations = array();
        
        $arr  = explode("\n", $_POST['stationNames']);
        $arr2 = explode("\n", $_POST['stationCodes']);
        
        $count = 0;
        foreach($arr as $name) {
            
            $stations[$name] = $arr2[$count];
            
        }
        
        $string = '$stations = array(';
        
        $count = 0;
        foreach($stations as $key => $value) {
            
            if($count - 1 === sizeof($stations)) {
                $string .= "'" . trim($arr2[$count]) . "' => '" . trim($key) . "'";
            } else {
                $string .= "'" . trim($arr2[$count]) . "' => '" . trim($key) . "',\n";
            }
            
            $count++;
            
        }
        
        $string .= ');';
        echo $string;
        
    }

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    
    <textarea name="stationNames"></textarea>
    <textarea name="stationCodes"></textarea>
    <input type="submit">
    
</form>