<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Authorization');
header('Content-Type: application/json;charset=utf-8');

// require 'includes/autoloader.php';
// use Classes\Database as Database;
// use Classes\Helpers as Helper;
// $headers = getallheaders();

// $db = new Database();
// $helper = new Helper();
// $connection = $db->connect();

// $username = $helper->cleanString($_POST['username']);
// $password = $helper->cleanString($_POST['password']);

?>