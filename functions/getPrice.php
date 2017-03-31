<?php
    function getPrice($number) {
        if ($number == "70068") {
            return "0,62 PLN";
        } elseif ($number == "71068") {
            return "1,23 PLN";
        } elseif ($number == "72068") {
            return "2,46 PLN";
        } elseif ($number == "74068") {
            return "4,92 PLN";
        } elseif ($number == "76068") {
            return "7,38 PLN";
        } elseif ($number == "91058") {
            return "12,30 PLN";
        } elseif ($number == "91758") {
            return "20,91 PLN";
        } elseif ($number == "92058") {
            return "24,60 PLN";
        } elseif ($number == "92578") {
            return "30,75 PLN";
        } else {
            return false;
        }
    }
?>