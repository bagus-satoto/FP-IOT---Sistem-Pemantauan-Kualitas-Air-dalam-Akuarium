<?php
require "../config/connection.php";
require "../assets/fuzzy-logic/fuzzy-logic.php";

if(function_exists($_GET['function'])) {
    $_GET['function']();
}

ini_set('date.timezone', 'Asia/Kuala_Lumpur');
$now = new DateTime();
$datenow = $now->format("Y-m-d H:i:s");

function insert_data_sensor(){
    global $connect;   
    ini_set('date.timezone', 'Asia/Kuala_Lumpur');
    $now = new DateTime();
    $datenow = $now->format("Y-m-d H:i:s");
    
    $check = array('ph' => '', 'tds' => '');
    $check_match = count(array_intersect_key($_POST, $check));
    if($check_match == count($check)){
        //test fitur
        $ph = $_POST['ph'];
        $tds = $_POST['tds'];
        $count_fuzzy = countFuzzy($tds, $ph);

        $query = "INSERT INTO sensor_data (ph, tds, fuzzy_result, time_stamp) 
                    VALUES ('".$ph."','".$tds."','".$count_fuzzy."','".$datenow."')";
        
        $result = mysqli_query($connect, $query);
        if($result)
        {
            $response=array(
            'status' => 1,
            'message' =>'Insert Success',
            "data" => array("ph"=> $ph, "tds" => $tds, "fuzzy" => $count_fuzzy),
            );
        }
        else
        {
            $response=array(
            'status' => 0,
            'message' =>'Insert Failed.'
            );
        }
    }else{
       $response=array(
                'status' => 0,
                'message' =>'Wrong Parameter In Insert Data Sensor'
             );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>