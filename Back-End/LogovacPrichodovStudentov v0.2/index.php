<?php

echo("Ahoj!<br><br>");

///////////////////////////////////////////

$currentDate = date("H:i:s d.m.Y");
echo("Aktuálny čas: " . $currentDate);

$studentArrivalTime = generateRandomDate();
echo("<br>Čas príchodu študenta: " . $studentArrivalTime . "<br>");

///////////////////////////////////////////

// Write $currentDate to file. If file exists, append to it.
$currentDateFile = fopen("currentDate.txt", "a");
fwrite($currentDateFile, $currentDate . "\n");
fclose($currentDateFile);

// Read from currentDate.txt file line by line.
$currentDateFile = fopen("currentDate.txt", "r");
echo("<br>Obsahu súboru 'currentDate.txt':");
while (!feof($currentDateFile)) {
    echo("<br>" . fgets($currentDateFile));
}
fclose($currentDateFile);

///////////////////////////////////////////

// Read from studentArrivalTime.txt file line by line.
$studentArrivalTimesContent = readFromFile("studentArrivalTime.txt");
if ($studentArrivalTimesContent == null) {
    echo("Súbor studentArrivalTime.txt je prázdny!");
} else {
    echo("<br>Obsah súboru 'studentArrivalTime.txt':");
    for ($i = 0; $i < count(explode("\n", $studentArrivalTimesContent)); $i++) {
        echo("<br>" . explode("\n", $studentArrivalTimesContent)[$i]);
    }
}

// If student arrived between 20:00 and 24:00, don't write to file.
if (date("H", strtotime($studentArrivalTime)) >= 20 && date("H", strtotime($studentArrivalTime)) <= 24) {
    die("<br>Časový záznam nemožno zapísať do súboru!<br>");
}

$wasStudentLate = date("H", strtotime($studentArrivalTime)) >= 8;
$studentArrivalTimeFile = appendToFile("studentArrivalTime.txt", $studentArrivalTime, $wasStudentLate);

///////////////////////////////////////////

function generateRandomDate() {
    $randomDate = date("H:i:s d.m.Y", rand(0, time())); // Vráti napr. "23:07:01 17.02.2023"
    return $randomDate;
}

function appendToFile($fileName, $content, $wasStudentLate) {
    if ($wasStudentLate) {
        $content .= " - meškanie";
    }

    file_put_contents($fileName, $content . "\n", FILE_APPEND);
}

function readFromFile($fileName) {
    if (!file_exists($fileName)) {
        echo("<br>Súbor " . $fileName . " neexistuje!<br>");
        return;
    }
    
    return file_get_contents($fileName);
}