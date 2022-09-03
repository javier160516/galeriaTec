<?php

use Gumlet\ImageResize;

require 'includes/app.php';
require 'vendor/autoload.php';

$db = conectarDB();

if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
    http_response_code(405);
    echo json_encode([
        'status'  => 405,
        'message' => 'Request method not supported'
    ]);
    exit;
}

if(!isset($_FILES['image'])) {
    http_response_code(400);
    echo json_encode([
        'status'  => 400,
        'message' => 'The request body does not contain the image (.jpg) attribute'
    ]);
    exit;
}

if(empty($_FILES['image']['name'])) {
    http_response_code(400);
    echo json_encode([
        'status'  => 400,
        'message' => 'There is no image to be uploaded.'
    ]);
    exit;
}
// Create the storage folder
$path = $_SERVER['DOCUMENT_ROOT'] .'/gallery/img/';
echo $path;
exit;
if (!is_dir($path)) {
    mkdir($path);
}
$image = $_FILES['image'];

// Create an identifier (hash)
$basename = md5(uniqid(rand(), true)) . '.jpg';

$imageResize = new ImageResize($image['tmp_name']);
$imageResize->scale(50);
$imageResize->save($path. $basename);
// Move uploaded file to the path with hashed name
//move_uploaded_file($imageResize, $path . $basename);


// Store the reference (hash name) into the database
$query = "INSERT INTO files (file_name) VALUES ('$basename')";

$result = mysqli_query($db, $query);

if ($result) {
    http_response_code(201);
    echo json_encode([
        'status'  => 201,
        'message' => 'Success'
    ]);
} else {
    http_response_code(400);
    echo json_encode([
        'status'  => 400,
        'message' => 'Error'
    ]);
}