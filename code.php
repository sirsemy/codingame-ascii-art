<?php
function splitAsciiChars($height, $width)
{
    $asciiArtChars = [];

    for ($i = 0; $i < $height; $i++) {
        $row = stream_get_line(STDIN, 1024 + 1, "\n");
        $splittedRow = str_split($row, $width);
        $lineSize = count($splittedRow);

        for ($j = 0; $j < $lineSize; $j++) {
            $asciiArtChars[$j][] = $splittedRow[$j];
        }
    }

    return $asciiArtChars;
}

function collectInputTextCharKeys($charsToDisplay, $charSet)
{
    $textKeys = [];

    foreach ($charsToDisplay as $char) {
        $isFound = array_search($char, $charSet);

        if ($isFound !== false) {
            $textKeys[] = $isFound;
            continue;
        }

        $textKeys[] = array_key_last($charSet);
    }

    return $textKeys;
}

function collectAsciiArtChars($textKeys, $asciiArtChars)
{
    $asciiArtText = [];

    foreach ($textKeys as $key) {
        $asciiArtText[] = $asciiArtChars[$key];
    } 

    return $asciiArtText;
}

$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ?";
$charSet = str_split($chars);

fscanf(STDIN, "%d", $width);
fscanf(STDIN, "%d", $height);
$inputText = stream_get_line(STDIN, 256 + 1, "\n");

$charsToDisplay = str_split(strtoupper($inputText));

$asciiArtChars = splitAsciiChars($height, $width);
$textKeys = collectInputTextCharKeys($charsToDisplay, $charSet);
$asciiArtText = collectAsciiArtChars($textKeys, $asciiArtChars);

for ($i = 0; $i < $height; $i++) {
    $resultLine = "";

    foreach ($asciiArtText as $charLine) {
        $resultLine .= $charLine[$i];
    }

    echo("$resultLine\n");
}
?>
