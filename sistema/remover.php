<?php
	if(!$logged) 
		die("sess�o n�o iniciada");
	if(!isset($_GET["tabela"]))
		die("Nenhuma tabela foi fornecida");
	if(!isset($_GET["id"]))
		die("Nenhum Id foi fornecido");
	if(!isset($_GET["confirma"]))
		die("Tem certeza de que deseja apagar esse registro? <a href='index.php?confirma=sim&sec=remover&tabela=" . $_GET["tabela"] . "&id=" . $_GET["id"] . "'>Sim</a> <a href='index.php'>N�o</a> ");
	$tabela = $_GET["tabela"];
	$id = $_GET["id"];
	connect();
	deleteEntryById($id,$tabela);
	JSAlert("Dados exclu�dos com sucesso!");
	disconnect();
	JSLocation("index.php");
?>
