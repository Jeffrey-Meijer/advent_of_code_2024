<?php

$testData = "xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))";

// Read the content of the file
$data = file_get_contents("day3.txt");

// Initialize variables
$enabled = true; // Flag to track if multiplication is enabled
$results = 0; // Final sum of valid multiplications

// Function to extract all matches for do(), don't(), and mul(x,x)
function getAllMatches($data)
{
    $pattern = '/don\'t\(\)|do\(\)|mul\(\d{1,3},\d{1,3}\)/';
    preg_match_all($pattern, $data, $matches);
    return $matches[0];
}

// Function to extract numbers from a mul(x,x) match
function getMultiplicationNumbers($multiplication)
{
    $pattern = '/\d{1,3}/';
    preg_match_all($pattern, $multiplication, $matches);
    return $matches[0];
}

// Process all matches
$matches = getAllMatches($data);

foreach ($matches as $match) {
    if ($match === "don't()") {
        $enabled = false; // Disable multiplication
    } elseif ($match === "do()") {
        $enabled = true; // Enable multiplication
    } elseif ($enabled && preg_match('/mul\(\d{1,3},\d{1,3}\)/', $match)) {
        // Process mul(x,x) only if enabled
        $numbers = getMultiplicationNumbers($match);
        $results += (int)$numbers[0] * (int)$numbers[1];
    }
}

// Output the result
echo "The multiplication result is: " . $results . PHP_EOL;
