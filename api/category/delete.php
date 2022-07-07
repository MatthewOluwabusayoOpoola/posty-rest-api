<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-headers" Access-Control-Allow-headers, content-Type, Access-Control-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$database = $database->connection();

$category = new Category($database);

$data = json_decode(file_get_contents("php://input"));


if($category->delete()) {
    echo json_encode(
        array('message' => 'Successfully Deleted')
    );
}else {
    echo json_encode(
        arry('message' => 'Not Deleted')
    )
}