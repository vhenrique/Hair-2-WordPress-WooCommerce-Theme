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

<body onLoad="javascript:inicializaAjax();carregarFuncionarios();">
<h3 class="titulo_secao">Funcionários Cadastrados</h3>
<form method="post" action="formFuncionario.php?acao=edita" name="Cadastro">
Digite algum trecho do nome do funcionário a ser pesquisado...<br>
<input type="text" name="Nome" size="50" onFocus="iniciaLista();" onKeyUp="atualizaLista();"><br><br>
<div id="Opcoes">
</div>
<input type="submit" value="Visualizar/Editar">
</form>

<a href="formFuncionario.php?acao=cadastra">Cadastrar Funcionário</a><br><br>

<a href="start.php">Voltar</a>
</body>

</html>