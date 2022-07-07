<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php'
include_once '../../models/Category.php'

$database = new Database;
$database = $database->connection();

$category = new Category($database);

$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$category->read_single();

$category_array = array(
    'id' => $category->id,
    'name' => $category->name
);

print_r(json_encode($category_array))