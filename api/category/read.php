<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database;
$database = $database->connection();

$category = new Category($database);

$result = $category->read();

$number = $result->rowcount();


if ($number > 0) {
    //array

    $category_array = array()
    $category_array['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            'id' => $id,
            'name' => $name
        );

        array_push($category_array['data'], $category_item);
    }
    echo json_encode($category_array)
} else {
    echo json_encode(
        array('message' => 'No Data Found')
    )
}