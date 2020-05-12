<?php 

class clienteDAO{
    public $nome;
    public $sobrenome;
    public $email;
    public $telefone;
    public $dataDeNascimento;
    public $estado;
    public $cidade;
    public $sexo;
    public $idCliente;
    public $conn;
    
    public function __construct(){
		$this->conn = new Conexao('localhost','root','','angularjs');
	}
    public function __set($atributo, $valor){
        $this ->$atributo = $valor;
    }
    public function __get($atributo){
		return $this->$atributo;
    }
    
    public function getCliente(){
        $consulta = $this->conn->conectar()->prepare("SELECT * from `cliente`;");
        if($consulta->execute()){
            if($consulta->rowCount()> 0){
                $resultado = $consulta->fetchAll();
                $output=array();
                foreach($resultado as $row)
                {
                    $cliente['nome'] = $row['nome'];
                    $cliente['sobrenome'] = $row['sobrenome'];
                    $cliente['email'] = $row['email'];
                    $cliente['telefone'] = $row['telefone'];
                    $cliente['dataDeNascimento'] = $row['dataDeNascimento'];
                    $cliente['estado'] = $row['estado'];
                    $cliente['cidade'] = $row['cidade'];
                    $cliente['sexo'] = $row['sexo'];
                    $cliente['idCliente'] = $row['idCliente'];
                    $output[]= $cliente;
                }
                return $output;
            }else{
                Flight::halt(200, false);
            }
        }else{
            return false;
        }
    }

    public function postCliente($data){
        $nome=isset($data['nome']) ? $data['nome'] : null;
        $sobrenome=isset($data['sobrenome']) ? $data['sobrenome'] : null;
        $email=isset($data['email']) ? $data['email'] : null;
        $telefone=isset($data['telefone']) ? $data['telefone'] : null;
        $dataDeNascimento=isset($data['dataDeNascimento']) ? $data['dataDeNascimento'] : null;
        $estado=isset($data['estado']) ? $data['estado'] : null;
        $cidade=isset($data['cidade']) ? $data['cidade'] : null;
        $sexo=isset($data['sexo']) ? $data['sexo'] : null;

        if($this->verificarEmail($email) == true){
            $consulta = $this->conn->conectar()->prepare(
            "INSERT INTO `cliente`(`nome`, `sobrenome`, `email`, `telefone`, `datadenascimento`, `estado`, `cidade`, `sexo`) 
            VALUES (:nome,:sobrenome,:email,:telefone,:dataDeNascimento,:estado,:cidade,:sexo);");
            $consulta->bindParam(":nome", $nome, PDO::PARAM_STR);
            $consulta->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
            $consulta->bindParam(":email", $email, PDO::PARAM_STR);
            $consulta->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $consulta->bindParam(":dataDeNascimento", $dataDeNascimento, PDO::PARAM_STR);
            $consulta->bindParam(":estado", $estado, PDO::PARAM_STR);
            $consulta->bindParam(":cidade", $cidade, PDO::PARAM_STR);
            $consulta->bindParam(":sexo", $sexo, PDO::PARAM_STR);
            if($consulta->execute()){
                return true;
            }else{
                return false;
            }         
        }else{
            Flight::halt(409, 'Ja existe esse email.');  
        }
    }

    public function verificarEmail($email){
        $consulta = $this->conn->conectar()->prepare("SELECT email, idCliente FROM `cliente` WHERE email = :email");
        $consulta->bindParam(":email", $email, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetch();    
        if($consulta->rowCount() > 0){
            return $resultado['idCliente'];
        }else{
            return true;
        }
    }

    public function putCliente($data){
        $nome=isset($data['nome']) ? $data['nome'] : null;
        $sobrenome=isset($data['sobrenome']) ? $data['sobrenome'] : null;
        $email=isset($data['email']) ? $data['email'] : null;
        $telefone=isset($data['telefone']) ? $data['telefone'] : null;
        $dataDeNascimento=isset($data['dataDeNascimento']) ? $data['dataDeNascimento'] : null;
        $estado=isset($data['estado']) ? $data['estado'] : null;
        $cidade=isset($data['cidade']) ? $data['cidade'] : null;
        $sexo=isset($data['sexo']) ? $data['sexo'] : null;
        $idCliente=isset($data['idCliente']) ? $data['idCliente'] : null;
             
        if($this->verificarEmail($email) == $idCliente){ 
            $consulta = $this->conn->conectar()->prepare(
            "UPDATE `cliente` SET `nome`= :nome, `sobrenome` = :sobrenome, `email` = :email, `telefone` = :telefone,
            `dataDeNascimento` = :dataDeNascimento, `estado` = :estado, `cidade` = :cidade, `sexo` = :sexo 
            WHERE idCliente = :idCliente;");
            $consulta->bindParam(":nome", $nome, PDO::PARAM_STR);
            $consulta->bindParam(":sobrenome", $sobrenome, PDO::PARAM_STR);
            $consulta->bindParam(":email", $email, PDO::PARAM_STR);
            $consulta->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $consulta->bindParam(":dataDeNascimento", $dataDeNascimento, PDO::PARAM_STR);
            $consulta->bindParam(":estado", $estado, PDO::PARAM_STR);
            $consulta->bindParam(":cidade", $cidade, PDO::PARAM_STR);
            $consulta->bindParam(":sexo", $sexo, PDO::PARAM_STR);
            $consulta->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);
            if($consulta->execute()){
                return true;
            }else{
                return false;
            }       
       } 
    }

    public function getByID($data){
        $idCliente=isset($data['idCliente']) ? $data['idCliente'] : null;
        $consulta = $this->conn->conectar()->prepare("SELECT * from `cliente` WHERE idCliente =:idCliente");
        $consulta->bindParam(":idCliente", $idCliente, PDO::PARAM_STR);
        if($consulta->execute()){
            $result = $consulta->fetchAll();
            $output=array();
            foreach($result as $row)
            {
                $cliente['nome'] = $row['nome'];
                $cliente['sobrenome'] = $row['sobrenome'];
                $cliente['email'] = $row['email'];
                $cliente['telefone'] = $row['telefone'];
                $cliente['dataDeNascimento'] = $row['dataDeNascimento'];
                $cliente['estado'] = $row['estado'];
                $cliente['cidade'] = $row['cidade'];
                $cliente['sexo'] = $row['sexo'];
                $cliente['idCliente'] = $row['idCliente'];
                $output[]=$cliente;
            }
            return $output;
        }else{
            Flight::halt(400);
        }
    }

    public function deleteCliente($data){
        $idCliente=isset($data['idCliente']) ? $data['idCliente'] : null;
        $consulta = $this->conn->conectar()->prepare("DELETE FROM `cliente` WHERE idCliente = :idCliente");
        $consulta->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);
        if($consulta->execute()){
            return true;
        }else{
            return false;
        }
    }

}

?>