<?php

$name = $_FILES['cover']['name'];
$tmp = $_FILES['cover']['tmp_name'];
$type = $_FILES['cover']['type'];
$error = $_FILES['cover']['error'];

$getEx = explode('/', $type);
$extension = end($getEx);

$output;

if(!$error) {
    if($type == "image/jpeg" || $type == "image/png") {
        $newname = uniqid() . "__temp." .$extension;
        move_uploaded_file($tmp, "../assets/before/".$newname);

        $output = [
            "status" => 200,
            "info" => $newname
        ];
        echo json_encode($output);
    } else {
        $output = [
            "status" => 420,
            "message" => "Only jpg and png file can be accepted"
        ];
        echo json_encode($output);
    }
}