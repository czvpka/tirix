<?php
    require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";

    function checkSms($code, $number) {
        $api=file_get_contents("https://lvlup.pro/api/checksms?id=".$user['id']."&code=".$code."&number=".$number);
        $json = json_decode($api);

        if ($json->valid) {
            return true;
        } else {
            return false;
        }
    }
?>
