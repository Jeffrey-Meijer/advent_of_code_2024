<?php


$testData = "xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))";

$data = file_get_contents("day3.txt");

$results = 0;

function getAllMultiplications($data) {
    $pattern = '/mul\(\d{1,3},\d{1,3}\)/';

    preg_match_all($pattern, $data, $matches);

    return $matches[0];
}

function getMultiplcationNumbers($data) {
    $pattern = '/\d{1,3}/';

    preg_match_all($pattern, $data, $matches);

    return $matches[0];
}


$multiplications = getAllMultiplications($data);


foreach($multiplications as $multiplication) {
    $numbers = getMultiplcationNumbers($multiplication);

    $results += (int)$numbers[0] * (int)$numbers[1];
}

echo "The multiplication result is: " . $results. PHP_EOL;
