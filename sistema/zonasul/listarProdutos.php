<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sess�o n�o iniciada");
	}
	Nivel(2);
	
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<script language="javascript">
function enviaForm(action_url,confirma) {
	var f = document.Cadastro;
	var envia = true;
	f.action = action_url;
	if(confirma)
		envia = confirm("Tem certeza?");
	if(envia)
		f.submit();
}

</script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="carregar.js"></script>
</head>

<body onLoad="javascript:inicializaAjax();carregarProdutos();">
<h3 class="titulo_secao">Produtos e Servi�os</h3>
<form method="post" action="" name="Cadastro">
Digite alguma palavra-chave do produto ou servi�o a ser pesquisado...<br>
<input type="text" name="Nome" size="79" onFocus="iniciaLista();" onKeyUp="atualizaLista();"><br><br>
<input type="button" onClick="javascript:enviaForm('formProduto.php?acao=edita',false);" value="Editar">
<input type="button" onClick="javascript:enviaForm('remover.php?tabela=produtos',true);" value="Excluir">
<br><br>
<div id="Opcoes">
</div>
</form>

</body>
</html>