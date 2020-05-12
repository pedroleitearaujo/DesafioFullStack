<?php

//Classe de conexão utilizando PDO, quando chamada passar o servidor, login, senha e o banco qual deseja acessar.
Class Conexao{
	//ATRIBUTO PRIVADOS
	private $servidor;
	private $login;
	private $senha;
	private $banco;
	private static $pdo;

	public function __construct($servidor, $login, $senha, $banco){
		$this->servidor=$servidor;
		$this->login=$login;
		$this->senha=$senha;
		$this->banco=$banco;
	}
	public function conectar(){
		try{
			if(is_null(self::$pdo)){
				self::$pdo=new PDO("mysql:host=".$this->servidor
								  .";dbname=".$this->banco
								  ,$this->login
								  ,$this->senha);
			}
			return self::$pdo;
		}
		catch(PDOException $ex){

		}
	}

}
?>