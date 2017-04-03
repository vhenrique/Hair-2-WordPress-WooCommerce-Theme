<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);

	$id = isset($_GET['id']) ? $_GET['id'] : die('Nenhum id fornecido.');
	$mvt = getMovimentacao($id);
	extract($mvt);
	if($Tipo == 'receita') {
		$cliente = getCliente($IdCliente);
		$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
		$rec = getReceita($IdPai);
		$descricao = $cliente . " - " . $rec['ServicosNomes'] . "(Parcela " . $ParcNum . "/" . $rec['Parcelamento'] . ")";			
		$cor = '#66CC33';
	} else {
		$fornecedor = getFornecedor($IdFornecedor);
		$fornecedor = $fornecedor["Nome"] . " " . $fornecedor["Sobrenome"]; 
		$desp = getDespesa($IdPai);
		$descricao = $fornecedor . " - " . $desp['ServicosNomes'] . "(Parcela " . $ParcNum . "/" . $desp['Parcelamento'] . ")";			
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
	total = parseFloat('<?=$ParcValor?>') - parseFloat(document.fCadastrar.Abatimentos.value) + parseFloat(document.fCadastrar.Acrescimos.value);
	objTotal = document.getElementById("divTotal");
	objTotal.innerHTML = "<b>R$ " + total.toFixed(2).toString().replace('.',',') + "<b>";	
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

function liberaSubmit() {
	if(document.fCadastrar.DataQuitacao.value!="")
		document.fCadastrar.quitar.disabled = false;
	else
		document.fCadastrar.quitar.disabled = true;
}

function montaForm() {
	document.fCadastrar.TotalPago.value = total;
	var envia = true;

	return envia;
}
</script>

<script type="text/javascript" src="javascript_martha.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body>

<h3 class="titulo_secao">Caixa - Parcela de <?=$Tipo?></h3>
<form name="fCadastrar" action="editar.php?tabela=movimentacoes&id=<?=$Id?>" method="post" onSubmit="return montaForm()">
    <input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>"> 
    <input type="hidden" name="TotalPago" value=""> 
    <input type="hidden" name="Quitado" value="1"> 
    <input type="hidden" name="ParcValor" value="<?=$ParcValor?>"> 
	
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
	<td class="formulario">Cheque:</b><br></td>
	<td class="formulario"><?=$ParcCheque?></td>
</tr>
<?php if($Tipo == 'despesa' || $Tipo == 'vale') { ?>
<tr>
	<td class="formulario">Conta Bancária:</b><br></td>
	<td class="formulario">
<?php if($Quitado) echo $Conta; else { ?>	
	<select name="Conta" style="width:150px;">
		<option value="">Não se aplica</option>
<?php 
$regs = getContas();
		foreach($regs as $r) {
?>
		<option value="<?=$r?>" <?php if($Conta == $r) echo "SELECTED"; ?>><?=$r?></option>
<?php
}
?>		
	</select> 
	[<a href="javascript:incluirSelect(document.fCadastrar.Conta);">incluir nova</a>]
	
	</td>
</tr>
		<?php } // end foreach
	} // end if	 
?>
<tr>
	<td class="formulario">Vencimento da parcela:</b><br></td>
	<td class="formulario"><?=date('d/m/Y',strtotime($ParcVenc))?></td>
</tr>
<tr>
	<td class="formulario">Data de Quitação:</b><br></td>
	<td class="formulario"><?php if($Quitado) { echo date('d/m/Y',strtotime($DataQuitacao)); } else { ?><input type="text" name="DataQuitacao" value="" onKeyUp="javascript:liberaSubmit();"> <?php } ?></td>
</tr>
<tr>
	<td class="formulario">Valor da parcela:</td>
	<td class="formulario">R$ <?=number_format($ParcValor, 2, ',','.')?></td>
</tr>
<tr>
	<td class="formulario">Abatimentos:</td>
	<td class="formulario"><?php if($Quitado) { echo 'R$ ' . number_format($Abatimentos, 2, ',','.'); } else { ?>
		<input type="text" name="Abatimentos" id="objAbat" value="0.00" size="8" onBlur="javascript:atualizaTotal();" onKeyUp="javascript:validaMonetario(this)";><?php } ?>		
	</td>
</tr>
<tr>
	<td class="formulario">Acréscimos:</td>
	<td class="formulario"><?php if($Quitado) { echo 'R$ ' . number_format($Acrescimos, 2, ',','.'); } else { ?>
		<input type="text" name="Acrescimos" id="objAcresc" value="0.00" size="8" onBlur="javascript:atualizaTotal();" onKeyUp="javascript:validaMonetario(this)";><?php } ?>				
	</td>
<tr>
	<td class="formulario">Total <?php if($Quitado) echo 'pago'; else echo 'a pagar'; ?>:</td>
	<td class="formulario"><div id="divTotal"><b>R$ <?php if($Quitado) echo number_format($TotalPago, 2, ',','.'); else echo number_format($ParcValor, 2, ',','.'); ?></b></div></td>
</tr>
</tr>
	<tr>
		<td class="formulario" colspan="2">Observações:<br>
			<?php if($Quitado) echo $Obs; else { ?>	
			<textarea name="Obs" cols="25" rows="3"></textarea>
			<?php } ?>
		</td>
	</tr>
<tr>
	<td colspan="2">
		<?php if(!$Quitado) { ?> <input type="submit" name="quitar" value="Quitar" disabled> <?php } ?>
	</td>
</tr>
</table>
</form>
</body>
</html>