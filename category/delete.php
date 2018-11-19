<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/Database.php';
include_once '../objects/function.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize object
$category = new Category($db);

// get user id
$data = json_decode(file_get_contents("php://input"));

// set user id to be deleted
$category->id = $data->id;

// delete the user
if($category->delete()){
    echo '{';
        echo '"message": "category deleted successfully."';
    echo '}';
}
 
// if unable to delete the user
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>
