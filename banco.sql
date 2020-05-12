create table cliente(	
    idCliente int NOT NULL AUTO_INCREMENT,
    nome VARCHAR(155),
    sobrenome VARCHAR(155),
    email VARCHAR(155),
    telefone VARCHAR(30),
    dataDeNascimento VARCHAR(30),
    estado VARCHAR(10),
    cidade VARCHAR(30),
    sexo VARCHAR(155),
    PRIMARY KEY (idCliente) 
);
