<?php

require 'includes/autoloader.php';

use Classes\Database as Database;
use Models\SourceCode as SourceCode;

// // $db = new Database();
// // $database = $db->connect();
// // $sourceCode = new SourceCode($database);
// // $page = $_GET['page'];
// // $size = $_GET['size'];
// // $class = $_GET['class'];
// // $result = $sourceCode->getSourceCodes($page, $size, $class);
// echo 'pogi mo kenneth';

header('Access-Control-Allow-Origin: *');
  
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES['file']['name'])) {
        echo "done";
        exit;
    }
  
    echo "failed";
?>