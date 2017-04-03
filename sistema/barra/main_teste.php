<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}

?>

<html>
<head>
<base target="principal">
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(gradiente.jpg);
	color: #FFFFFF;
}

-->
</style>
<script language="javascript">
function mostra(div_id) {
	var divEscolhida = document.getElementById(div_id);
	divEscolhida.style.visibility = "visible";
}

</script>
</head>
<body>
<center>
<img src="abas_teste.png">
</center>
</body>
</html>
