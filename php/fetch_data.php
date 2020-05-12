<?php 

//Buscar todos clientes cadastrados no banco retornando um json.

include_once'conexao.php';

$data=[];
$conexao = new Conexao('localhost','root','','angularjs');
    $consulta = $conexao->conectar()->prepare("SELECT * FROM cliente ORDER BY idCliente;");
        if($consulta->execute()){
            while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
            $data []=$row;
                    
            }
        echo json_encode($data);
        } 

?>