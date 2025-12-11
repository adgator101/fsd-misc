<?php

$noteFile = fopen("note.txt", "w");
fwrite($noteFile, "Hello World!\nThis is a sample note.");
fclose($noteFile);

$fileTexts = fread($noteFile, filesize("note.txt"));

echo $fileTexts . "<br>";
while (!feof($noteFile)) {
    $line = fgets($noteFile);
    echo $line . "<br>";
}

fclose($noteFile);


$noteFile = fopen("note.txt", "a");
fwrite($noteFile, "\n Appended via PHP Tutorial.");
fclose($noteFile);


$noteFile = fopen("note.txt", "r");
$allTexts = fread($noteFile, filesize("note.txt"));
echo $allTexts;

fclose($noteFile);
