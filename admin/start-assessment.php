<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Authorization');
header('Content-Type: application/json;charset=utf-8');
require dirname(__DIR__) . '/includes/autoloader.php';

use Classes\Database as Database;
use Classes\Helpers as Helper;
use Models\Token as Token;

$headers = getallheaders();
$db = new Database();
$helper = new Helper();
$connection = $db->connect();
$tokenChecker = new Token($connection);

$userid = $helper->cleanNumber($_POST['userId']);
$token = $_POST['token'];
$schoolYear = $_POST['selectedYear'];

if ($tokenChecker->checkToken($userid, $token) === false) {
    $helper->response_now(null, null, [
        'status' => "failed",
    ]);
}
// move file
$code = rand(10000,99999);
$date_added = date("YmdHis");
$fileExtension =  pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$newFileName = $code. '-' . $schoolYear . '-' . $date_added. '-' . 'basefile.';
$filePath = '../upload/' . $newFileName . $fileExtension;
if (!move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
    $helper->response_now(null, null, [
        'status' => "failed_moving_file",
    ]);
}
$helper->response_now(null, null, [
    'status' => "success",
]);
?>