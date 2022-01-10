<?php
header('Access-Control-Allow-Origin: *');
require 'includes/autoloader.php';

// use Classes\Database as Database;
// use Classes\Helpers as Helper;
// use Models\AssessmentResults as AssessmentResults;

// $db = new Database();
// $helper = new Helper();
// $database = $db->connect();
// $assessmentResult = new AssessmentResults($database);

// $selectedSubject = $helper->cleanNumber($_POST['selectedSubject']);
// $selectedModule = $helper->cleanNumber($_POST['selectedModule']);
// $selectedSection = $helper->cleanNumber($_POST['selectedSection']);

$command_exec = escapeshellcmd('training.py');
$str_output = shell_exec($command_exec);
echo var_dump($str_output) ;

/********
 * 
 * machine learning section
 * 
******end of machine learning section*/

// $fileExtension =  pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
// $filePath = "upload/" . 'dindin.' . $fileExtension;

// if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
//     $assessmentDetails = [
//       'selectedSubject' => $selectedSubject,
//       'creatorId' => 99,
//       'selectedModule' => $selectedModule,
//       'selectedSection' => $selectedSection,
//       'filePath' => $filePath,
//     ];
//     $result = $assessmentResult->insertAssessmentResultDetails($assessmentDetails);
//     echo $result;
// }
?>