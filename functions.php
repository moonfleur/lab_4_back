<?php

global $dbh;

init();

function init() {
    header('Access-Control-Allow-Origin: *');
    session_start();
}

function getDBConnect($host = null, $dbname = null, $user = null, $pass = null) {
    $host = $host ? $host : 'localhost';
    $dbname = $dbname ? $dbname : 'lab4';
    $user = $user ? $user : 'root';
    $pass = $pass ? $pass : '';
    $params = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try {
        $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass, $params);
    } catch (PDOException $e) {
        die('Не вдалось підключитись до бази данних!');
    }

    return $dbh;
}