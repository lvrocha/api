<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/funcionario.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare funcionario object
$funcionario = new Funcionario($db);

// get id of funcionario to be edited
$data = json_decode(file_get_contents('php://input'));
#var_dump($data);

// set ID property of funcionario to be edited
$funcionario->id = $data->id;


$funcionario->readOne();

if($funcionario->nome!=null){
    // set funcionario property values
    $funcionario->nome = $data->nome;
    $funcionario->data_nasc = $data->data_nasc;
    $funcionario->end_cep = $data->end_cep;
    $funcionario->end_logradouro = $data->end_logradouro;
    $funcionario->end_bairro = $data->end_bairro;
    $funcionario->end_cidade = $data->end_cidade;
    $funcionario->end_estado = $data->end_estado;
    $funcionario->end_numero = $data->end_numero;
    $funcionario->email = $data->email;
    $funcionario->tel_fixo = $data->tel_fixo;
    $funcionario->tel_cel = $data->tel_cel;
    $funcionario->competencia_tec = $data->competencia_tec;
    $funcionario->competencia_compor = $data->competencia_compor;

    // update the funcionario
    if($funcionario->update()){

        // set response code - 200 ok
        http_response_code(200);

        // tell the user
        echo json_encode(array("message" => "Funcionário atualizado."));
    }else{
    
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the user
        echo json_encode(array("message" => "Não foi possivel atualizar funcionário."));
    }
}else{
     // set response code - 404 Not found
     http_response_code(404);
 
     // tell the user product does not exist
     echo json_encode(array("message" => "Funcionário nao existe."));
}