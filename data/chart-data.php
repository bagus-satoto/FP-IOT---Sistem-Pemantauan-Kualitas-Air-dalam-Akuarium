<?php
    require("../config/connection.php");
    global $connect;

    $query = "SELECT * FROM sensor_data ORDER BY time_stamp DESC LIMIT 10";
    $sql = mysqli_query($connect, $query);
    if($sql){
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = $row;
        }
        echo json_encode(array_reverse($data));
    }
?>