<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	if(!isset($_GET["tabela"]))
		die("Nenhuma tabela foi fornecida");
	$tabela = $_GET["tabela"];
	connect();
	if($tabela=="martha_funcionarios" || $tabela=="martha_clientes")  {
		$_POST["DataNascimento"] = formatDate($_POST["DataNascimento"]);
		$_POST["DataEntrada"] = formatDate($_POST["DataEntrada"]);
	}
	if(insertData($_POST,$tabela))
		JSAlert("Dados inseridos com sucesso!");
	else
		JSAlert("Houve falha na inserção dos dados. Tente novamente.");
	disconnect();
	JSLocation("start.php");
?>
