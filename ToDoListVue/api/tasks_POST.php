<?php
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    header('Access-Control-Max-Age: 86400');

    http_response_code(200);

    return;
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


// Získaj dáta z request-u.
$json = file_get_contents('php://input');
$data = json_decode($json);

if (!isset($data)) {
    echo('Chýbajúce dáta: Dáta sú prázdne.');
    http_response_code(422);
    return;
}

$tasks = $data->tasks;

if (!isset($tasks)) {
    echo('Chýbajúce dáta: Pole úloh je prázdne.');
    http_response_code(422);
    return;
}

foreach ($tasks as $task) {
    foreach ($task as $key => $value) {
        // V JSON môže byť boolean hodnota kľúča "completed" nastavená na "false". V takomto prípade, kedy
        // by sme skontrolovali danú hodnotu cez metódu empty(), tak by nám vrátila hodnotu 'true', pretože
        // hodnota "false" sa berie ako práznda.
        if ($value == false) {
            continue;
        }

        if (empty($value)) {
            echo('Chýbajúce dáta: Hodnota kľúča ' . $key . ' je prázdna.');
            http_response_code(422);
            return;
        }
    }
}

// Pretypovanie objektov na pole.
for ($i = 0; $i < count($tasks); $i++) {
    $tasks[$i] = (array)$tasks[$i];
}

// $temp = $tasks;

// $tasks = loadTasksFromJSON();

// Odstráň duplikáty úloh.
// for ($i = 0; $i < count($tasks); $i++) {
//     for ($j = 0; $j < count($temp); $j++) {
//         if ($tasks[$i]['id'] == $temp[$j]['id']) {
//             if ($tasks[$i]['completed'] != $temp[$j]['completed']) {
//                 $tasks[$i]['completed'] = $temp[$j]['completed'];
//             }
//             unset($temp[$j]);
//             $temp = array_values($temp);
//         }
//     }
// }

// $tasks = array_merge($tasks, $temp);

// Pre-indexuj úlohy od 1.
// for ($i = 0; $i < count($tasks); $i++) {
//     $tasks[$i]['id'] = $tasks[count($tasks) - 1]['id'] + $i;
// }

$data = array(
    'tasks' => $tasks
);

// Zapíš dáta do JSON súboru.
$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
file_put_contents('data.json', $json);

http_response_code(200);
echo('Úlohy boli úspešne uložené.');
exit;

// ---------------------------------------------

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