<?php 

class clienteController{
    private $conn;

    public function __construct(){
        $conn= new conexao('localhost','root','','angularjs');
    }

    public function getCliente(){
        $clienteDAO = new clienteDAO();;
        $cliente = $clienteDAO->getCliente();
        if($cliente==true){
            Flight::json($cliente);
        }else{
            Flight::halt(500,"Erro ao carregar clientes");
        }
    }

    public function postCliente(){
        $clienteDAO = new clienteDAO();
        $data = json_decode(file_get_contents('php://input'), true);
        $cliente = $clienteDAO->postCliente($data);
        if($cliente==true){
            Flight::halt(201, 'Criado');
        }else{
            Flight::halt(400, 'Erro ao cadastrar');
        }
    }

    public function putCliente(){
        $clienteDAO = new clienteDAO();
        $data = json_decode(file_get_contents('php://input'), true);
        $cliente = $clienteDAO->putCliente($data);
        if($cliente==true){
            Flight::halt(200, 'Cliente alterado');
        }else{
            Flight::halt(400, 'Erro ao alterar');
        }
    }

    public function getByID(){
        $clienteDAO = new clienteDAO();
        $data = json_decode(file_get_contents('php://input'), true);
        $cliente = $clienteDAO->getByID($data);
        if($cliente==true){
            Flight::json($cliente);
        }else{
            Flight::halt(400, 'Erro ao buscar dados do cliente');
        }
    }

    public function deleteCliente(){
        $clienteDAO = new clienteDAO();
        $data = json_decode(file_get_contents('php://input'), true);
        $cliente = $clienteDAO->deleteCliente($data);
        if($cliente==true){
            Flight::halt(200);
        }else{
            Flight::halt(400, 'Erro ao deletar o cliente');
        }
    }

}


?>