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

    $brand_is_valid = true;
    if(!isset($_POST['car_brand_id']) || (int) $_POST['car_brand_id'] == 0) {
        $errors[] = 'Невалідний бренд!';
        $brand_is_valid = false;
    } else {
        $dbh = getDBConnect();
        $prepare_query = $dbh->prepare('SELECT * FROM car_brands WHERE id = :car_brand_id LIMIT 1');
        $result = $prepare_query->execute(['car_brand_id' => (int) $_POST['car_brand_id']]);
        $car_brand = $prepare_query->fetch();

        if(empty($car_brand)) {
            $errors[] = 'Вказаний бренд не був знайдений!';
            $brand_is_valid = false;
        }
    }

    if (!isset($_POST['name']) || strlen($_POST['name']) < 1 || strlen($_POST['name']) > 50) {
        $errors[] = 'Невалідна назва моделі';


        print_r('123');
    } else if($brand_is_valid) {
        $dbh = getDBConnect();
        $prepare_query = $dbh->prepare('SELECT * FROM car_brand_models WHERE name = :name AND car_brand_id = :car_brand_id LIMIT 1');
        $result = $prepare_query->execute([
            'car_brand_id' => $_POST['car_brand_id'],
            'name' => $_POST['name']
        ]);
        $car_brand_model = $prepare_query->fetch();

        if(!empty($car_brand_model)) {
            $errors[] = 'Модель з таким іменем вже існує!';
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
$query_obj = $dbh->prepare("INSERT INTO car_brand_models (car_brand_id, name) VALUES (:car_brand_id, :name)");
$result = $query_obj->execute([
    'car_brand_id' => $_POST['car_brand_id'],
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