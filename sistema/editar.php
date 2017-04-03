<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	if(!isset($_GET["tabela"]))
		die("Nenhuma tabela foi fornecida");
	if(!isset($_GET["id"]))
		die("Nenhum Id foi fornecido");		
	$tabela = $_GET["tabela"];
	$id = $_GET["id"];
	connect();
	if($tabela=="martha_funcionarios" || $tabela=="martha_clientes")  {
		$_POST["DataNascimento"] = formatDate($_POST["DataNascimento"]);
		$_POST["DataEntrada"] = formatDate($_POST["DataEntrada"]);
	}

	if(updateData($id,$_POST,$tabela))
		JSAlert("Dados editados com sucesso!");
	else
		JSAlert("Houve falha na edição dos dados. Tente novamente.");
	disconnect();
	JSLocation("start.php");
?>
