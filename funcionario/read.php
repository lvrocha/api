<?php

//required headers
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

//include database and object files
include_once '../config/database.php';
include_once '../objects/funcionario.php';

//instatiate database and product object
$database = new Database();
$db = $database->getConnection();

//initialize object
$funcionario = new Funcionario($db);

//query funcionarios
$stmt = $funcionario->read();
$num = $stmt->rowCount();

//check if more than 0 record found
if($num>0){
    
    //funcionario array
    $funcionario_arr=array();
    $funcionario_arr["records"]=array();
    
    //retrieve our table countents
    //fetch() is faster than fetchAll()~
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        $funcionario_item=array(
            "id" => $id,
            "nome" => $nome,
            "data_nasc" => $data_nasc,
            "end_cep" => $end_cep,
            "end_logradouro" => $end_logradouro,
            "end_bairro" => $end_bairro,
            "end_cidade" => $end_cidade,
            "end_estado" => $end_estado,
            "end_numero" => $end_numero,
            "email" => $email,
            "tel_fixo" => $tel_fixo,
            "tel_cel" => $tel_cel,
            "competencia_tec" => $competencia_tec,
            "competencia_compor" => $competencia_compor
        );
        
        array_push($funcionario_arr['records'],$funcionario_item);
    }
    
    // set response code - 200 ok
    http_response_code(200);
    
    // show funcionarios data in json format
    echo json_encode($funcionario_arr);
}else{
    //set response code - 404 not found
    http_response_code(404);

    //tell the user no products found
    echo json_encode(
        array("message" => "Nenhum funcionario encontrado.")
    );
}