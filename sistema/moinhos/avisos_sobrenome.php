<?php
	include "kernel.martha_sys.inc.php";
	connect();
	$avisos = mysql_query("SELECT * FROM moinhos_avisos");
	while($aviso = mysql_fetch_assoc($avisos)) {
		echo "<br>" . $aviso['DataCadastro'] . " ";	
		$recs = mysql_query("SELECT * FROM moinhos_receitas WHERE Data = '" . $aviso['DataCadastro'] . "'");
		while($rec = mysql_fetch_assoc($recs)) {
			unset($array);
			$array["IdCliente"] = $rec["IdCliente"];
			echo $array["IdCliente"];
			updateData($aviso["Id"],$array,_TABLE_PREFIX . 'avisos');			
		}
	}
?>
