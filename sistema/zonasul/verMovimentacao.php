<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}

	$id = isset($_POST['id']) ? $_POST['id'] : die('Nenhum id fornecido.');
	$mvt = getMovimentacao($id);
	extract($mvt);
	if($Tipo == 'receita') {
		$cliente = getCliente($IdCliente);
		$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
		$rec = getReceita($IdPai);
		$descricao = $cliente . " - " . implode(', ',explode('||',$rec['ServicosNomes'])) . "(Parcela " . $ParcNum . "/" . $rec['Parcelamento'] . ")";			
		$cor = '#66CC33';
	} else {
		$fornecedor = getFornecedor($IdFornecedor);
		$fornecedor = $fornecedor["Nome"] . " " . $fornecedor["Sobrenome"]; 
		$desp = getDespesa($IdPai);
		$descricao = $fornecedor . " - " . implode(', ',explode('||',$desp['ServicosNomes'])) . "(Parcela " . $ParcNum . "/" . $desp['Parcelamento'] . ")";			
		$cor = '#FF3333';
	}	
	
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<script language="javascript">

var total = 0;
var subtotal = 0;


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

function setaVencimentos(n) {
	var strHTML = "<table><tr><td class='formulario'><b>Forma</b></td><td class='formulario'><b>Valor</b><td class='formulario'><b>Vencimento</b></td></tr>";
	for(i=1;i<=n;i++) {
		strHTML += "<tr><td><select name='forma_pgto[" + i + "]' id='FormaPgto" + i + "'><option value='Dinheiro'>Dinheiro</option><option value='Cheque'>Cheque</option><option value='Cartão de Débito-Visa'>Cartão de Débito - Visa</option><option value='Cartão de Débito-Mastercard'>Cartão de Débito - Mastercard</option><option value='Cartão de Débito-Banrisul'>Cartão de Débito - Banrisul</option><option value='Cartão de Crédito-Visa'>Cartão de Crédito - Visa</option><option value='Cartão de Crédito-Mastercard'>Cartão de Crédito - Mastercard</option></select></td>";
		strHTML += "<td><input type='text' name='parc_valor[" + i + "]' id='ParcValor" + i + "' value='0.00' size='8' onBlur=javascript:atualizaFalta(); onKeyUp=javascript:validaMonetario(this);></td>";
		strHTML += "<td><input type='text' name='parc_venc[" + i + "]' id='ParcVenc" + i + "' value='' size='8'></td></tr>";
	}
	objDivParcelas = document.getElementById("divParcelas");
	objDivParcelas.innerHTML = strHTML + "</table>";		
	atualizaFalta();
}

function popCliente()  {
  	var wCliente = window.open('selecionaCliente.php','MyWin','width=650,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}

function setaCliente(id,nome) {
	document.fCadastrar.IdFornecedor.value = id;
	var ClienteDiv = document.getElementById("divCliente");
	ClienteDiv.innerHTML = nome + ' (<a href="javascript:popCliente();">alterar cliente</a>)';  
}

function atualizaTotal() {
	total = document.fCadastrar.Valor.value;
}

function atualizaFalta() {
	var n_parc = document.fCadastrar.Parcelamento.options[document.fCadastrar.Parcelamento.selectedIndex].value
	var total_parcelas = 0;
	for(i=0;i<=n_parc;i++)
		if(document.getElementById("ParcValor"+i).value!="")
			total_parcelas += parseFloat(document.getElementById("ParcValor"+i).value);
	falta = total - total_parcelas;
	objDivFalta = document.getElementById("divFalta");
	if(falta!='0') 
		objDivFalta.innerHTML = "<b>Diferença: R$ " + falta.toFixed(2).toString().replace('.',',') + "<b>";
	else
		objDivFalta.innerHTML = "";
}


function montaForm() {

	document.fCadastrar.Subtotal.value = subtotal;
	document.fCadastrar.Total.value = total;
	var envia = true;
	if(document.fCadastrar.IdFornecedor.value == '0') {
		envia = false;
		alert("É preciso selecionar um fornecedor.");
	}

	return envia;
}
</script>

<script type="text/javascript" src="javascript_martha.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body>

<h3 class="titulo_secao">Caixa - Parcela de <?=$Tipo?></h3>
<form name="fCadastrar" action="_editar_parcela.php" method="post" onSubmit="return montaForm()">
    <input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>"> 
    <input type="hidden" name="Subtotal" value=""> 
    <input type="hidden" name="Total" value=""> 
<table class="cadastrar">
  	<tr>
    	<td class="formulario"><?php if($Tipo=='despesa') echo 'Fornecedor:'; else echo 'Cliente:'; ?></td>
        <td class="formulario"><?php if($Tipo=='despesa') echo $fornecedor; else echo $cliente; ?></div></td>
    </tr>
<tr>
	<td class="formulario">Descrição:</b><br></td>
	<td class="formulario"><?=$descricao?></td>
</tr>
<tr>
	<td class="formulario">Vencimento da parcela:</b><br></td>
	<td class="formulario"><?=ParcVenc?></td>
</tr>
<tr>
	<td class="formulario">Data de Quitação:</b><br></td>
	<td class="formulario"><input type="text" name="DataQuitacao" value=""></td>
</tr>
<tr>
	<td class="formulario">Valor:</td>
	<td class="formulario"><?=$Valor?></td>
</tr>
<tr>
	<td class="formulario">Abatimentos:</td>
	<td class="formulario">
		<input type="text" name="Abatimentos" id="objAbat" value="0.00" size="8" onBlur="javascript:atualizaTotal();" onKeyUp="javascript:validaMonetario(this)";>		
	</td>
</tr>
<tr>
	<td class="formulario">Acréscimos:</td>
	<td class="formulario">
		<input type="text" name="Acrescimos" id="objAcresc" value="0.00" size="8" onBlur="javascript:atualizaTotal();" onKeyUp="javascript:validaMonetario(this)";>		
	</td>
</tr>
	<tr>
		<td class="formulario" colspan="2">Observações:<br>
			<textarea name="Obs" cols="25" rows="3"></textarea>
		</td>
	</tr>
<tr>
	<td colspan="2">
		<input type="submit" value="Atualizar">
	</td>
</tr>
</table>
</form>
</body>
</html>