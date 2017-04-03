<?php

// carrega arquivo de configuração
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.inc.php");

function __autoload($class) {
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "/class/class." . ucwords($class) . ".php");
}

// abre conexão com o banco
$conexao = new Conexao();


$agenda = new Agenda();
$agenda->setDebug(true);
$agendamentos = $agenda->carregarPorData("2012-03-10");
print_r($agendamentos);
$conexao->desconectar();
