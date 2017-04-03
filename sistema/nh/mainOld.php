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
</head>
<body>
<center>
<table width="900" height="550" background="fundoupload.jpg" cellpadding="0" cellspacing="0" border="0"><tr><td colspan="2" valign="top" height="63"><table width="100%" border="0" cellspacing="5" cellpadding="5">
		 <tr>
          <td height="550" width="200" valign="top">Menu lateral<br><br>
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="177" height="63" id="logopqno" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="movie" value="logopqno.swf" />
				<param name="quality" value="high" />
				<param name="wmode" value="transparent" />
				<param name="bgcolor" value="#ffffff" />
				<embed src="logopqno.swf" quality="high" wmode="transparent" bgcolor="#ffffff" width="177" height="63" name="logopqno" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>
		  <br><br>
		  Caixa<br>
		  > <a href="caixaReceita.php">Registra Receita</a><br>		
		  > <a href="caixaDespesa.php">Registra Despesa</a><br><br>		
		  
		  Financeiro<br>
		  > <a href="verReceitasFuturas.php">A Receber</a><br>		
		  > <a href="verDespesasFuturas.php">A Pagar</a><br>		
		  > <a href="verReceitasFuturas.php?status=vencido">A Receber - Vencidos</a><br>		
		  > <a href="verDespesasFuturas.php?status=vencido">A Pagar - Vencidos</a><br>		
		  > <a href="Relatorios.php">Relatórios</a><br><br>		

		  Orçamentos<br>
		  > <a href="listarOrcamentos.php?status=executados">Ver Executados</a><br>		
		  > <a href="listarOrcamentos.php?status=naoexecutados">Ver Não-Executados</a><br>		
		  > <a href="formCliente.php">Fazer</a><br><br>		

		  Clientes<br>
		  > <a href="listarClientes.php">Ver</a><br>		
		  > <a href="formCliente.php">Cadastrar</a><br><br>		

		  Funcionários<br>
		  > <a href="listarFuncionarios.php">Ver</a><br>		
		  > <a href="formFuncionario.php">Cadastrar</a><br>
		  > <a href="verAgenda.php">Agenda</a><br>
		  > <a href="verComissoes.php">Loc. Espaço</a><br><br>		  

		  Produtos<br>
		  > <a href="listarProdutos.php">Ver</a><br>		
		  > <a href="formProduto.php">Cadastrar</a><br><br>		

		  Usuários<br>
		  > <a href="listarUsuarios.php">Ver</a><br>		
		  > <a href="formUsuario.php">Cadastrar</a><br>		

		  </td>
		  <td valign="top" rowspan="2" valign="top"><iframe name="principal" width="600" height="90%" src="start.php" style="border:none;"></iframe></td>
		</tr>
</table>
</center>
</body>
</html>
