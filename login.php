<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json;charset=utf-8');
require 'includes/autoloader.php';
$pogi = [
    'fname' => 'ken',
    'lname' => 'yba',
];
echo json_encode($pogi);
?>