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
    $sections = [];

    $userid = $helper->cleanNumber($_POST['userId']);
    $factorName = $helper->cleanString($_POST['factorName']);
    $intervention = $_POST['intervention'];
    $token = $_POST['token'];

    if ($tokenChecker->checkToken($userid, $token) === false) {
        $helper->response_now(null, null, [
            'status' => "failed",
        ]);
    }

    $command = 'INSERT INTO factors_intervention(factor, intervention) VALUES (?, ?)';
    $statement = $connection->prepare($command);
    $statement->bind_param('ss',
        $factorName,
        $intervention,
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