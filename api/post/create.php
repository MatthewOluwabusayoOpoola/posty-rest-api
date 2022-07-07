<?php

// headers
header('Access-Control-Allow-Orign: *');
header('Content-Type: appliction/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$databse = $database->connection();

$category = new Category($database);

$data = json_decode(file_get_contents("php://input"));

$category->name = $data->name
if($category->create()) {
    echo json_encode(
        array('message' => 'Created')
    );

} else {
    echo json_encode(
        arry('message' => 'No Created')
    );
}