<?php
require_once 'functions.php';

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode([
        'status' => 'error',
        'messages' => ['Запит типу GET не підтримується!']
    ]);

    die;
}

function validate() {
    $errors = [];

    if (!isset($_POST['name']) || strlen($_POST['name']) < 2 || strlen($_POST['name']) > 50) {
        $errors[] = 'Невалідна назва бренду';
    } else {
        $dbh = getDBConnect();
        $prepare_query = $dbh->prepare('SELECT * FROM car_brands WHERE name = :name LIMIT 1');
        $result = $prepare_query->execute(['name' => $_POST['name']]);
        $car_brand = $prepare_query->fetch();

        if(!empty($car_brand)) {
            $errors[] = 'Бренд з таким іменем вже існує!';
        }
    }

    if(count($errors) > 0) {
        return [
            'status' => 'error',
            'messages' => $errors
        ];
    } else {
        return ['status' => 'success'];
    }
}

$validate_result = validate();

if($validate_result['status'] == 'error') {
    echo json_encode($validate_result);
    die;
}

$dbh = getDBConnect();
$query_obj = $dbh->prepare("INSERT INTO car_brands (name) VALUES (:name)");
$result = $query_obj->execute([
    'name' => $_POST['name']
]);


if($result) {
    $last_insert_id = $dbh->lastInsertId();

    echo json_encode([
        'status' => 'success',
        'messages' => ['Збережено!'],
        'id' => $last_insert_id
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'messages' => ['Помилка!']
    ]);
}