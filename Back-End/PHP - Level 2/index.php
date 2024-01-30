<?php
    $currentDateTime = date("H:i:s d.m.Y", rand(0, time())); // Náhodný dátum a čas pre lepšiu simuláciu.
?>

<!DOCTYPE html>
<html lang="sk-SK">
<head>
    <meta charset="utf-8">
    <title>Logovač príchodov študentov</title>
</head>
<body>
    <p>Aktuálny čas: <?php echo($currentDateTime); ?></p>
    <form action='index.php' method='post'>
        <input type='text' name='studentName' placeholder='Meno študenta'>
        <input type='submit' value='Zapísať študenta'>
    </form>
</body>
</html>

<?php
include('Student.php');

    if (isset($_GET['studentName']) && $_GET['studentName'] != "") 
    {
        $studentName = $_GET['studentName'];
        $studentArrivalTime = $currentDateTime;
    } else if (isset($_POST['studentName']) && $_POST['studentName'] != "")
    {
        $studentName = $_POST['studentName'];
        $studentArrivalTime = $currentDateTime;
    } else 
    {
        die();
    }

    $students = Student::getStudentsFromJSON();

    foreach ($students as $student)
    {
        if ($student['name'] == $studentName) {

        }
    }

?>

<?php

    // class Student {
    //     public $name;
    //     public $arrivalCounter;
    // }

    // if (isset($_GET['studentName']) && $_GET['studentName'] != "")
    // {
    //     $studentName = $_GET['studentName'];
    //     $studentArrivalTime = $currentDateTime;
    // } 
    // else if (isset($_POST['studentName']) && $_POST['studentName'] != "")
    // {
    //     $studentName = $_POST['studentName'];
    //     $studentArrivalTime = $currentDateTime;
    // }

    // $student = new Student();
    // $student->name = $studentName;
    // $student->arrivalCounter = 1;
    
    // writeToJSON($student);

    // /////////////////////////////////////////

    // function writeToJSON($content)
    // {
    //     $studentExists = false;
    //     if (file_exists('studenti.json'))
    //     {
    //         $content = file_get_contents('studenti.json');
    //         $content = json_decode($content);

    //         print_r($content);

    //         for ($i = 0; $i < count($content); $i++)
    //         {
    //             if ($content[$i]->name == $content->name)
    //             {
    //                 $studentExists = true;
    //                 $content[$i]->arrivalCounter += 1;
    //                 break;
    //             }
    //         }
    //     }

    //     if (!$studentExists)
    //     {
    //         array_push($content, $content);
    //     }

    //     file_put_contents('studenti.json', $content);
    // }

?>