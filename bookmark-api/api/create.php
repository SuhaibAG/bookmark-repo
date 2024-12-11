<?php
// Check Request Method
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Allow: POST');
    http_response_code(405);
    echo json_encode('Method Not Allowed');
    return;
}
// Headers
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");


include_once '../db/Database.php';
include_once '../models/Bookmark.php';

// Instantiate a Database object & connect
$database = new Database();
$dbConnection = $database->connect();

// Instantiate Bookmark object
$bookmark = new bookmark($dbConnection);

// Get the HTTP POST request JSON body
$data = json_decode(file_get_contents("php://input"), true);
if(!$data || !isset($data['Link'])){
    http_response_code(422);
    echo json_encode(
        array('message' => 'Error: Missing required parameter bookmark in the JSON body.')
    );
    return;
}
if(!$data || !isset($data['title'])){
    http_response_code(422);
    echo json_encode(
        array('message' => 'Error: Missing required parameter bookmark in the JSON body.')
    );
    return;
}

$bookmark->setLink($data['Link']);
$bookmark->setTitle($data['title']);


// Create bookmark
if ($bookmark->create()) {
    echo json_encode(
        array('message' => 'A bookmark item was created')
    );
} else {
    echo json_encode(
        array('message' => 'Error: a bookmark item was not created')
    );
}
