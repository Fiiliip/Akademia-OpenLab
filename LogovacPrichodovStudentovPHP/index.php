<?php
// echo "Hello World!\n";

// // Dátum a čas rôzne formáty:
// // 17.02.2023 16:18:23 => d-m-Y H:i:s
// // Fri.10.23 => D-m-y H:i:s
// // 17.Feb.2023 04:18:23 => d.M.Y h:i:s
// $currentDateTime = date("d-m-Y H:i:s");
// echo $currentDateTime . "\n";

// // Zapíš aktuálny dátum a čas do súboru.
// writeToFile("log.txt", $currentDateTime);

// // Načítaj obsah súboru a vypíš ho na stránku.
// echo readFromFile("log.txt");

$studentArrival = simulateStudentArrival();
$wasStudentLate = date("H", strtotime($studentArrival)) >= 8; // strtotime($randomDate) vráti timestamp, ktorý je potrebný pre date()

if (date("H", strtotime($studentArrival)) >= 20 && date("H", strtotime($studentArrival)) <= 24) {
    die("Študent prišiel neskoro! Nemožno ho zapísať do zoznamu!");
} else {
    writeToFile("log.txt", $studentArrival, $wasStudentLate);
    echo readFromFile("log.txt");
}

// ----------------- Funkcie -----------------

function simulateStudentArrival() {
    return date("d-m-Y H:i:s", rand(0, time())); // vráti napr. "23-07-2001 23:07:01"
}

function writeToFile($fileName, $content, $wasStudentLate) {
    if ($wasStudentLate) {
        $content .= " - <span style='color: red'>meškanie</span>";
    }

    $content .= "<br>";

    $myfile = fopen($fileName, "a") or die("Unable to open file!");
    fwrite($myfile, $content . "\n");
    fclose($myfile);
}

function readFromFile($fileName) {
    $myfile = fopen($fileName, "r") or die("Unable to open file!");
    $fileContent = fread($myfile, filesize($fileName));
    fclose($myfile);
    
    return $fileContent;
}
?>