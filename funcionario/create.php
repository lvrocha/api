<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//get database connection
include_once '../config/database.php';
include_once '../objects/funcionario.php';

$database = new Database();
$db = $database->getConnection();

$funcionario = new Funcionario($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));
#var_dump($data);
//make sure data is not empty
if(
    !empty($data->nome) &&
    !empty($data->data_nasc) &&
    !empty($data->end_cep) &&
    !empty($data->end_logradouro) &&
    !empty($data->end_bairro) &&
    !empty($data->end_cidade) &&
    !empty($data->end_estado) &&
    !empty($data->end_numero) &&
    !empty($data->email) &&
    !empty($data->tel_fixo) &&
    !empty($data->tel_cel) &&
    !empty($data->competencia_tec) &&
    !empty($data->competencia_compor)
){
    //set produtc property values
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

    //create funcionario
    if($funcionario->create()){
        // set response code - 201 created
        http_response_code(201);
        //tell the user
        echo json_encode(array("message"=>"Funcionário criado."));
    }else{
        //set response code 503 service unavailable
        http_response_code(503);
        echo json_encode(array("message"=>"Não é possivel criar Funcionário"));
    }
}else{
    //set response code 400 bad request
    http_response_code(400);
    echo json_encode(array("message"=>"Não é possivel cria Funcionário. Dados incompletos."));
}