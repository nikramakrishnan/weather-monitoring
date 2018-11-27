<?php
//Connect to the Database
require_once '../res/connect.php';
$json_dat = array(); //Initialize array for encoding data to json format
$spec_object = false; //Will be set to true if looking for specific time

// Error Handler
require_once 'res/kill.php';

//Set default for all values
$from = date('Y-m-d H:i:s',(time() - 86400));
$to = date('Y-m-d H:i:s', time());

//Check for from and to
if(isset($_GET['from'])){
    $spec_object = true;
    $from = mysqli_real_escape_string($conn, $_GET['from']);
    $from = date('Y-m-d H:i:s',$from);
    echo $from,"\n";
}
if(isset($_GET['to'])){
    $spec_object = true;
    $to = mysqli_real_escape_string($conn, $_GET['to']);
    $to = date('Y-m-d H:i:s', $to);
}

echo $from,"\n",$to,"\n";

//Run query and get result from SQL server
$query_text = "SELECT `timestamp`,`temp`,`humidity`,`pm1`,`pm2`,`pm10`,`mq135`,`mq7` FROM `data` ORDER BY `timestamp` DESC LIMIT 1;";
//If specific visitor data is requested, provide that
if($spec_object){
  $spec_object = true; //Set specific object search
  //$get_id = mysqli_real_escape_string($conn,$_GET['v']);
  $query_text = "SELECT `timestamp`,`temp`,`humidity`,`pm1`,`pm2`,`pm10`,`mq135`,`mq7` FROM `data` WHERE `timestamp` BETWEEN '$from' AND '$to' ORDER BY `timestamp` DESC;";
}
if(!($result= mysqli_query($conn,$query_text))){
  kill('5501');
}
$column_names = array();  //Initialize array for saving property
if($spec_object){
  // If no result found
  if(mysqli_num_rows($result)==0){
    //Suply param with kill for parametrized error
    kill('3404',$get_id);
  }
}
//Get column names
while ($column = mysqli_fetch_field($result)) {
    //Save column name to array
    array_push($column_names, $column->name);
}
//Store column names for encoding to json format
//$json_dat[] = $column_names;
//Get rows
while ($row = mysqli_fetch_assoc($result)) {
  //Store rows for encoding to json format
  $json_dat[] = $row;
}


//close Mysql connection
mysqli_close($conn);
//Output json data
header('Content-Type: application/json');
$json = array();
$json['success'] = true;
$json['data'] = $json_dat;
echo json_encode($json,JSON_PRETTY_PRINT);
?>
