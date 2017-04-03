<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	connect();
	mysql_query("UPDATE moinhos_movimentacoes SET DataQuitacao = DataTransacao WHERE ParcNum = 0");
	echo mysql_error();

?>