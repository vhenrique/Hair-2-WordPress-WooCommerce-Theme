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
files[2] = "relatorioDiario.php";
files[3] = "listarOrcamentos.php";
files[4] = "listarClientes.php";
files[5] = "listarFuncionarios.php";
files[6] = "listarProdutos.php";
files[7] = "listarUsuarios.php";
files[8] = "agenda.php";

function imprimir() {
	var objIFrame = document.getElementById('iframe_principal');
	objIFrame.contentWindow.focus();
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
	for(i=1;i<=8;i++) {
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
<table width="960" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td width="100%" valign="top" colspan="8">
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
    	<td class="aba" id="aba_item4" width="109" onClick="javascript:mostraDiv('4');">Contatos</td>
    	<td class="aba" id="aba_item5" width="109" onClick="javascript:mostraDiv('5');">Funcionários</td>
    	<td class="aba" id="aba_item6" width="109" onClick="javascript:mostraDiv('6');">Produtos</td>
    	<td class="aba" id="aba_item7" width="109" onClick="javascript:mostraDiv('7');">Usuários</td>
        <td class="aba" id="aba_item8" width="109" onClick="javascript:mostraDiv('8');">Agenda</td>
	</tr>
    <tr align="left">
		<td valign="top" width="960" height="500" colspan="8" bgcolor="#AC94B6" style="border-bottom:#808080 solid 1px; border-left:#808080 solid 1px; border-right:#808080 solid 1px;">
            <div class="div_submenu" id="div_item1" style="visibility:visible; width:800px; left:50%; margin-left:-400px;">
				<a href="caixaReceita.php">Registra Receita</a>		
		  		<a href="caixaDespesa.php">Registra Despesa</a>
		  		<a href="caixaVale.php">Registra Vale</a>
            </div>
            <div class="div_submenu" id="div_item2" style="width:800px; left:50%; margin-left:-400px;">
				<a href="relatorioDiario.php">Diário Geral</a>		
		  		<a href="relatorioDiario.php?caixa=Administrativo">Diário Administrativo</a>		
		  		<a href="relatorioDiario.php?caixa=Estética">Diário Estética</a>		
		  		<a href="relatorioDiario.php?caixa=Megahair">Diário Megahair</a>		
		  		<a href="relatorioFuncionario.php">Loc. Espaço e Vales</a>		
		  		<a href="relatorioServicos.php">Serviços</a>		
		  		<a href="verMovimentacoes.php">Movimentações</a>		
            </div>
            <div class="div_submenu" id="div_item3" style="width:800px; left:50%; margin-left:-400px;">
		  		<a href="listarOrcamentos.php">Ver Orçamentos</a>		
		  		<a href="fazerOrcamento.php">Fazer Orçamento</a>		
            </div>
            <div class="div_submenu" id="div_item4" style="width:800px; left:50%; margin-left:-400px;">
		  		<a href="listarClientes.php">Ver clientes</a>		
		  		<a href="formCliente.php">Cadastrar cliente</a>		
		  		<a href="listarFornecedores.php">Ver fornecedores</a>		
		  		<a href="formFornecedor.php">Cadastrar fornecedores</a>		
            </div>
            <div class="div_submenu" id="div_item5" style="width:800px; left:50%; margin-left:-400px;">
		  		<a href="listarFuncionarios.php">Ver</a>		
		  		<a href="formFuncionario.php">Cadastrar</a>
            </div>
            <div class="div_submenu" id="div_item6" style="width:800px; left:50%; margin-left:-400px;">
		  		<a href="listarEstoque.php">Ver Estoque</a>		
		  		<a href="listarProdutos.php">Ver Produtos e Serviços</a>		
		  		<a href="formEstoque.php">Cadastrar Estoque</a>		
		  		<a href="formProduto.php">Cadastrar Produtos</a>		
		  		<a href="formServico.php">Cadastrar Serviços</a>		
            </div>
            <div class="div_submenu" id="div_item7" style="width:800px; left:50%; margin-left:-400px;">
		  		<a href="listarUsuarios.php">Ver</a>		
		  		<a href="formUsuario.php">Cadastrar</a>		
		  		<a href="configLista.php?tabela=descontos">Descontos</a>		               
		  		<a href="configLista.php?tabela=mechas">Mechas</a>		                               
            </div>
            <div class="div_submenu" id="div_item8" style="width:800px; left:50%; margin-left:-400px;">
		  		<a href="agenda.php">Agenda do dia</a>		
		  		<a href="agendaFuncionario.php">Cadastrar</a>		
            </div>
            <br><br>
        	<iframe id="iframe_principal" name="principal" width="100%" height="90%" src="start.php" frameborder="0" style="border:0px;"></iframe>
        </td>
	</tr>
    <tr>
    	<td colspan="8" align="right">
        	<a onClick="javascript:imprimir();">Imprimir</a> <a href="logout.php" target="_top">Sair</a>
        </td>
    </tr>

</table>

</center>
</body>
</html>
