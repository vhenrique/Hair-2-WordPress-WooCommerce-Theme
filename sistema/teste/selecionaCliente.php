<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
?>
<html>
<head>
<title></title>
<script language="javascript">
function setaCliente() {
	var selIndex = document.Cadastro.Opcoes.selectedIndex; 
	if(selIndex != -1) {
		id = document.Cadastro.Opcoes.options[selIndex].value;
		nome = document.Cadastro.Opcoes.options[selIndex].text;	
		window.opener.setaCliente(id, nome);
		window.close();
	}
}

</script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="carregar.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>

<body onLoad="javascript:inicializaAjax();carregarClientes();" bgcolor="#AC94B6">
<h3 class="titulo_secao">Clientes Cadastrados</h3>
<form method="post" action="formCliente.php?tabela=clientes&acao=edita" name="Cadastro">
Digite algum trecho do nome do cliente a ser pesquisado...<br>
<input type="text" name="Nome" size="50" onFocus="iniciaLista();" onKeyUp="atualizaLista();"><br><br>
<div id="Opcoes">
</div>
<input type="button" onClick="javascript:setaCliente();" value="Selecionar">

</form>

<a href="formCliente.php?acao=cadastra">Cadastrar Cliente</a><br><br>


</body>

</html>