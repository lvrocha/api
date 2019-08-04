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
        FROM ".$this->table_name."
        ORDER BY
        id asc";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //execute
        $stmt->execute();
        
        return $stmt;
    }
    
    //create funcionario
    function create(){
        $query = "INSERT INTO 
        ". $this->table_name ."
        SET 
        nome=:nome,
        data_nasc=:data_nasc,
        end_cep=:end_cep,
        end_logradouro=:end_logradouro,
        end_bairro=:end_bairro,
        end_cidade=:end_cidade,
        end_estado=:end_estado,
        end_numero=:end_numero,
        email=:email,
        tel_fixo=:tel_fixo,
        tel_cel=:tel_cel,
        competencia_tec=:competencia_tec,
        competencia_compor=:competencia_compor
        ";
        //prepare
        $stmt = $this->conn->prepare($query);
        
        //satinize
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->data_nasc=htmlspecialchars(strip_tags($this->data_nasc));
        $this->end_cep=htmlspecialchars(strip_tags($this->end_cep));
        $this->end_logradouro=htmlspecialchars(strip_tags($this->end_logradouro));
        $this->end_bairro=htmlspecialchars(strip_tags($this->end_bairro));
        $this->end_cidade=htmlspecialchars(strip_tags($this->end_cidade));
        $this->end_estado=htmlspecialchars(strip_tags($this->end_estado));
        $this->end_numero=htmlspecialchars(strip_tags($this->end_numero));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->tel_fixo=htmlspecialchars(strip_tags($this->tel_fixo));
        $this->tel_cel=htmlspecialchars(strip_tags($this->tel_cel));
        $this->competencia_tec=htmlspecialchars(strip_tags($this->competencia_tec));
        $this->competencia_compor=htmlspecialchars(strip_tags($this->competencia_compor));
        
        //bind values
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":data_nasc", $this->data_nasc);
        $stmt->bindParam(":end_cep", $this->end_cep);
        $stmt->bindParam(":end_logradouro", $this->end_logradouro);
        $stmt->bindParam(":end_bairro", $this->end_bairro);
        $stmt->bindParam(":end_cidade", $this->end_cidade);
        $stmt->bindParam(":end_estado", $this->end_estado);
        $stmt->bindParam(":end_numero", $this->end_numero);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":tel_fixo", $this->tel_fixo);
        $stmt->bindParam(":tel_cel", $this->tel_cel);
        $stmt->bindParam(":competencia_tec", $this->competencia_tec);
        $stmt->bindParam(":competencia_compor", $this->competencia_compor);
        
        //execute
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }
    
    // used when filling up the update funcionario form
    function readOne(){
        $query = "SELECT
        id,
        nome,
        data_nasc,
        end_cep,
        end_logradouro,
        end_bairro,
        end_cidade,
        end_estado,
        end_numero,
        email,
        tel_fixo,
        tel_cel,
        competencia_tec,
        competencia_compor
        FROM
        ".$this->table_name."
        WHERE 
        id = ?
        LIMIT
        0,1";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        
        // bind id of funcionarios to be updated
        $stmt->bindParam(1, $this->id);
        
        // execute query
        $stmt->execute();
        
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // set values to object properties
        $this->nome = $row['nome'];
        $this->data_nasc = $row['data_nasc'];
        $this->end_cep = $row['end_cep'];
        $this->end_logradouro = $row['end_logradouro'];
        $this->end_bairro = $row['end_bairro'];
        $this->end_cidade = $row['end_cidade'];
        $this->end_estado = $row['end_estado'];
        $this->end_numero = $row['end_numero'];
        $this->email = $row['email'];
        $this->tel_fixo = $row['tel_fixo'];
        $this->tel_cel = $row['tel_cel'];
        $this->competencia_tec = $row['competencia_tec'];
        $this->competencia_compor = $row['competencia_compor'];
    }
    
    function update(){
 
            // update query
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        nome = :nome,
                        data_nasc = :data_nasc,
                        end_cep = :end_cep,
                        end_logradouro = :end_logradouro,
                        end_bairro = :end_bairro,
                        end_cidade = :end_cidade,
                        end_estado = :end_estado,
                        end_numero = :end_numero,
                        email = :email,
                        tel_fixo = :tel_fixo,
                        tel_cel = :tel_cel,
                        competencia_tec = :competencia_tec,
                        competencia_compor = :competencia_compor
                    WHERE
                        id = :id";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->data_nasc=htmlspecialchars(strip_tags($this->data_nasc));
            $this->end_cep=htmlspecialchars(strip_tags($this->end_cep));
            $this->end_logradouro=htmlspecialchars(strip_tags($this->end_logradouro));
            $this->end_bairro=htmlspecialchars(strip_tags($this->end_bairro));
            $this->end_cidade=htmlspecialchars(strip_tags($this->end_cidade));
            $this->end_estado=htmlspecialchars(strip_tags($this->end_estado));
            $this->end_numero=htmlspecialchars(strip_tags($this->end_numero));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->tel_fixo=htmlspecialchars(strip_tags($this->tel_fixo));
            $this->tel_cel=htmlspecialchars(strip_tags($this->tel_cel));
            $this->competencia_tec=htmlspecialchars(strip_tags($this->competencia_tec));
            $this->competencia_compor=htmlspecialchars(strip_tags($this->competencia_compor));
            $this->id=htmlspecialchars(strip_tags($this->id));
            
            // bind new values
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':data_nasc', $this->data_nasc);
            $stmt->bindParam(':end_cep', $this->end_cep);
            $stmt->bindParam(':end_logradouro', $this->end_logradouro);
            $stmt->bindParam(':end_bairro', $this->end_bairro);
            $stmt->bindParam(':end_cidade', $this->end_cidade);
            $stmt->bindParam(':end_estado', $this->end_estado);
            $stmt->bindParam(':end_numero', $this->end_numero);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':tel_fixo', $this->tel_fixo);
            $stmt->bindParam(':tel_cel', $this->tel_cel);
            $stmt->bindParam(':competencia_tec', $this->competencia_tec);
            $stmt->bindParam(':competencia_compor', $this->competencia_compor);
            $stmt->bindParam(':id', $this->id);
            
            // execute the query
            if($stmt->execute()){
                return true;
            }
            
            return false;
        
    }

    function delete(){
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id)); 
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);    
        // execute query
        if($stmt->execute()){
            return true;
        }    
        return false;
    }
}