<?php
//Connect to the Database
//The connection is in $conn
require_once '../res/connect.php';
//Initialize array to store error/success data
$errors= array();
$success=array();
$debug = array();

$data = array();


// Error Handler
require_once 'res/kill.php';
//Check if all mandatory data is set
if(!isset($_POST['temp'],$_POST['humidity'])){
    kill('2200');
}

//Start validation only if all data is provided and token is valid
if(empty($errors)==true){
    
    //Assign variables to POST data and escape them
    $temp = mysqli_real_escape_string($conn,$_POST['temp']);
    $humidity = mysqli_real_escape_string($conn,$_POST['humidity']);
    
    function enterData($name){
        global $data,$conn;
        //Assign visitee number if provided otherwise remains default as -1
        if(isset($_POST[$name])){
            $data[$name] = mysqli_real_escape_string($conn,$_POST[$name]);
            if(empty($data[$name])){
                $data[$name] = -1;
            }
        }
        else{
            $data[$name] = "NULL";
        }
    }

    //Insert PM data
    enterData('pm1');
    enterData('pm2');
    enterData('pm10');

    //Insert MQ Data
    enterData('mq135');
    enterData('mq7');

    //Assign vars
    $pm1 = $data['pm1'];
    $pm2 = $data['pm2'];
    $pm10 = $data['pm10'];
    $mq7 = $data['mq7'];
    $mq135 = $data['mq135'];

    //Development code
    //Get debug variable
    if(isset($_POST['debug']) && $_POST['debug']=="1") {$isdebug = "true";}
    else {$isdebug = "false";}
    /* Flag to check if the process was successful
    * 0 - There are errors (default)
    * 1 - No errors (check performed after all validations are completed) */
    $flag=0;

    $ip = $_SERVER['REMOTE_ADDR'];
}


//If there are no errors yet, Add new row to database (visitors)
if(empty($errors)==true){
    $query_text = "INSERT INTO `data` (`remote_addr`, `temp`, `humidity`, `pm1`, `pm2`, `pm10`, `mq135`, `mq7`) VALUES ('$ip', $temp, '$humidity', '$pm1', '$pm2', '$pm10', '$mq135','$mq7');";
    if(!mysqli_query($conn, $query_text)){
        $debug['mysql']="Could not insert data into database. Error message: ".mysqli_error($conn);
        kill('5501'); //Kill the process
    }
}

//Check if errors is empty, and set flag accordingly
if(empty($errors)==true){
    $flag=1;
}
else{
    $flag=0;
}
//Print errors/success depending on flag
$json=array();
if($flag==1){
    $json['success'] = true;
    $json['timestamp']= time();
}
else{
    $json['success']=false;
    $json['errors']= $errors;
    //Development code
    if(!empty($debug) && $isdebug==="true") $json['debug']=$debug;
}

//close Mysql connection
mysqli_close($conn);
//Output json data
header('Content-Type: application/json');
echo json_encode($json,JSON_PRETTY_PRINT);

?>
