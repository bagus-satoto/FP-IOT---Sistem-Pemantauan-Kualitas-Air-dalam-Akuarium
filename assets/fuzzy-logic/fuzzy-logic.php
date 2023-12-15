<?php
function getDerajatKeanggotaanTds($linguistic_variable, $tds_value)
{
    $derajat_keanggotaan_tds = 0;
    if ($linguistic_variable == "sangat-baik") {
        //check value of tds for sangat-baik rule
        if ($tds_value >= 200) {
            $derajat_keanggotaan_tds = 0;
        } else if ($tds_value >= 150 and $tds_value <= 200) {
            $derajat_keanggotaan_tds = (200 - $tds_value) / 50;
        } else if ($tds_value >= 0 and $tds_value <= 150) {
            $derajat_keanggotaan_tds = 1;
        }
    } else if ($linguistic_variable == "baik") {
        //check value of tds for baik rule
        if ($tds_value <= 150 or $tds_value >= 300) {
            $derajat_keanggotaan_tds = 0;
        } else if ($tds_value >= 150 and $tds_value <= 200) {
            $derajat_keanggotaan_tds = ($tds_value - 150) / 50;
        } else if ($tds_value >= 250 and $tds_value <= 300) {
            $derajat_keanggotaan_tds = (300 - $tds_value) / 50;
        } else if ($tds_value >= 200 and $tds_value <= 250) {
            $derajat_keanggotaan_tds = 1;
        }
    } else if ($linguistic_variable == "cukup") {
        //check value of tds for cukup rule
        if ($tds_value <= 250 or $tds_value >= 500) {
            $derajat_keanggotaan_tds = 0;
        } else if ($tds_value >= 250 and $tds_value <= 300) {
            $derajat_keanggotaan_tds = ($tds_value - 250) / 50;
        } else if ($tds_value >= 450  and $tds_value <= 500) {
            $derajat_keanggotaan_tds = (500 - $tds_value) / 50;
        } else if ($tds_value >= 300 and $tds_value <= 450) {
            $derajat_keanggotaan_tds = 1;
        }
    } else if ($linguistic_variable == "buruk") {
        //check value of tds for buruk rule
        if ($tds_value <= 450 or $tds_value >= 1000) {
            $derajat_keanggotaan_tds = 0;
        } else if ($tds_value >= 450 and $tds_value <= 500) {
            $derajat_keanggotaan_tds = ($tds_value - 450) / 50;
        } else if ($tds_value >= 900 and $tds_value <= 1000) {
            $derajat_keanggotaan_tds = (1000 - $tds_value) / 100;
        } else if ($tds_value >= 500 and $tds_value <= 900) {
            $derajat_keanggotaan_tds = 1;
        }
    } else if ($linguistic_variable == "sangat-buruk") {
        //check value of tds for sangat-buruk rule
        if ($tds_value <= 900) {
            $derajat_keanggotaan_tds = 0;
        } else if ($tds_value >= 900 and $tds_value <= 1000) {
            $derajat_keanggotaan_tds = ($tds_value - 900) / 100;
        } else if ($tds_value >= 1000) {
            $derajat_keanggotaan_tds = 1;
        }
    }
    return $derajat_keanggotaan_tds;
}

function getDerajatKanggotaanPH($linguistic_variable, $ph_value)
{
    $derajat_keanggotaan_ph = 0;
    if ($linguistic_variable == "asam") {
        //check value of ph for asam rule
        if ($ph_value >= 7) {
            $derajat_keanggotaan_ph = 0;
        } else if ($ph_value >= 6 and $ph_value <= 7) {
            $derajat_keanggotaan_ph = (7 - $ph_value) / 1;
        } else if ($ph_value <= 6) {
            $derajat_keanggotaan_ph = 1;
        }
    } else if ($linguistic_variable == "netral") {
        //check value of ph for netral rule
        if ($ph_value <= 6 or $ph_value >= 8.5) {
            $derajat_keanggotaan_ph = 0;
        } else if ($ph_value >= 6 and $ph_value <= 7) {
            $derajat_keanggotaan_ph = ($ph_value - 6) / 1;
        } else if ($ph_value >= 8 and $ph_value <= 8.5) {
            $derajat_keanggotaan_ph = (8.5 - $ph_value) / 0.5;
        } else if ($ph_value >= 7 and $ph_value <= 8) {
            $derajat_keanggotaan_ph = 1;
        }
    } else if ($linguistic_variable == "basa") {
        //check value of ph for basa rule
        if ($ph_value <= 8) {
            $derajat_keanggotaan_ph = 0;
        } else if ($ph_value >= 8 and $ph_value <= 8.5) {
            $derajat_keanggotaan_ph = (8.5 - $ph_value) / 0.5;
        } else if ($ph_value >= 8.5) {
            $derajat_keanggotaan_ph = 1;
        }
    }
    return $derajat_keanggotaan_ph;
}

function getInferensiKualitasAir($linguistic_variable, $alpha_predikat)
{
    if ($linguistic_variable == "buruk") {
        $result_inferensi = 0.5 - (0.5 * $alpha_predikat);
    } else if ($linguistic_variable == "cukup") {
        $result_inferensi = (0.5 * $alpha_predikat);
        $result_inferensi2 = 1 - (0.5 * $alpha_predikat);
    } else if ($linguistic_variable == "bagus") {
        $result_inferensi = 0.5 + (0.5 * $alpha_predikat);
    }

    if (isset($result_inferensi2)) {
        return (min($result_inferensi, $result_inferensi2));
    }
    return ($result_inferensi);
}

function countAverageWeighted($array_inferensi, $number_index)
{
    $sigma_alpha = 0;
    $sigma_alpha_inferensi = 0;
    for ($i = 0; $i < $number_index; $i++) {
        $sigma_alpha += $array_inferensi[$i][0];
        $sigma_alpha_inferensi += ($array_inferensi[$i][0] * $array_inferensi[$i][1]);
    }
    $average_weighted = $sigma_alpha_inferensi / $sigma_alpha;
    return $average_weighted;
}

function countFuzzy($tds_in_value, $ph_in_value)
{
    global $connect;
    $temp_defuzzyfikasi[][] = NULL;
    $index_array = 0;

    $query = "SELECT * FROM fuzzy_rules";
    $sql = mysqli_query($connect, $query);
    if ($sql) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $rule_code = $row['rule_code'];
            $derajat_tds = getDerajatKeanggotaanTds($row['linguistic_tds'], $tds_in_value);
            $derajat_ph = getDerajatKanggotaanPH($row['linguistic_ph'], $ph_in_value);
            $alpha_predikat = min($derajat_tds, $derajat_ph);
            $inferensi_quality = getInferensiKualitasAir($row['result_rule'], $alpha_predikat);

            /*echo "Kode aturan : ".$rule_code."<br>";
                echo "Derajat keanggotaan tds : ".$derajat_tds."<br>";
                echo "Derajat keanggotaan ph : ".$derajat_ph."<br>";
                echo "Alpha predikat : ".$alpha_predikat."<br>";
                echo "Hasil inferensi : ".$inferensi_quality."<br><br>";
                */

            $temp_defuzzyfikasi[$index_array][0] = $alpha_predikat;
            $temp_defuzzyfikasi[$index_array][1] = $inferensi_quality;

            $index_array++;
        }
        $defuzzyfikasi = countAverageWeighted($temp_defuzzyfikasi, $index_array);
        //final result of fuzzy
        return $defuzzyfikasi;
    }
}

function getFinalStatus($fuzzy_value)
{
    //buruk degree
    if ($fuzzy_value >= 0.5) {
        $derajat_buruk = 0;
    } else if ($fuzzy_value >= 0 and $fuzzy_value <= 0.5) {
        $derajat_buruk = (0.5 - $fuzzy_value) / 0.5;
    } else if ($fuzzy_value <= 0) {
        $derajat_buruk = 1;
    }

    //cukup degree
    if ($fuzzy_value <= 0 or $fuzzy_value >= 1) {
        $derajat_cukup = 0;
    } else if ($fuzzy_value >= 0 and $fuzzy_value <= 0.5) {
        $derajat_cukup = $fuzzy_value / 0.5;
    } else if ($fuzzy_value >= 0.5 and $fuzzy_value <= 1) {
        $derajat_cukup = (1 - $fuzzy_value) / 0.5;
    } else if ($fuzzy_value == 0.5) {
        $derajat_cukup = 1;
    }

    //baik degree
    if ($fuzzy_value <= 0.5) {
        $derajat_baik = 0;
    } else if ($fuzzy_value >= 0.5 and $fuzzy_value <= 1) {
        $derajat_baik = ($fuzzy_value - 0.5) / 0.5;
    } else if ($fuzzy_value >= 1) {
        $derajat_baik = 1;
    }

    $final_status = max($derajat_buruk, $derajat_cukup, $derajat_baik);
    if ($final_status == $derajat_buruk) {
        return "buruk";
    } else if ($final_status == $derajat_cukup) {
        return "cukup";
    } else if ($final_status == $derajat_baik) {
        return "baik";
    }
}

//$test_fuzzy = countFuzzy(230, 7);
//echo "berhasil".$test_fuzzy;
