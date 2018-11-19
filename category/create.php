<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");	
 
// get database connection
include_once '../config/Database.php';
 
// instantiate product object
include_once '../objects/function.php';

$database = new Database();
$db = $database->getConnection();

// initialize object
$category = new Category($db);

// get category data
$data = json_decode(file_get_contents("php://input"));

// set category property values
$category->name = $data->name;

// create the product
if($category->create()){
    echo '{';
        echo '"message": "User Register Successfully."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to Register User try agin."';
    echo '}';
}