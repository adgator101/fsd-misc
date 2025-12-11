<?php

try {
    $num1 = 10;
    $num2 = 0;

    $result = $num1 / $num2;
    echo "The result is: " . $result;
} catch (\Throwable $th) {
    echo "Error: Division by zero is not allowed.";
}
