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
	var strHTML = "<table><tr><td class='formulario'><b>Forma</b></td><td class='formulario'><b>Valor</b><td class='formulario'><b>Vencimento</b></td><td class='formulario'><b>Cheque</b></td><td class='formulario'><b>Quit.</b></td><td class='formulario'><b>Data de quitação</b></td></tr>";
	for(i=1;i<=n;i++) {
		strHTML += "<tr><td><select name='forma_pgto[" + i + "]' id='FormaPgto" + i + "'><option value='Dinheiro'>Dinheiro</option><option value='Cheque'>Cheque</option><option value='Boleto Bancário'>Boleto Bancário</option><option value='Cartão de Débito-Visa'>Cartão de Débito - Visa</option><option value='Cartão de Débito-Mastercard'>Cartão de Débito - Mastercard</option><option value='Cartão de Débito-Banrisul'>Cartão de Débito - Banrisul</option><option value='Cartão de Crédito-Visa'>Cartão de Crédito - Visa</option><option value='Cartão de Crédito-Mastercard'>Cartão de Crédito - Mastercard</option></select></td>";
		strHTML += "<td><input type='text' name='parc_valor[" + i + "]' id='ParcValor" + i + "' value='0.00' size='8' onBlur=javascript:atualizaFalta(); onKeyUp=javascript:validaMonetario(this);></td>";
		strHTML += "<td><input type='text' name='parc_venc[" + i + "]' id='ParcVenc" + i + "' value='' size='8'></td>";
		strHTML += "<td><input type='text' name='parc_cheque[" + i + "]' id='ParcCheque" + i + "' value='' size='15'></td>";
		strHTML += "<td><input type='checkbox' name='parc_quitado[" + i + "]' id='ParcQuitado" + i + "' value='1'></td>";
		strHTML += "<td><input type='text' name='parc_dataquitacao[" + i + "]' id='ParcDataQuitacao" + i + "' value='' size='10'></td></tr>";
	}
	objDivParcelas = document.getElementById("divParcelas");
	objDivParcelas.innerHTML = strHTML + "</table>";		
	atualizaFalta();
}

function popFornecedor()  {
  	var wFornecedor = window.open('selecionaFornecedor.php','MyWin','width=650,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}

function setaFornecedor(id,nome) {
	document.fCadastrar.IdFornecedor.value = id;
	var FornecedorDiv = document.getElementById("divFornecedor");
	FornecedorDiv.innerHTML = nome + ' (<a href="javascript:popFornecedor();">alterar fornecedor</a>)';  
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

<h3 class="titulo_secao">Caixa - Registrar Despesa</h3>
<form name="fCadastrar" action="_cadastrar_despesa.php" method="post" onSubmit="return montaForm()">
    <input type="hidden" name="IdFornecedor" value="0">
    <input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>"> 
    <input type="hidden" name="Subtotal" value=""> 
    <input type="hidden" name="Total" value=""> 
<table class="cadastrar">
  	<tr>
    	<td class="formulario">Caixa:</td>
        <td class="formulario">
			<select name="Caixa">
				<option value="0">-</option>
				<option value="Estética">Estética</option>
				<option value="Megahair">Megahair</option>
				<option value="Administrativo">Admnistrativo</option>
			</select>
		</td>
    </tr>
  	<tr>
    	<td class="formulario">Fornecedor:</td>
        <td class="formulario"><div id="divFornecedor"><a href="javascript:popFornecedor();">Clique aqui para selecionar o fornecedor</a></div></td>
    </tr>
<tr>
	<td class="formulario">Data:</b><br></td>
	<td class="formulario"><input type="text" name="DataTransacao" value="<?=date('d/m/Y')?>" size="10"></td>
</tr>
<tr>
	<td class="formulario">Documento:</b><br></td>
	<td class="formulario"><input type="text" name="Documento"></td>
</tr>
<tr>
	<td class="formulario">Conta Bancária:</b><br></td>
	<td class="formulario">
	<select name="Conta" style="width:150px;">
		<option value="">Não se aplica</option>
<?php 
$regs = getContas();
foreach($regs as $r) {
?>
		<option value="<?=$r?>"><?=$r?></option>
<?php
}
?>		
	</select> 
	[<a href="javascript:incluirSelect(document.fCadastrar.Conta);">incluir nova</a>]
	</td>
</tr>
<tr>
	<td class="formulario" colspan="2"> 
		Descrição:</b><br>
		<textarea name="Descricao" cols="25" rows="3"></textarea>
	</td>
</tr>
<tr>
	<td class="formulario">Valor:</td>
	<td class="formulario">
		<input type="text" name="Valor" id="objValor" value="0.00" size="8" onBlur="javascript:atualizaTotal();" onKeyUp="javascript:validaMonetario(this)";>		
	</td>
</tr>
<tr>
	<td class="formulario">Entrada:</td>
	<td class="formulario">
		<select name="forma_pgto[0]" id="FormaPgto0">
			<option value="Dinheiro">Dinheiro</option>
			<option value="Cheque">Cheque</option>
			<option value="Boleto Bancário">Boleto Bancário</option>			
			<option value="Cartão de Débito-Visa">Cartão de Débito - Visa</option>
			<option value="Cartão de Débito-Mastercard">Cartão de Débito - Mastercard</option>
			<option value="Cartão de Débito-Banrisul">Cartão de Débito - Banrisul</option>
			<option value="Cartão de Crédito-Visa">Cartão de Crédito - Visa</option>
			<option value="Cartão de Crédito-Mastercard">Cartão de Crédito - Mastercard</option>
		</select>
	<input type="text" name="parc_valor[0]" id="ParcValor0" value="0.00" size="8" onBlur="javascript:atualizaFalta();" onKeyUp="javascript:validaMonetario(this)";>		
	Cheque: <input type="text" name="parc_cheque[0]" id="ParcCheque0" size="15"><br>
	Data de vencimento da entrada: <input type="text" name="parc_venc[0]" id="ParcVenc0" value="<?=date('d/m/Y')?>" size="10"><br>
	<input type="checkbox" name="parc_quitado[0]" id="ParcQuitado0" value="1">Quitado.
	Data de quitação da entrada: <input type="text" name="parc_dataquitacao[0]" id="ParcDataQuitacao0" size="10">
	</td>
</tr>
<tr>
	<td class="formulario">Parcelamento:</td>
    <td class="formulario">
		<select name="Parcelamento" onChange="javascript:setaVencimentos(this.options[this.selectedIndex].value);">
        	<option value="0">0x</option>
        	<option value="1">1x</option>
        	<option value="2">2x</option>
        	<option value="3">3x</option>
        	<option value="4">4x</option>
        	<option value="5">5x</option>
        	<option value="6">6x</option>
        	<option value="7">7x</option>
        	<option value="8">8x</option>
        	<option value="9">9x</option>
        	<option value="10">10x</option>
        	<option value="11">11x</option>
        	<option value="12">12x</option>
        </select>
	</td>
	</tr>
	<tr>
		<td class="formulario" colspan="2">Forma de pagamento<br>
		<div id="divParcelas">a definir</div><div id="divFalta"></div></td>
	</tr>
	<tr>
		<td class="formulario" colspan="2">Observações:<br>
			<textarea name="Obs" cols="25" rows="3"></textarea>
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