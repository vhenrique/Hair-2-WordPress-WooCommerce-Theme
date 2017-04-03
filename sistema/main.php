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
var n_divs = 7;
var files = new Array();
files[1] = "caixaReceita.php";
files[2] = "verReceitas.php";
files[3] = "listarOrcamentos.php";
files[4] = "listarClientes.php";
files[5] = "listarFuncionarios.php";
files[6] = "listarProdutos.php";
files[7] = "listarUsuarios.php";

function imprimir() {
	var objIFrame = document.getElementById('iframe_principal');
	alert("!");
	objIFrame.focus();
	objIFrame.contentWindow.print();
}

function mostraDiv(item_num) {
	var divEscolhida = document.getElementById("aba_item" + item_num);
	escondeDivs();
	divEscolhida.style.borderBottomColor = "#AC94B6";
	divEscolhida.style.backgroundImage = "url(aba2.png)";
	var divSubmenu = document.getElementById("div_item" + item_num);
	divSubmenu.style.visibility = "visible";		
	var iFramePrincipal = document.getElementById("iframe_principal");
	iFramePrincipal.src = files[item_num];
}

function escondeDivs() {
	for(i=1;i<=7;i++) {
		var divEscolhida = document.getElementById("aba_item" + i);
		divEscolhida.style.borderBottomColor = "#808080";
		divEscolhida.style.backgroundImage = "url(aba1.png)";
		var divSubmenu = document.getElementById("div_item" + i);
		divSubmenu.style.visibility = "hidden";		
	}
}

</script>
</head>
<body>
<center>
<table width="800" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width="100%" valign="top" colspan="7">
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="177" height="63" id="logopqno" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="movie" value="logopqno.swf" />
				<param name="quality" value="high" />
				<param name="wmode" value="transparent" />
				<param name="bgcolor" value="#ffffff" />
				<embed src="logopqno.swf" quality="high" wmode="transparent" bgcolor="#ffffff" width="177" height="63" name="logopqno" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object><br><br>
		</td>
    </tr>
	<tr>
    	<td class="aba" id="aba_item1" width="109" style="background-image:url(aba2.png);border-bottom:#AC94B6 solid 1px;" onClick="javascript:mostraDiv('1');">Caixa</td>
    	<td class="aba" id="aba_item2" width="109" onClick="javascript:mostraDiv('2');">Financeiro</td>
    	<td class="aba" id="aba_item3" width="109" onClick="javascript:mostraDiv('3');">Orçamentos</td>
    	<td class="aba" id="aba_item4" width="109" onClick="javascript:mostraDiv('4');">Clientes</td>
    	<td class="aba" id="aba_item5" width="109" onClick="javascript:mostraDiv('5');">Funcionários</td>
    	<td class="aba" id="aba_item6" width="109" onClick="javascript:mostraDiv('6');">Produtos</td>
    	<td class="aba" id="aba_item7" width="109" onClick="javascript:mostraDiv('7');">Usuários</td>
	</tr>
    <tr align="left">
		<td valign="top" valign="top" height="500" colspan="7" bgcolor="#AC94B6" style="border-bottom:#808080 solid 1px;border-left:#808080 solid 1px;border-right:#808080 solid 1px;">
            <div class="div_submenu" id="div_item1" style="visibility: visible">
				<a href="caixaReceita.php">Registra Receita</a>		
		  		<a href="caixaDespesa.php">Registra Despesa</a>
		  		<a href="caixaVale.php">Registra Vale</a>
            </div>
            <div class="div_submenu" id="div_item2">
		  		<a href="verReceitas.php">Receitas</a>		
		  		<a href="verDespesas.php">Saídas</a>		
            </div>
            <div class="div_submenu" id="div_item3">
		  		<a href="listarOrcamentos.php">Ver Orçamentos</a>		
		  		<a href="fazerOrcamento.php">Fazer Orçamento</a>		
            </div>
            <div class="div_submenu" id="div_item4">
		  		<a href="listarClientes.php">Ver</a>		
		  		<a href="formCliente.php">Cadastrar</a>		
            </div>
            <div class="div_submenu" id="div_item5">
		  		<a href="listarFuncionarios.php">Ver</a>		
		  		<a href="formFuncionario.php">Cadastrar</a>
		  		<a href="verAgenda.php">Agenda</a>
		  		<a href="verComissoes.php">Comissões</a>		  
            </div>
            <div class="div_submenu" id="div_item6">
		  		<a href="listarProdutos.php">Ver</a>		
		  		<a href="formProduto.php">Cadastrar</a>		
            </div>
            <div class="div_submenu" id="div_item7">
		  		<a href="listarUsuarios.php">Ver</a>		
		  		<a href="formUsuario.php">Cadastrar</a>		
            </div><br><br>
        	<iframe id="iframe_principal" name="principal" width="800" height="90%" src="start.php" frameborder="0" style="border:0px;"></iframe>
        </td>
	</tr>
    <tr>
    	<td colspan="7" align="right">
       	  <a onclick="javascript:imprimir();">Imprimir</a> <a href="logout.php" target="_top">Sair</a>
        </td>
    </tr>

</table>

</center>
</body>
</html>
