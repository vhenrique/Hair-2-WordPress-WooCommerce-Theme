<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sess�o n�o iniciada");
	}
?>
<html>
<head>
<title></title>
<script language="javascript">
function setaProduto() {
	var selIndex = document.Cadastro.Opcoes.selectedIndex; 
	if(selIndex != -1) {
		id = document.Cadastro.Opcoes.options[selIndex].value;
		nome = document.Cadastro.Opcoes.options[selIndex].text;	
		window.opener.setaProduto(id, nome);
		window.close();
	}
}

</script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="carregar.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>

<body onLoad="javascript:inicializaAjax();carregarProdutos2();" bgcolor="#AC94B6">
<h3 class="titulo_secao">Produtos e servi�os</h3>
<form method="post" action="formProduto.php?tabela=produtos&acao=edita" name="Cadastro">
Digite algum trecho do nome do produto ou servi�o a ser pesquisado...<br>
<input type="text" name="Nome" size="50" onFocus="iniciaLista();" onKeyUp="atualizaLista();"><br><br>
<div id="Opcoes">
</div>
<input type="button" onClick="javascript:setaProduto();" value="Selecionar">

</form>

<a href="formProduto.php?acao=cadastra">Cadastrar Produto</a><br>
<a href="formServico.php?acao=cadastra">Cadastrar Servi�o</a><br><br>


</body>

</html>