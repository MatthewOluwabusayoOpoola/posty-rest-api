<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authoriztion, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$database = $database->connection();

$category = new Category($database);

$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;

$category->name = $data->name;

// Update

if($category->update()) {
    echo json_encode(
        array('message' => 'Data Updated')
    );
}else {
    echo json_encode(
        array('message'=>'Data not updated')
    );
}