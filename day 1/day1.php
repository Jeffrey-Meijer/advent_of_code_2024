<?php

$left_array = [];
$right_array = [];
$results = 0;

$fp = fopen("day1.txt", "r");

if ($fp) {
    while(($buffer = fgets($fp, 4096)) !== false) {
        $splitStr = explode(" ", $buffer);

        $left_array[] = (int) $splitStr[0];
        $right_array[] = (int) $splitStr[3];
    }

    if (!feof($fp)) {
        echo "Error!";
    }

    fclose($fp);


    // Handle left and right array logic

    sort($left_array);
    sort($right_array);

    while(count($left_array) && count($right_array)) {
        $left = array_pop($left_array);
        $right = array_pop($right_array);

        $results += abs($left - $right);

    }

    echo $results;

}