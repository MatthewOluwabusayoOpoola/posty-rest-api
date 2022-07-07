<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authoriztion, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$database = $database->connection();

$post = new Post($database);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// Update

if($post->update()) {
    echo json_encode(
        array('message' => 'Data Updated')
    );
}else {
    echo json_encode(
        array('message'=>'Data not updated')
    );
}