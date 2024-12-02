<?php
enum Type {
    case UNKNOWN;
    case STAGNANT;
    case INCREASING;
    case DECREASING;
    case INVALID;
}

function setFlowType(&$currentType, Type $type) {
    if ($currentType == Type::UNKNOWN) {
        $currentType = $type;
    } else if ($currentType != $type) {
        $currentType = Type::INVALID;
    }
}


$fp = fopen("day2.txt", "r");

$validReports = 0;

if ($fp) {
    // Read through the file line by line
    while(($buffer = fgets($fp, 4096)) !== false) {
        $type = Type::UNKNOWN; // Set initial type to UNKNOWN as it is not yet known
        $currentRow = explode(" ", $buffer); // Explode the current row into an array of strings
        foreach($currentRow as $i => $element) { // Loop through array
            // Check if next element is gonna be more or less and set the type accordingly
            if ($i < count($currentRow)-1) { // If current count is less than the maximum amount in the array
                if (((int)$element < (int)$currentRow[$i+1])) {
                    if ((int)$element - (int)$currentRow[$i+1] >= -3) {
                        setFlowType($type, Type::INCREASING);
                    } else {
                        setFlowType($type, Type::INVALID);
                    }
                }
                else if (((int)$element > (int)$currentRow[$i+1])) {
                    if ((int)$element - (int)$currentRow[$i+1] <= 3) {
                        setFlowType($type, Type::DECREASING);
                    } else {
                        setFlowType($type, Type::INVALID);
                    }
                } else {
                    setFlowType($type, Type::STAGNANT);
                }
                if ($type == Type::INVALID) break;
            }


        }
        if ($type != Type::INVALID && $type != Type::STAGNANT) {
            $validReports++;
        }
    }

    if (!feof($fp)) {
        echo "Error!";
    }

    fclose($fp);

    echo "The amount of safe reports is: " . $validReports . PHP_EOL;
}