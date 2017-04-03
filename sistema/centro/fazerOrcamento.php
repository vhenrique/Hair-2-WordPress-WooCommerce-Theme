<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}

?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<script language="javascript">
var valor_total = 0;
var total_final = 0;
var falta = 0;
var total_mechas = 0;
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
	var strHTML = "<table><tr><td class='formulario'><b>Forma</b></td><td class='formulario'><b>Valor</b></td><td class='formulario'><b>Vencimento</b></td></tr>";
	var aux_parcela = (total_final - parseFloat(document.getElementById("ParcValor0").value))/n;
	aux_parcela = aux_parcela.toFixed(2);
	for(i=1;i<=n;i++) {
		strHTML += "<tr><td><select name='forma_pgto[" + i + "]' id='FormaPgto" + i + "'><option value='Dinheiro'>Dinheiro</option><option value='Cheque'>Cheque</option><option value='Cartão de Débito-Visa'>Cartão de Débito - Visa</option><option value='Cartão de Débito-Mastercard'>Cartão de Débito - Mastercard</option><option value='Cartão de Débito-Banrisul'>Cartão de Débito - Banrisul</option><option value='Cartão de Crédito-Visa'>Cartão de Crédito - Visa</option><option value='Cartão de Crédito-Mastercard'>Cartão de Crédito - Mastercard</option></select></td>";
		strHTML += "<td><input type='text' name='parc_valor[" + i + "]' id='ParcValor" + i + "' value='" + aux_parcela + "' size='8' onBlur=javascript:atualizaFalta(); onKeyUp=javascript:validaMonetario(this);></td>";
		strHTML += "<td><input type='text' name='parc_venc[" + i + "]' id='ParcVenc" + i + "' value='' size='8'></td></tr>";
	}
	objDivParcelas = document.getElementById("divParcelas");
	objDivParcelas.innerHTML = strHTML + "</table>";		
	atualizaFalta();
}

function atualizaSubtotal() {
	valor_total = 0;
	for(i=1;i<=6;i++)
		if(document.getElementById("ServValor"+i).value!="")
			valor_total += parseFloat(document.getElementById("ServValor"+i).value);
	var selIndexDesc = document.fCadastrar.Desconto.selectedIndex; 
	var desconto = document.fCadastrar.Desconto.options[selIndexDesc].value;
	document.fCadastrar.Subtotal.value = parseFloat(valor_total);
	objDivTotal = document.getElementById("divTotal");
	objDivTotal.innerHTML = "R$ " + valor_total.toFixed(2).toString().replace('.',',');;
	valor_total = parseFloat(valor_total)*parseFloat(desconto);		
	objDivDesconto = document.getElementById("divDesconto");
	objDivDesconto.innerHTML = "<b>Total com desconto: </b> R$ " + valor_total.toFixed(2).toString().replace('.',',');;
	atualizaTotal();
}

function atualizaTotalMechas() {
	var num_mechas = document.fCadastrar.NumMechas.options[document.fCadastrar.NumMechas.selectedIndex].value
	var preco_mecha = document.fCadastrar.PrecoMecha.options[document.fCadastrar.PrecoMecha.selectedIndex].value;
	total_mechas = parseFloat(num_mechas)*parseFloat(preco_mecha);
	objDivTotalMechas = document.getElementById("divTotalMechas");
	objDivTotalMechas.innerHTML = "R$ " + total_mechas.toFixed(2).toString().replace('.',',');
	document.getElementById("ServValor1").value = total_mechas.toFixed(2);
	atualizaSubtotal();
}

function atualizaFalta() {
	var n_parc = document.fCadastrar.Parcelamento.options[document.fCadastrar.Parcelamento.selectedIndex].value
	var total_parcelas = 0;
	for(i=0;i<=n_parc;i++)
		if(document.getElementById("ParcValor"+i).value!="")
			total_parcelas += parseFloat(document.getElementById("ParcValor"+i).value);
	falta = valor_total - total_parcelas;
	objDivFalta = document.getElementById("divFalta");
	if(falta.toFixed(2) != 0.00) 
		objDivFalta.innerHTML = "<b>Diferença: R$ " + falta.toFixed(2).toString().replace('.',',') + "<b>";
	else
		objDivFalta.innerHTML = "";
}


function popCliente()  {
  	var wCliente = window.open('selecionaCliente.php','MyWin','width=650,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}

function setaCliente(id,nome) {
	document.fCadastrar.IdCliente.value = id;
	var ClienteDiv = document.getElementById("divCliente");
	ClienteDiv.innerHTML = nome + ' (<a href="javascript:popCliente();">alterar cliente</a>)';  
}

function atualizaTotal() {
	total_final = valor_total; 	
	objDivTotalFinal = document.getElementById("divTotalFinal");
	objDivTotalFinal.innerHTML = "TOTAL: R$ " + total_final.toFixed(2).toString().replace('.',',');
}

function montaForm() {
	var serv_nomes = "";
	var serv_valores = "";
	var selIndexDesc = document.fCadastrar.Desconto.selectedIndex; 
	var desconto = document.fCadastrar.Desconto.options[selIndexDesc].value;

	document.fCadastrar.Total.value = total_final;
	document.fCadastrar.TotalMechas.value = total_mechas;
	var envia = false;
	if((document.fCadastrar.IdCliente.value != '0') && (falta == '0.00'))
		envia = true;
	else {
		if(document.fCadastrar.IdCliente.value == '0')
			alert("É preciso selecionar um cliente para o orçamento.");
		if(falta != '0.00')
			alert("A soma das parcelas não coincide com o total.");
	}
	return envia;
}
</script>

<script type="text/javascript" src="javascript_martha.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body>

<h3 class="titulo_secao">Fazer Orçamento</h3>
<form name="fCadastrar" action="cadastrar.php?tabela=orcamentos" method="post" onSubmit="return montaForm()">
<input type="hidden" name="IdCliente" value="0">
<input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>"> 
<input type="hidden" name="ServicosNomes" value=""> 
<input type="hidden" name="ServicosValores" value=""> 
<input type="hidden" name="Subtotal" value=""> 
<input type="hidden" name="TotalMechas" value=""> 
<input type="hidden" name="Total" value=""> 
<table class="cadastrar">
  	<tr>
    	<td class="formulario">Cliente:</td>
        <td class="formulario"><div id="divCliente"><a href="javascript:popCliente();">Clique aqui para selecionar o cliente</a></div></td>
    </tr>
<tr>
	<td class="formulario" colspan="2"><br><b>Descrição do cabelo do cliente</b></td>
</tr>
	<td class="formulario">Cor:</td>
	<td><input type="text" name="CabeloCor" size="20">
</tr>
</tr>
<tr>
	<td class="formulario">Tipo do cabelo:</td>
	<td>
    	<select name="CabeloTipo">
        	<option value="0">-</option>
        	<option value="Liso">Liso</option>
        	<option value="Ondulado">Ondulado</option>
        	<option value="Crespo">Crespo</option>
        	<option value="Jeitoso">Jeitoso</option>
        	<option value="Crespo mola">Crespo mola</option>
        </select>
    </td>
</tr>
<tr>
	<td class="formulario">Tipo:</td>
	<td>
    	<select name="Tipo">
        	<option value="0">-</option>
        	<option value="Micro">Micro</option>
        	<option value="Normal">Normal</option>
        </select>
    </td>
</tr>
<tr>
	<td class="formulario">Comprimento:</td>
	<td class="formulario">
    	<select name="CabeloComprimento"><?php
				for($i=1;$i<=60;$i++) {
				?>
			<option value="<?=$i?>"><?=$i?>cm</option><?php		
				}
			?>
        </select>
    </td>
</tr>
<tr>
	<td class="formulario">Peso:</td>
	<td><input type="text" name="CabeloPeso" size="20">
</tr>
<tr>
	<td class="formulario">Número de mechas:</td>
	<td><select name="NumMechas" onChange="javascript:atualizaTotalMechas();"><?php
				for($i=1;$i<=400;$i++) {
				?>
			<option value="<?=$i?>"><?=$i?></option><?php		
				}
			?>
        </select></td>
</tr>
<tr>
	<td class="formulario">Preço unitário da mecha:</td>
	<td><select name="PrecoMecha" onChange="javascript:atualizaTotalMechas();">
<?php
	$preco_mecha = getAll("mechas");
	foreach($preco_mecha as $p) {
?>
		<option value="<?=$p["Valor"]?>"><?=number_format($p["Valor"],"2",",",".")?></option>
<?php
	}
?>
        </select>
	</td>
</tr>
<tr>
	<td class="formulario">Total em mechas</td>
	<td class="formulario"><div id="divTotalMechas">R$ 0,00</div></td>
</tr>    		
<tr>
	<td class="formulario" colspan="2">Outras informações:<br>
	<textarea name="Obs" cols="60" rows="5"></textarea></td>
</tr>
<tr>
	<td class="formulario" colspan="2"><br><b>Descrição do serviço</b><br></td>
</tr>
<tr>
	<td colspan="2" class="formulario">

<table>
	<tr>
		<td class="formulario" width="400" valign="top"><b>Descrição</b></td>    
		<td class="formulario" width="80" valign="top"><b>Valor</b></td>    
    </tr>
    <tr>
		<td class="formulario" width="400" valign="top"><input type="text" name="serv_desc[1]" size="60" value="MEGAHAIR"></td>    
		<td class="formulario" width="80" valign="top"><input type="text" id="ServValor1" name="serv_valor[1]" size="10" value="0.00" onBlur="javascript:atualizaSubtotal();" onKeyUp="javascript:validaMonetario(this);"></td>    
	</tr>
    <tr>
		<td class="formulario" width="400" valign="top"><input type="text" name="serv_desc[2]" size="60"></td>    
		<td class="formulario" width="80" valign="top"><input type="text" id="ServValor2" name="serv_valor[2]" size="10" onBlur="javascript:atualizaSubtotal();" onKeyUp="javascript:validaMonetario(this);"></td>    
	</tr>
    <tr>
		<td class="formulario" width="400" valign="top"><input type="text" name="serv_desc[3]" size="60"></td>    
		<td class="formulario" width="80" valign="top"><input type="text" id="ServValor3" name="serv_valor[3]" size="10" onBlur="javascript:atualizaSubtotal();" onKeyUp="javascript:validaMonetario(this);"></td>    
	</tr>
    <tr>
		<td class="formulario" width="400" valign="top"><input type="text" name="serv_desc[4]" size="60"></td>    
		<td class="formulario" width="80" valign="top"><input type="text" id="ServValor4" name="serv_valor[4]" size="10" onBlur="javascript:atualizaSubtotal();" onKeyUp="javascript:validaMonetario(this);"></td>    
	</tr>
    <tr>
		<td class="formulario" width="400" valign="top"><input type="text" name="serv_desc[5]" size="60"></td>    
		<td class="formulario" width="80" valign="top"><input type="text" id="ServValor5" name="serv_valor[5]" size="10" onBlur="javascript:atualizaSubtotal();" onKeyUp="javascript:validaMonetario(this);"></td>    
	</tr>
    <tr>
		<td class="formulario" width="400" valign="top"><input type="text" name="serv_desc[6]" size="60"></td>    
		<td class="formulario" width="80" valign="top"><input type="text" id="ServValor6" name="serv_valor[6]" size="10" onBlur="javascript:atualizaSubtotal();" onKeyUp="javascript:validaMonetario(this);"></td>    
	</tr>
    <tr>
    	<td class="formulario" align="right"><b>Subtotal</b></td>
        <td class="formulario"><b><div id="divTotal">R$ 0,00</div></b></td>
    </tr>
</table>
    </td>
</tr>
<tr>
	<td class="formulario">Desconto:</td>
	<td class="formulario">
    	<select name="Desconto" onChange="javascript:atualizaSubtotal()">
        	<option value="1">-</option>
<?php
	$desconto = getAll("descontos");
	foreach($desconto as $d) {
?>
		<option value="<?=(1-$d["Valor"]*0.01)?>"><?=number_format($d["Valor"],"0",",",".")?>%</option>
<?php
	}
?>
        </select><br> 
		<div id="divDesconto"></div>
	</td>	
</tr>	    		
<tr>
	<td class="formulario">Entrada:</td>
	<td><select name="forma_pgto[0]" id="FormaPgto0">
			<option value="Dinheiro">Dinheiro</option>
			<option value="Cheque">Cheque</option>
			<option value="Cartão de Débito-Visa">Cartão de Débito - Visa</option>
			<option value="Cartão de Débito-Mastercard">Cartão de Débito - Mastercard</option>
			<option value="Cartão de Débito-Banrisul">Cartão de Débito - Banrisul</option>
			<option value="Cartão de Crédito-Visa">Cartão de Crédito - Visa</option>
			<option value="Cartão de Crédito-Mastercard">Cartão de Crédito - Mastercard</option>
		</select>
		<input type="text" name="parc_valor[0]" id="ParcValor0" value="0.00" size="8" onBlur="javascript:atualizaFalta();" onKeyUp="javascript:validaMonetario(this)";>
		<input type="hidden" name="parc_venc[0]" id="ParcVenc0" value="<?=date('d/m/Y')?>"></td></tr>
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
	<tr>
		<td class="formulario">Forma de pagamento</td>
		<td class="formulario"><div id="divParcelas">a definir</div><div id="divFalta"></div></td>
	</tr>
<tr>
	<td class="formulario"></td>
	<td class="formulario" align="right"><b><div id="divTotalFinal">TOTAL: R$ 0,00</div></b></td>
</tr>
<tr>
	<td class="formulario">Manutenção:</td>
	<td><input type="text" name="Manutencao" size="8" value="0.00" onKeyUp="javascript:validaMonetario(this);"">
</tr>
<tr>
	<td colspan="2">
		<input type="submit" value="Gravar Orçamento">
	</td>
</tr>
</table>
</form>
</body>
</html>