<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database;
$database = $database->connection();

$post = new Post($database);

$result = $post->read();

$number = $result->rowcount();


if ($number > 0) {
    //array

    $post_array = array()
    

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => id,
            'title' => title,
            'body' => html_entity_decode(body),
            'author' => author,
            'category_id' => category_id,
            'category_name' =>category_name
        );

        array_push($post_array, $post_item);
    }
    echo json_encode($post_array)
} else {
    echo json_encode(
        array('message' => 'No Data Found')
    )
}