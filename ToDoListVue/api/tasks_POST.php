<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
    // whitelist of safe domains
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}

// if (!isset($_POST)) {
//     echo('Dáta sú prázdne.');
//     return;
// }

$json = file_get_contents('php://input');
$data = json_decode($json);

if (!isset($data)) {
    echo('Chýbajúce dáta. Dáta sú prázdne.');
    http_response_code(422);
    return;
}

$tasks = $data->tasks;

if (!isset($tasks)) {
    echo('Chýbajúce dáta. Pole úloh je prázdne.');
    http_response_code(422);
    return;
}

foreach ($tasks as $task) {
    foreach ($task as $key => $value) {
        // Pretože v JSON súbore je hodnota kľúča 'done' typu boolean, tak sa musí porovnávať s hodnotou 'false' a nie s hodnotou '0' alebo '1'.
        // Inak by funkcia empty() vracala hodnotu 'true' pre hodnotu 'false'.
        if ($value == false) {
            continue;
        }

        if (empty($value)) {
            echo('Chýbajúce dáta. Hodnota kľúča ' . $key . ' je prázdna.');
            http_response_code(422);
            return;
        }
    }
}

// Pretypovanie objektov na pole.
for ($i = 0; $i < count($tasks); $i++) {
    $tasks[$i] = (array)$tasks[$i];
}

$temp = $tasks;

$tasks = loadTasksFromJSON();

$tasks = array_merge($tasks, $temp);

for ($i = 0; $i < count($tasks); $i++) {
    $tasks[$i]['id'] = $tasks[count($tasks) - 1]['id'] + $i;
}

foreach ($tasks as $task) {
    utf8_encode($task['title']);
}

$data = array(
    'tasks' => $tasks
);

$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
file_put_contents('data.json', $json);

http_response_code(200);
echo('Úlohy boli úspešne uložené.');
exit;

function loadTasksFromJSON() {
    $json = file_get_contents('data.json');
    $data = json_decode($json, true);

    $tasks = [];

    if (!isset($data)) {
        echo('Dáta v existujúcom súbore sú prázdne.');
        return $tasks;
    }

    $tasks = $data['tasks'];

    if (!isset($tasks)) {
        echo('Pole úloh v existujúcom súbore sú prázdne.');
        return $tasks;
    }

    return $tasks;
}

?>