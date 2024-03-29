<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Authorization');
    header('Content-Type: application/json;charset=utf-8');
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=report.csv');
    require dirname(__DIR__) . '/includes/autoloader.php';

    use Classes\Database as Database;
    use Classes\Helpers as Helper;
    use Models\Token as Token;

    $headers = getallheaders();
    $db = new Database();
    $helper = new Helper();
    $connection = $db->connect();
    $tokenChecker = new Token($connection);
    $records = [];
    $existingRecord = [];
    $userid = $helper->cleanNumber($_POST['userId']);
    $selectedYear = $helper->cleanNumber($_POST['selectedYear']);
    $selectedSection = $helper->cleanString($_POST['selectedSection']);
    $token = $_POST['token'];

    if ($tokenChecker->checkToken($userid, $token) === false) {
        $helper->response_now(null, null, [
            'status' => "failed",
        ]);
    }
    $command = 'SELECT id, year_id, factors, result_file FROM results WHERE deleted_at IS NULL AND year_id = ?';
    $statement = $connection->prepare($command);
    $statement->bind_param('i',
        $selectedYear
    );
    $statement->bind_result(
        $id,
        $yearId,
        $factors,
        $resultFile
    );
    $statement->execute();
    $statement->fetch();
    $resultFile = empty($resultFile) ? "empty" : $resultFile;
    $fileName = "../upload/final/" . $resultFile;

    if (file_exists($fileName)) {
        if (($handle = fopen($fileName, "r")) !== FALSE) { 
            while (($data = fgetcsv($handle)) !== FALSE) {
                $existingRecord[] = $data;
            }
            fclose($handle);
        }
    } else {
        $helper->response_now(null, null, [
            'status' => "no_results_found",
        ]);
    }
    $track = [
        'TVL' => 1,
        'ABM' => 2,
        'STEM' => 3,
        'TVl-HE' => 4,
        'others' => 5
    ];
    $sectionsToRemove = [];
    for ($i=1; $i < sizeof($existingRecord) ; $i++) {
        $existingRecord[$i][7] = isset($track[$existingRecord[$i][7]]) ? $existingRecord[$i][7]: 'Others';
        if (!empty($selectedSection)) {
            if ($selectedSection === 'Stop' || $selectedSection === 'Continue') {
                if ($existingRecord[$i][16] !== $selectedSection ) {
                    $sectionsToRemove[] = $i;
                }
            } else {
                if (strtoupper($existingRecord[$i][1]) !== strtoupper($selectedSection) ) {
                    $sectionsToRemove[] = $i;
                }
            }
        }
    }
    for ($i=0; $i < sizeof($sectionsToRemove); $i++) {
        unset($existingRecord[$sectionsToRemove[$i]]);
    }
    
    $existingRecord = array_values($existingRecord); // 'reindex' array
    $output = fopen('php://output', 'w');
    foreach ($existingRecord as $line) {
        fputcsv($output, $line);
    }
?>