<?php
    require("../../config/connection.php");
    require("fuzzy-logic.php");

    $fuzzy_value = $_POST['fuzzy-value-in'];
    if(isset($fuzzy_value)){
        $final_status = getFinalStatus($fuzzy_value);
        echo $final_status;
    }else{
        echo "Tidak ada input fuzzy";
    }
?>