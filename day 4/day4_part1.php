<?php

function findXMASOccurrences($matrix, $words = ["XMAS", "SAMX"]) {
    $rows = count($matrix);
    $cols = count($matrix[0]);
    $wordLength = strlen($words[0]);
    $occurrences = [];

    // Directions for moving in the matrix (right, down, diagonal-right-down, diagonal-right-up)
    $directions = [
        [0, 1],   // Horizontal (right)
        [1, 0],   // Vertical (down)
        [1, 1],   // Diagonal-right-down
        [-1, 1],  // Diagonal-right-up
    ];

    // Check all positions in the matrix
    for ($row = 0; $row < $rows; $row++) {
        for ($col = 0; $col < $cols; $col++) {
            // Try each direction
            foreach ($directions as [$dr, $dc]) {
                foreach ($words as $word) {
                    $found = true;
                    $positions = [];

                    // Check for the word in the current direction
                    for ($k = 0; $k < $wordLength; $k++) {
                        $r = $row + $k * $dr;
                        $c = $col + $k * $dc;

                        if ($r < 0 || $r >= $rows || $c < 0 || $c >= $cols || $matrix[$r][$c] !== $word[$k]) {
                            $found = false;
                            break;
                        }
                        $positions[] = [$r, $c];
                    }

                    if ($found) {
                        $occurrences[] = [
                            "word" => $word,
                            "positions" => $positions,
                        ];
                    }
                }
            }
        }
    }

    return $occurrences;
}

function readMatrixFromFile($filename) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return array_map('str_split', $lines);
}

$filename = "day4.txt";

if (!file_exists($filename)) {
    die("File $filename not found.\n");
}

$matrix = readMatrixFromFile($filename);
$occurrences = findXMASOccurrences($matrix);

// Output the results
foreach ($occurrences as $index => $occurrence) {
    echo "Occurrence " . ($index + 1) . ": Word \"{$occurrence['word']}\"" . PHP_EOL;
}
