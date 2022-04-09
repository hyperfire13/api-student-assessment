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
$gender = [
    'Male' => 1,
    'M' => 1,
    'Female' => 0,
    'F' => 0
];
$parentIncome = [
    'below 9,520.00' => 1,
    '9,520.00 - 19,040.00' => 2,
    '19,041.00 - 38,080.00' => 3,
    '38,081.00 - 60,640.00' => 4,
    'above 60,640.00' => 5
];
$track = [
    'TVL' => 1,
    'ABM' => 2,
    'STEM' => 3,
    'TVl-HE' => 4,
    'others' => 5
];
$gwaHighSchool = [
    '75 - 80' => 1,
    '81 - 84' => 2,
    '85 - 89' => 3,
    '90 - 95' => 4,
    '96 and above' => 5
];
$gwaCollege = [
    'below 3.00' => 1,
    '2.50 - 3.00' => 2,
    '2.49 - 2.00' => 3,
    '1.99  - 1.50' => 4,
    '1.99 - 1.50' => 4,
    '1.49 - 1.00' => 5,
    '1.49 - 1.0' => 5
];

$yesOrNo = [
    'Yes' => 1,
    'No' => 0
];

$continueOrStop = [
    'Continue' => 1,
    'Stop' => 0
];

$schools = [
    'Buting High School' => 1,
    'Rizal High School' => 2,
    'AMA' => 3,
    'San Joaquin - Kalawaan High School' => 4,
    'STI' => 5,
    'Arellano University' => 6,
    'Ezra Technical Training Foundation' => 7,
    'Pasig Catholic College' => 8,
    'Alicia National High School' => 9,
    'Santolan High School' => 10,
    'Sta. Lucia High School' => 11,
    'Sagad High School' => 12,
    'Pasig Science High School' => 13,
    'Nagpayong High School' => 14,
    'CASAP' => 15,
    'PCC' => 16,
    'St. Chamuel' => 17,
    'Mary the Queen College' => 18,
    'Holy Child High School' => 19,
    'Kapitolyo High School' => 20,
    'Asian Institute of Computer Studies' => 21,
    'Eusebio High School' => 22,
    'others' => 23
];
$cityAddress = [
    'Pasig' => 1,
    'others' => 2,
    'Taguig' => 3,
    'Cainta' => 4
];


$fileName = "upload/" . 'Students-Profile-for-First-Year-Testing-Set - Students Profile for First Year.csv';
if (file_exists($fileName)) {
    if (($handle = fopen($fileName, "r")) !== FALSE) { 
        while (($data = fgetcsv($handle)) !== FALSE) {
            $existingRecord[] = $data;
        }
        fclose($handle);
    }
}
for ($i=1; $i < sizeof($existingRecord) ; $i++) {
    // convert age into corresponding value
    $existingRecord[$i][2] = intval($existingRecord[$i][2]);
    // convert gender into corresponding value
    $existingRecord[$i][3] = $gender[$existingRecord[$i][3]];
    // convert address into corresponding value
    $existingRecord[$i][4] = isset( $cityAddress[$existingRecord[$i][4]]) ? $cityAddress[$existingRecord[$i][4]] : $cityAddress['others'];
    // convert salary into corresponding value
    $existingRecord[$i][5] = $parentIncome[$existingRecord[$i][5]];
    // convert school into corresponding value
    $existingRecord[$i][6] = isset($schools[$existingRecord[$i][6]]) ? $schools[$existingRecord[$i][6]] : $schools['others'];
    // convert track into corresponding value
    $existingRecord[$i][7] = isset($track[$existingRecord[$i][7]]) ? $track[$existingRecord[$i][7]] : $track['others'];

    $existingRecord[$i][8] = $gwaHighSchool[$existingRecord[$i][8]];
    $existingRecord[$i][9] = $gwaCollege[$existingRecord[$i][9]];
    $existingRecord[$i][10] = $gwaCollege[$existingRecord[$i][10]];
    $existingRecord[$i][11] = $yesOrNo[$existingRecord[$i][11]];

    // echo ' ======= ';
    // echo ($existingRecord[$i][0] . ' === ' . $existingRecord[$i][6]. ' === ' . $schools[$existingRecord[$i][6]]);
    // echo '<br>';
}
echo json_encode($existingRecord);
$output = fopen("upload/final-testingset.csv", "w");
foreach ($existingRecord as $line) {
fputcsv($output, $line);
}
fclose($output);

/****************************************************/
// create the csv file ready for the training of machine learning
// $output = fopen("info.csv", "w");  
// fputcsv($output, array(
//   'First_Name',
//   'Middle_Name',
//   'Last_Name',
//   'Email',
//   'Birthdate',
//   'Image',
//   'Password'
// ));  
// foreach ($existingRecord as $line) {
//   fputcsv($output, $line);
// }
// fclose($output);  




?>