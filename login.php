<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Authorization');
header('Content-Type: application/json;charset=utf-8');

require 'includes/autoloader.php';
use Classes\Database as Database;
use Classes\Helpers as Helper;
$headers = getallheaders();

$db = new Database();
$helper = new Helper();
$connection = $db->connect();

$username = $helper->cleanString($_POST['username']);
$password = $helper->cleanString($_POST['password']);

$command = 'SELECT id, first_name, last_name, username, password, user_level FROM users WHERE BINARY username = ?';
$statement = $connection->prepare($command);
$statement->bind_param('s', $username);
$statement->bind_result(
    $id,
    $first_name,
    $last_name,
    $username,
    $user_password,
    $user_level
);

$statement->execute();
$statement->store_result();
$total_count = $statement->num_rows;
$statement->fetch();

if ($total_count > 0) {
    if (password_verify($password, $user_password)) {
        $date_added = date("Y-m-d H:i:s");
        $token = password_hash($user_password, PASSWORD_DEFAULT);
        $encrypted_id = $helper->ssl_encrypt($result[0]["id"], SSL_KEY, HASH_PASSWORD_KEY);
        $_SESSION['id'] = $encrypted_id;
        $_SESSION['token'] = $token;
        $_SESSION['level'] = $user_level;
        $helper->response_now([
            'status' => "success",
            'level' => $user_level,
            'id' => $encrypted_id,
            'token' => $token
        ]);
    } else {
        $helper->response_now([
            'status' => "failed",
        ]);
    }
} else {
    $helper->response_now([
        'status' => "failed",
    ]);
}
?>