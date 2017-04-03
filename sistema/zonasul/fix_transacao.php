<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	connect();
	$mvts = getMovimentacoesPeriodo("01/01/2008","01/01/2010","","");
	foreach($mvts as $m) {
		$id_pai = $m["IdPai"];
		$tipo_pai = $m["Tipo"];
		if($tipo_pai=="receita") {
			$reg = getReceita($id_pai);
			$DataTransacao = $reg["DataTransacao"];
		}	
		if($tipo_pai=="despesa") {
			$reg = getDespesa($id_pai);
			$DataTransacao = $reg["DataTransacao"];
		}	
		connect();
		mysql_query("UPDATE moinhos_movimentacoes SET DataTransacao = '$DataTransacao' WHERE IdPai = $id_pai");
		echo mysql_error();
	}
?>