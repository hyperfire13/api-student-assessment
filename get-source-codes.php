<?php
header('Access-Control-Allow-Origin: *');
require 'includes/autoloader.php';

use Classes\Database as Database;
use Classes\Helpers as Helper;
// use Models\SourceCode as SourceCode;

$db = new Database();
$database = $db->connect();

$selectedSubject = $_POST['selectedSubject'];
$selectedModule = $_POST['selectedModule'];
$selectedSection = $_POST['selectedSection'];

echo $selectedSubject;


  
    // if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES['file']['name'])) {
    //     echo "done";
    //     exit;
    // }
  
    
?>