<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$string = json_encode(loadTasksFromJSON(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
if ($string != "null") {
    echo($string);
}

function loadTasksFromJSON() {
    $json = file_get_contents('data.json');
    $data = json_decode($json, true);

    if (!isset($data)) {
        echo('Chýbajúce dáta. Dáta sú prázdne.');
        http_response_code(422);
        return;
    }

    $tasks = $data['tasks'];

    if (!isset($tasks)) {
        echo('Chýbajúce dáta. Pole úloh je prázdne.');
        http_response_code(422);
        return;
    }

    return $tasks;
}

?>