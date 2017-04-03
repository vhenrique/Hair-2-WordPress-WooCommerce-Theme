<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	if(isset($_GET["id"])) {
		$id = $_GET["id"];
		$edita=true;
		$reg = getCompromisso($id);
		extract($reg);
	}
	else
		die("Nenhum Id fornecido");


?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<script type="text/javascript" src="javascript_martha.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body bgcolor="#AC94B6">
<h3 class="titulo_secao">
<form action="editar.php?id=<?=$id?>&tabela=agenda" method="post">
Observação:<br>
<textarea name="Obs" cols="25" rows="4"><?=$Obs?></textarea><br>
<input type="submit" value="Enviar">
</form>
</body>
</html>