<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(1);
	if(isset($_GET["tabela"])) 
		$tabela = $_GET["tabela"];
	else
		die("Você não forneceu nenhuma tabela.");
		
	if($tabela!="descontos" && $tabela!="mechas")
		die();

	connect();
	$trunc_query = mysql_query("TRUNCATE TABLE " . _TABLE_PREFIX . "$tabela");
	echo mysql_error();
	
	$itens = explode("\n",$_POST["lista"]);
	echo "Valores inseridos para $tabela:<br>";
	foreach($itens as $i) {
		if($i!="") {
			echo $i . "<br>";
			unset($reg);	
			$reg["Valor"] = $i;
			insertData($reg,_TABLE_PREFIX . $tabela);	
		}
	}
	disconnect();
?>
	Para voltar, <a href="javascript:history.go(-1)">clique aqui</a>.
