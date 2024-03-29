<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php'
include_once '../../models/Post.php'

$database = new Database;
$database = $database->connection();

$post = new Post($database);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$post->read_single();

$post_array = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' =>$post->category_name
);

print_r(json_encode($post_array))