<?php

$moduleName = "FullStack Development with PHP";

echo strlen($moduleName); // Outputs the length of the string
echo str_word_count($moduleName); // Outputs the number of words in the string
echo strrev($moduleName); // Outputs the reversed string
echo strpos($moduleName, "PHP"); // Outputs the position of "PHP"
str_replace("PHP", "JavaScript", $moduleName); // Replaces "PHP" with "JavaScript"



$fruits = "Apple,Banana,Grapes,Orange";
$fruitsArray = explode(",", $fruits); // Splits the string into an array
print_r($fruitsArray); // Outputs the array of fruits

foreach ($fruitsArray as $key => $value) {
    echo "Fruit " . $key . ": " . $value . "\n";
}

$fruitsString = implode(" | ", $fruitsArray); // Joins the array back into a string

$formString = '<script>alert("Hack");</script> Welcome';
$safeFormString = htmlspecialchars($formString);

$helloWorld = " Hello World ";
$trimmedHelloWorld = trim($helloWorld);

echo 'Before Trim: "' . $helloWorld . '" After Trim: "' . $trimmedHelloWorld . '"';
