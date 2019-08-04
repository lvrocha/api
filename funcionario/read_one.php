<?php
//require headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-tye: application/json");

//get database connection
include_once '../config/database.php';
include_once '../objects/funcionario.php';

$database = new Database();
$db = $database->getConnection();

$funcionario = new Funcionario($db);

//set id property of record to read
$funcionario->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of funcionario to be edited
$funcionario->readOne();

if($funcionario->nome!=null){
    // create array
    $funcionario_arr = array(
        "id" =>  $funcionario->id,
        "nome" => $funcionario->nome,
        "data_nasc" => $funcionario->data_nasc,
        "end_cep" => $funcionario->end_cep,
        "end_logradouro" => $funcionario->end_logradouro,
        "end_bairro" => $funcionario->end_bairro,
        "end_cidade" => $funcionario->end_cidade,
        "end_estado" => $funcionario->end_estado,
        "end_numero" => $funcionario->end_numero,
        "email" => $funcionario->email,
        "tel_fixo" => $funcionario->tel_fixo,
        "tel_cel" => $funcionario->tel_cel,
        "competencia_tec" => $funcionario->competencia_tec,
        "competencia_compor" => $funcionario->competencia_compor 
    );
    // set response code - 200 OK
    http_response_code(200);

     // make it json format
     echo json_encode($funcionario_arr);
}else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Funcionário nao existe."));
}