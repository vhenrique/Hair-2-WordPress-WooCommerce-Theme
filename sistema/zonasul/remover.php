<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sess�o n�o iniciada");
	}
	if(!isset($_GET["tabela"]))
		die("Nenhuma tabela foi fornecida");
	if(!isset($_GET["id"]) && !isset($_POST["Opcoes"]))
		die("Nenhum Id foi fornecido");
	$tabela = $_GET["tabela"];
	$id = isset($_POST["Opcoes"]) ? $_POST["Opcoes"] : $_GET["id"];
	connect();
	deleteEntryById($id,_TABLE_PREFIX . $tabela);
	JSAlert("Dados exclu�dos com sucesso!");
	disconnect();
?>
	
	<script>
		history.go(-1);
	</script>
