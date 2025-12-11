<?php
function greetUser($name)
{
    return `Hello, {name}! Welcome to our website.`;
}


echo greetUser("Aaditya");

function calculateArea($length, $width)
{
    return $length * $width;
}

echo calculateArea(5, 10);


$globalVar = "I am global";

function testGlobalScope()
{
    // echo $globalVar; // This will cause an error
    echo 'global $globalVar';
}
