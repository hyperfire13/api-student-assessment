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
    $selectedYear = $helper->cleanNumber($_POST['selectedYear']);
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
    $newFileName = $newFileName . $fileExtension;
    

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
        'Public' => 1,
        'Private' => 2,
    ];
    $cityAddress = [
        'PR' => 1,
        'NPR' => 2
    ];
    $fileName = "../upload/" . $newFileName;
    if (file_exists($fileName)) {
        if (($handle = fopen($fileName, "r")) !== FALSE) { 
            while (($data = fgetcsv($handle)) !== FALSE) {
                $existingRecord[] = $data;
            }
            fclose($handle);
        }
    }
    
        //code...
    
        for ($i=1; $i < sizeof($existingRecord) ; $i++) {
            try {
                // convert age into corresponding value
                $existingRecord[$i][2] = intval($existingRecord[$i][2]);
                // convert gender into corresponding value
                $existingRecord[$i][3] = $gender[$existingRecord[$i][3]];
                // convert address into corresponding value
                $existingRecord[$i][4] = isset( $cityAddress[$existingRecord[$i][4]]) ? $cityAddress[$existingRecord[$i][4]] : $cityAddress['NPR'];
                // convert salary into corresponding value
                $existingRecord[$i][5] = $parentIncome[$existingRecord[$i][5]];
                // convert school into corresponding value
                $existingRecord[$i][6] = isset($schools[$existingRecord[$i][6]]) ? $schools[$existingRecord[$i][6]] : $schools['others'];
                // convert track into corresponding value
                $existingRecord[$i][7] = isset($track[$existingRecord[$i][7]]) ? $track[$existingRecord[$i][7]] : $track['others'];

                $existingRecord[$i][8] = $gwaHighSchool[$existingRecord[$i][8]];
                $existingRecord[$i][9] = $gwaCollege[$existingRecord[$i][9]];
                $existingRecord[$i][10] = $gwaCollege[$existingRecord[$i][10]];
                $existingRecord[$i][11] = $gwaCollege[$existingRecord[$i][11]];
                $existingRecord[$i][12] = $gwaCollege[$existingRecord[$i][12]];
                $existingRecord[$i][13] = $gwaCollege[$existingRecord[$i][13]];
                $existingRecord[$i][14] = $gwaCollege[$existingRecord[$i][14]];
                $existingRecord[$i][15] = $yesOrNo[$existingRecord[$i][15]];
                // echo ' ======= ';
                // echo ($existingRecord[$i][0] . ' === ' . $existingRecord[$i][6]. ' === ' . $schools[$existingRecord[$i][6]]);
                // echo '<br>';
            } catch (Exception $e) {
                $helper->response_now(null, null,[
                    'status' => "failed",
                ]);
            }
        }
    

    $command = 'INSERT INTO results(year_id, base_file) VALUES (?, ?)';
    $statement = $connection->prepare($command);
    $statement->bind_param('is',
        $selectedYear,
        $newFileName,
    );
    $statement->execute();
    $lastInsertedId = $statement->insert_id;
    // PROMPT FOR FAILED QUERY
    if ($statement->affected_rows !== 1) {
        $helper->response_now($statement, $connection,[
            'status' => "failed",
        ]);
    }
    // echo json_encode($existingRecord);
    $convertedName = 'converted-' .  $newFileName;
    $output = fopen("../upload/converted/converted-" . $newFileName, "w");
    foreach ($existingRecord as $line) {
        fputcsv($output, $line);
    }
    fclose($output);

    // start python here
    $command_exec = 'python ../python-codes/student-assessment-final.py ' . $convertedName . ' ' . $newFileName;
    $finalFile = shell_exec($command_exec);
    $finalFile = json_decode($finalFile, FALSE);
    if (is_null($finalFile)) {
        $command = 'DELETE FROM results WHERE id = ?';
        $statement = $connection->prepare($command);
        $statement->bind_param('i',
            $lastInsertedId,
        );
        $statement->execute();
        $helper->response_now(null, null,[
            'status' => "bad_data",
        ]);
    }
    $factors = $finalFile[1]->factors;
    $interventions = [];
    for ($i=0; $i < sizeof($factors);$i++) {
        $command = 'SELECT id FROM factors_intervention WHERE factor LIKE ?';
        $statement = $connection->prepare($command);
        $statement->bind_param('s',
            $factors[$i]
        );
        $statement->bind_result(
            $id,
        );
        $statement->execute();

        while ($statement->fetch()) {
            if (!empty($id)) {
                $interventions[] = [
                    'id' => $id,
                ];
            }
        }
        $statement->close(); 
    }
    $interventions = json_encode($interventions);
    $command = 'UPDATE results set result_file = ?, factors = ? WHERE id = ?';
    $statement = $connection->prepare($command);
    $statement->bind_param('ssi',
        $finalFile[0],
        $interventions,
        $lastInsertedId,
    );
    $statement->execute();
    // PROMPT FOR FAILED QUERY
    if ($statement->affected_rows !== 1) {
        $helper->response_now($statement, $connection,[
            'status' => "failed",
        ]);
    }

    $helper->response_now($statement, $connection, [
        'status' => "success",
    ]);
?>