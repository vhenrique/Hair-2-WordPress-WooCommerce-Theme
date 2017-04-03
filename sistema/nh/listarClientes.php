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

<body onLoad="javascript:inicializaAjax();carregarClientes();">
<h3 class="titulo_secao">Clientes Cadastrados</h3>
<form method="post" action="" name="Cadastro">
Digite alguma palavra-chave do nome do cliente a ser pesquisado...<br>
<input type="text" name="Nome" size="79" onFocus="iniciaLista();" onKeyUp="atualizaLista();"><br><br>
<input type="button" onClick="javascript:enviaForm('formCliente.php?acao=edita',false);" value="Editar">
<input type="button" onClick="javascript:enviaForm('termosCliente.php',false);" value="Termos e Contratos">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onClick="javascript:enviaForm('remover.php?tabela=clientes',true);" value="Excluir">
<br><br>
<div id="Opcoes">
</div>
</form>

</body>
</html>