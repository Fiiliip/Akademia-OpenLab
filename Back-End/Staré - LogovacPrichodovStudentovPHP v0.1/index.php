<!DOCTYPE html>
<html lang="sk-SK">
<head>
    <meta charset="utf-8">
    <title>Logovač príchodov študentov</title>
</head>
<body>
    <form action='index.php' method='post'>
        <input type='text' name='studentName' placeholder='Meno študenta'>
        <input type='submit' value='Zapísať študenta'>
    </form>
</body>

<?php
include("Student.php");

// Vygeneruje náhodný dátum.
$currentDate = date("d-m-Y", rand(0, time())); // Vráti napr. "23-07-2021"

// Vytvorí novú inštanciu objektu triedy Student.
$student = new Student();
$student->setArrivalTime(generateArrivalTime());

// Získa meno študenta buď z POST dát (formulár) alebo z GET dát (url).
if (isset($_POST['studentName']) && $_POST['studentName'] != "") { // isset($_POST['studentName']) zistí, či je v POST dáta premennej studentName
    $student->name = $_POST['studentName'];
} else if (isset($_GET['meno']) && $_GET['meno'] != "") {
    $student->name = $_GET['meno']; // www.nazovWebstranky.sk/index.php?meno=Filip
} else {
    die("Nebolo zadané meno študenta!");
}

$students = [];

// Skontroluje, či existuje súbor students.json a ak áno, tak ho načíta.
if (file_exists("students.json")) {
    $studentsJSON = file_get_contents("students.json");
    $students = json_decode($studentsJSON, JSON_UNESCAPED_UNICODE);
}

for ($i = 0; $i < count($students); $i++) {
    $students[$i] = (object) $students[$i]; // Konvertuje pole na objekt.
}

print_r($students);

// Skontroluje, či už študent existuje v zozname študentov.
// Ak študent existuje, tak sa mu pridá príchod.
$studentExists = false;
for ($i = 0; $i < count($students); $i++) {
    if ($students[$i]->name == $student->name) {
        $studentExists = true;
        $student->addArrival();
        $students[$i] = $student;
        break;
    }
}

// Ak študent neexistuje v zozname, tak sa pridá do zoznamu.
if (!$studentExists) {
    $student->addArrival();
    $students[] = $student;
}

// Uloží študenta do JSON súboru.
$studentJSON = json_encode($students, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
file_put_contents("students.json", $studentJSON);

$wasStudentLate = date("H", strtotime($student->getArrivalTime())) >= 8; // strtotime($randomDate) vráti timestamp, ktorý je potrebný pre date()

if (date("H", strtotime($student->getArrivalTime())) >= 20 && date("H", strtotime($student->getArrivalTime())) <= 24) {
    die("Študent prišiel neskoro! Nemožno ho zapísať do zoznamu!");
} else {
    writeToFile("log.txt", $student->name . " - " . $student->getArrivalTime(), $wasStudentLate);
    echo readFromFile("log.txt");
}

// ----------------- Funkcie -----------------

function generateArrivalTime() {
    return date("H:i:s", rand(0, time())); // vráti napr. "23:07:01"
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
?>