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

// $command_exec = escapeshellcmd('python python-codes/training.py');
// $str_output = shell_exec($command_exec);
// echo var_dump($str_output) ;

/********
 * 
 * machine learning section
 * 
******end of machine learning section*/

$fileExtension =  pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$filePath = "upload/" . 'sshheesshh.' . $fileExtension;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
    $assessmentDetails = [
      'selectedSubject' => 11,
      'creatorId' => 99,
      'selectedModule' => 22,
      'selectedSection' => 33,
      'filePath' => $filePath,
    ];
    $result = $assessmentResult->insertAssessmentResultDetails($assessmentDetails);
    echo $result;
}

// csv file filtering
// $existingRecord = [];
// $fileName = "upload/" . 'Students-Profile-Responses - Form Responses 1.csv';
// if (file_exists($fileName)) {
//     if (($handle = fopen($fileName, "r")) !== FALSE) { 
//         while (($data = fgetcsv($handle)) !== FALSE) {
//             $existingRecord[] = $data;
//             unset($existingRecord[0]);
//         }
//         fclose($handle);
//     }
// }
// echo sizeof($existingRecord);




?>