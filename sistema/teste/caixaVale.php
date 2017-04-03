<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);

?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<script language="javascript">

var total = 0;

function validaMonetario(obj) {
	var validos="0123456789";
	var valor = obj.value;
	for(i=0;i<obj.value.length;i++) 
		if(validos.indexOf(obj.value.charAt(i))==-1) {
			obj.value = obj.value.replace(obj.value.charAt(i),'');
		}

	valor = obj.value;
	
	if(valor.length<3) {
		var n = 3-valor.length;
		for(i=1;i<=n;i++)
			valor = '0' + valor;
	} else {
		if(valor.length>3 && valor.charAt(0) == '0' )
			valor = valor.replace(valor.charAt(0),'');
	}
	
	var ini = valor.substring(0,valor.length-2);
	var fim = valor.substring(valor.length-2);
	//obj.value = '';
	var valor = ini + '.' + fim;
	obj.value = valor;
}

function popCliente()  {
  	var wCliente = window.open('selecionaFuncionario.php','MyWin','width=650,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}

function setaCliente(id,nome) {
	document.fCadastrar.IdFuncionario.value = id;
	var ClienteDiv = document.getElementById("divCliente");
	ClienteDiv.innerHTML = nome + ' (<a href="javascript:popCliente();">alterar funcionário</a>)';  
}

function atualizaTotal() {
	total = document.fCadastrar.Valor.value;
}


function montaForm() {

	document.fCadastrar.Total.value = total;
	var envia = true;
	if(document.fCadastrar.IdFuncionario.value == '0') {
		envia = false;
		alert("É preciso selecionar um funcionário.");
	}
	if(document.fCadastrar.Caixa.value == '0') {
		envia = false;
		alert("É preciso selecionar um caixa.");
	}

	return envia;
}
</script>

<script type="text/javascript" src="javascript_martha.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body>

<h3 class="titulo_secao">Caixa - Registrar Receita</h3>
<form name="fCadastrar" action="_cadastrar_vale.php" method="post" onSubmit="return montaForm()">
    <input type="hidden" name="IdFuncionario" value="0">
    <input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>"> 
    <input type="hidden" name="Total" value=""> 
<table class="cadastrar">
  	<tr>
    	<td class="formulario">Caixa:</td>
        <td class="formulario">
			<select name="Caixa">
				<option value="0">-</option>
				<option value="Estética">Estética</option>
				<option value="Megahair">Megahair</option>
				<option value="Administrativo">Administrativo</option>
			</select>
		</td>
    </tr>
  	<tr>
    	<td class="formulario">Funcionário:</td>
        <td class="formulario"><div id="divCliente"><a href="javascript:popCliente();">Clique aqui para selecionar o funcionário</a></div></td>
    </tr>
<tr>
	<td class="formulario">Data:</b><br></td>
	<td class="formulario"><input type="text" name="DataTransacao" value="<?=date('d/m/Y')?>" size="10"></td>
</tr>
<tr>
	<td class="formulario">Valor:</td>
	<td class="formulario">
		<input type="text" name="Valor" id="objValor" value="0.00" size="8" onBlur="javascript:atualizaTotal();" onKeyUp="javascript:validaMonetario(this)";>		
	</td>
</tr>
<tr>
	<td colspan="2">
		<input type="submit" value="Enviar">
	</td>
</tr>
</table>
</form>
</body>
</html>