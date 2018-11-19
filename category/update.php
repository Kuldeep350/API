<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
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


// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//set id to update
$category->id = $data->id;

$category->name = $data->name;


// update category
if($category->update()){
echo json_encode(
array('message' => 'Category updated Successfully')
);
} else {
echo json_encode(
array('message' => 'Category Not updated')
);
}
?>
