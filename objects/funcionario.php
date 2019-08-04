<?php

class Funcionario{
    private $conn;
    private $table_name = "funcionarios";

    public $id;
    public $nome;
    public $data_nasc;
    public $end_cep;
    public $end_logradouro;
    public $end_bairro;
    public $end_cidade;
    public $end_estado;
    public $end_numero;
    public $email;
    public $tel_fixo;
    public $tel_cel;
    public $competencia_tec;
    public $competencia_compor;

    public function __construct($db){
        $this->conn = $db;
    }

    //read funcionarios
    function read(){
        $query = "SELECT 
                    id, nome, data_nasc, end_cep, end_logradouro, end_bairro, end_cidade, end_estado, end_numero, email, tel_fixo, tel_cel, competencia_tec, competencia_compor
                FROM funcionarios
                ORDER BY
                    id asc";

        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //execute
        $stmt->execute();

        return $stmt;
    }
}