<?php 

include_once 'flight/flight.php';
include_once 'flight/autoload.php';

Flight::route('GET /cliente/carregarCliente',  array('clienteController','getCliente'));
Flight::route('POST /cliente/criarCliente', array('clienteController','postCliente'));
Flight::route('POST /cliente/editarCliente', array('clienteController','putCliente'));
Flight::route('POST /cliente/buscarDados', array('clienteController','getByID'));
Flight::route('POST /cliente/deletarCliente', array('clienteController','deleteCliente'));

Flight::start();
?>
