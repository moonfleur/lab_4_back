<?php
require_once 'functions.php';

$dbh = getDBConnect();
$query_obj = $dbh->prepare("SELECT * FROM car_brands");
$result = $query_obj->execute();

$car_brands = $query_obj->fetchAll();

echo json_encode($car_brands);