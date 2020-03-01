<?php
require_once 'functions.php';
$with_search = isset($_GET['filter']) && !empty($_GET['filter']);

$query = "SELECT 
    car_brands.id,
    car_brands.name,
    car_brand_models.name AS model_name
 FROM car_brands 
 JOIN car_brand_models ON car_brand_models.car_brand_id = car_brands.id";

if($with_search) {
    $query .= " WHERE car_brands.name LIKE :search_value OR car_brand_models.name LIKE :search_value;";
}

$dbh = getDBConnect();
$query_obj = $dbh->prepare($query);

if($with_search) {
    $result = $query_obj->execute([
        'search_value' => '%' . $_GET['filter'] . '%',
        'search_value' => '%' . $_GET['filter'] . '%'
    ]);

} else {
    $result = $query_obj->execute();
}

$car_brands = $query_obj->fetchAll();


echo json_encode($car_brands);
