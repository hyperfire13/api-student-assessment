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

// $command_exec = escapeshellcmd('training.py');
// $str_output = shell_exec($command_exec);
// echo var_dump($str_output) ;

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

// csv file filtering
$existingRecord = [];
$parentIncome = [
    'below 9,520.00' => 1,
    '9,520.00 - 19,040.00' => 2,
    '19,041.00 - 38,080.00' => 3,
    '38,081.00 - 60,640.00' => 4,
    'above 60,640.00' => 5
];

$fileName = "upload/" . 'Students-Profile-Responses - Form Responses 1.csv';
if (file_exists($fileName)) {
    if (($handle = fopen($fileName, "r")) !== FALSE) { 
        while (($data = fgetcsv($handle)) !== FALSE) {
            $existingRecord[] = $data;
        }
        fclose($handle);
    }
}
for ($i=1; $i < sizeof($existingRecord) ; $i++) {
    echo ($existingRecord[$i][0] . ' === ' . $existingRecord[$i][5]. ' === ' . $parentIncome[$existingRecord[$i][5]]);
    echo '<br>';
}





?>