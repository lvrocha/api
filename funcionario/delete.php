<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 // include database and object file
include_once '../config/database.php';
include_once '../objects/funcionario.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare funcionario object
$funcionario = new Funcionario($db);
// get funcionario id
$data = json_decode(file_get_contents("php://input"));
// set funcionario id to be deleted
$funcionario->id = $data->id;
// delete the funcionario
if($funcionario->delete()){
     // set response code - 200 ok
     http_response_code(200);
 
     // tell the user
     echo json_encode(array("message" => "Funcionario deletado."));
}else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Não foi possivel deletar funcionario."));
}