<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="carregar.js"></script>
</head>

<body onload="javascript:inicializaAjax();carregarClientes();" bgcolor="#9999CC">
<h3 class="titulo_secao">Clientes Cadastrados</h3>
<form method="post" action="formCliente.php?tabela=clientes&acao=edita" name="Cadastro">
Digite algum trecho do nome do cliente a ser pesquisado...<br>
<input type="text" name="Nome" size="50" onFocus="iniciaLista();" onKeyUp="atualizaLista();"><br><br>
<div id="Opcoes">
</div>
<input type="submit" value="Visualizar/Editar">
</form>

<a href="formCliente.php?acao=cadastra">Cadastrar Cliente</a><br><br>

<a href="start.php">Voltar</a>
</body>

</html>