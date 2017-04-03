<?php
	include "kernel.martha_sys.inc.php";
	connect();
	$avisos = mysql_query("SELECT * FROM moinhos_avisos");
	while($aviso = mysql_fetch_assoc($avisos)) {
		echo $r['DataCadastro'] . "<br>"	
	}
?>
