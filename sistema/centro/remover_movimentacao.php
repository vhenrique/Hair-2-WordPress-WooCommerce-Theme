<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sess�o n�o iniciada");
	}
	Nivel(2);
	
//	if(!isset($_GET["tabela"]))
//		die("Nenhuma tabela foi fornecida");
	if(!isset($_GET["id"]))
		die("Nenhum Id foi fornecido");
	if(!isset($_GET["id_pai"]))
		die("Nenhum Id Pai foi fornecido");
		
	$tabela = $_GET["tabela"];
	$id = $_GET["id"];
	$id_pai = $_GET["id_pai"];
	$tipo = $_GET["tipo"];
	connect();
	$query = mysql_query("DELETE FROM " . _TABLE_PREFIX . "movimentacoes WHERE Id = $id");
	if($id_pai != 0) {
		$query = mysql_query("DELETE FROM " . _TABLE_PREFIX . "movimentacoes WHERE Tipo = '$tipo' AND IdPai = $id_pai");
		$query = mysql_query("DELETE FROM " . _TABLE_PREFIX . $tipo ."s WHERE Id = $id_pai");
	}	
	JSAlert("Dados exclu�dos com sucesso!");
	disconnect();
?>
	
	<script>
		history.go(-1);
	</script>
