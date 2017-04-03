<?php
	if(!$logged) 
		die("sessão não iniciada");
	if(!isset($_GET["tabela"]))
		die("Nenhuma tabela foi fornecida");
	if(!isset($_GET["id"]))
		die("Nenhum Id foi fornecido");
	if(!isset($_GET["confirma"]))
		die("Tem certeza de que deseja apagar esse registro? <a href='index.php?confirma=sim&sec=remover&tabela=" . $_GET["tabela"] . "&id=" . $_GET["id"] . "'>Sim</a> <a href='index.php'>Não</a> ");
	$tabela = $_GET["tabela"];
	$id = $_GET["id"];
	connect();
	deleteEntryById($id,$tabela);
	JSAlert("Dados excluídos com sucesso!");
	disconnect();
	JSLocation("index.php");
?>
