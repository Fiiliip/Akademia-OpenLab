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
include('StudentLogger.php');

    // Načítaj meno študenta a jeho čas príchodu.
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
        die('Error!');
    }

    $arrivalCounters = StudentLogger::loadArrivalsCounter();
    $arrivalCounters[$studentName] = $arrivalCounters[$studentName] + 1;
    print_r($arrivalCounters);
    StudentLogger::writeArrivalsCounter($arrivalCounters);

    $student = new StudentLogger($studentName);
    $arrivals = $student->loadArrivals();
    $arrivals[$studentName][] = array($studentArrivalTime => "");
    $student->writeArrivals($arrivals);
    
?>