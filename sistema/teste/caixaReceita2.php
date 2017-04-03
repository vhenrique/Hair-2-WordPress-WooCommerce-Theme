<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	if(isset($_POST["Opcoes"])) {
		if(isset($_GET["ref"]) && ($_GET["ref"] == "orcamento")) {
			$orcamento = getOrcamento($_POST["Opcoes"]);
			extract($orcamento);
		} else
			$orcamento = false;
	}
		

?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<script language="javascript">
var com_id = new Array();
var com_nome = new Array();
var com_perc = new Array();
var com_perc_txt = new Array();
var com_valor = new Array();

var servicos_id = new Array();
var servicos_nome = new Array();
var servicos_ref = new Array();
var servicos_valor = new Array();
<?php if($orcamento) { ?>
	var total_final = '<?=$Total?>';
	var valor_total = '<?=$Total?>';
<?php } else { ?>
	var total_final = 0;
	var valor_total = 0;
<?php } ?>

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
	var strHTML = "<table><tr><td class='formulario'><b>Forma</b></td><td class='formulario'><b>Valor</b><td class='formulario'><b>Vencimento</b></td><td class='formulario'><b>Cheque</b></td></tr>";
	for(i=1;i<=n;i++) {
		strHTML += "<tr><td><select name='forma_pgto[" + i + "]' id='FormaPgto" + i + "'><option value='Dinheiro'>Dinheiro</option><option value='Cheque'>Cheque</option><option value='Cartão de Débito-Visa'>Cartão de Débito - Visa</option><option value='Cartão de Débito-Mastercard'>Cartão de Débito - Mastercard</option><option value='Cartão de Débito-Banrisul'>Cartão de Débito - Banrisul</option><option value='Cartão de Crédito-Visa'>Cartão de Crédito - Visa</option><option value='Cartão de Crédito-Mastercard'>Cartão de Crédito - Mastercard</option></select></td>";
		strHTML += "<td><input type='text' name='parc_valor[" + i + "]' id='ParcValor" + i + "' value='0.00' size='8' onBlur=javascript:atualizaFalta(); onKeyUp=javascript:validaMonetario(this);></td>";
		strHTML += "<td><input type='text' name='parc_venc[" + i + "]' id='ParcVenc" + i + "' value='' size='8'></td>";
		strHTML += "<td><input type='text' name='parc_cheque[" + i + "]' id='ParcCheque" + i + "' value='' size='15'></td></tr>";
	}
	objDivParcelas = document.getElementById("divParcelas");
	objDivParcelas.innerHTML = strHTML + "</table>";		
	atualizaFalta();
}

function popProduto()  {
  	var wProduto = window.open('selecionaProduto.php','MyWin','width=650,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}


function popCliente()  {
  	var wCliente = window.open('selecionaCliente.php','MyWin','width=650,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}

function setaCliente(id,nome) {
	document.fCadastrar.IdCliente.value = id;
	var ClienteDiv = document.getElementById("divCliente");
	ClienteDiv.innerHTML = nome + ' (<a href="javascript:popCliente();">alterar cliente</a>)';  
}

function setaProduto(id,nome) {
	var servico = nome.split(' - ');
	servicos_nome[servicos_id.length] = servico[0];
	servicos_ref[servicos_id.length] = servico[1];
	servicos_valor[servicos_id.length] = servico[2];
	servicos_id[servicos_id.length] = id;
	atualizaServicos();
}

function retiraProduto(n) {
	servicos_id[n] = 0;
	atualizaServicos();
}

function atualizaServicos() {
	valor_total = 0;
	objDivReferencias = document.getElementById("divReferencias");
	objDivServicos = document.getElementById("divServicos");
	objDivValores = document.getElementById("divValores");
	objDivTotal = document.getElementById("divTotal");
	objDivReferencias.innerHTML = "";
	objDivServicos.innerHTML = "";
	objDivValores.innerHTML = "";
	for(i=0;i<servicos_id.length;i++) {
		if(servicos_id[i]!=0) {
			objDivReferencias.innerHTML = objDivReferencias.innerHTML + "<br><a href='javascript:retiraProduto(" + i + ");'>(-)</a> " + servicos_ref[i]; 
			objDivServicos.innerHTML = objDivServicos.innerHTML + "<br>" + servicos_nome[i];
			objDivValores.innerHTML = objDivValores.innerHTML + "<br>R$ " + parseFloat(servicos_valor[i]).toFixed(2).toString().replace('.',',');
			valor_total += parseFloat(servicos_valor[i]);
		}
	}
	valor_total = valor_total.toFixed(2);
	objDivTotal.innerHTML = "R$ " + valor_total.toString().replace('.',',');	
	atualizaTotal();
}

function atualizaTotal() {
	objDivTotalFinal = document.getElementById("divTotalFinal");
	var selIndex = document.fCadastrar.Desconto.selectedIndex; 
	var desconto = document.fCadastrar.Desconto.options[selIndex].value;
	var total = valor_total*desconto;
	objDivTotalFinal.innerHTML = "R$ " + total.toFixed(2).toString().replace('.',',');;
	total_final = total; 	
}

function atualizaFalta() {
	var n_parc = document.fCadastrar.Parcelamento.options[document.fCadastrar.Parcelamento.selectedIndex].value
	var total_parcelas = 0;
	for(i=0;i<=n_parc;i++)
		if(document.getElementById("ParcValor"+i).value!="")
			total_parcelas += parseFloat(document.getElementById("ParcValor"+i).value);
	falta = total_final - total_parcelas;
	objDivFalta = document.getElementById("divFalta");
	if(falta.toFixed(2) != 0.00) 
		objDivFalta.innerHTML = "<b>Diferença: R$ " + falta.toFixed(2).toString().replace('.',',') + "<b>";
	else
		objDivFalta.innerHTML = "";	
}


function montaForm() {

	document.fCadastrar.ServicosRefs.value = servicos_ref.join('||');
	document.fCadastrar.ServicosNomes.value = servicos_nome.join('||');
	document.fCadastrar.ServicosValores.value = servicos_valor.join('||');
	document.fCadastrar.Subtotal.value = valor_total;
	document.fCadastrar.Total.value = total_final;
	document.fCadastrar.com_perc.value = com_perc.join('||');
	document.fCadastrar.com_valor.value = com_valor.join('||');
	document.fCadastrar.com_id.value = com_id.join('||');
	var envia = true;
	if(document.fCadastrar.IdCliente.value == '0') {
		envia = false;
		alert("É preciso selecionar um cliente.");
	}
	if(document.fCadastrar.Caixa.value == '0') {
		envia = false;
		alert("É preciso selecionar um caixa.");
	}

	return envia;
}

function addComissao() {
	var aux_perc_index = document.fCadastrar.Percentual.selectedIndex; 
	com_perc.push(document.fCadastrar.Percentual.options[aux_perc_index].value);
	com_perc_txt.push(document.fCadastrar.Percentual.options[aux_perc_index].text);
	com_id.push(document.fCadastrar.Funcionario.options[document.fCadastrar.Funcionario.selectedIndex].value);
	com_nome.push(document.fCadastrar.Funcionario.options[document.fCadastrar.Funcionario.selectedIndex].text);
	com_valor.push(document.fCadastrar.ComValor.value);
	document.fCadastrar.ComValor.value = "0.00";
	document.fCadastrar.ComValor.disabled = 1;
	document.fCadastrar.Percentual.selectedIndex = 2;
	atualizaComissoes(); 
}

function delComissao(i) {
	com_id[i] = 0;
	atualizaComissoes(); 
}

function atualizaComissoes() {
	objDivComissoes = document.getElementById("divComissoes");
	strHTML = "<table><tr><td class='formulario'></td><td class='formulario' width='200'><b>Profissional</b></td><td class='formulario' width='75' align='center'><b>%</b></td><td class='formulario' width='100' align='center'><b>Valor</b></td></tr>";
	for(var i=0;i<com_perc.length;i++) 
		if(com_id[i] != 0) {
			if(parseFloat(com_perc[i])==0)
				var com_valor1 = parseFloat(com_valor[i]);
			else
				var com_valor1 = parseFloat(total_final)*parseFloat(com_perc[i]);
			strHTML += "<tr><td class='formulario'>[ <a href='javascript:delComissao("+i+");'>-</a> ]</td><td class='formulario'>" + com_nome[i] + "</td><td class='formulario' align='center'>" + com_perc_txt[i] + "</td><td class='formulario' align='center'>R$ " + com_valor1.toFixed(2).toString().replace('.',',') + "</tr>";
		}
	objDivComissoes.innerHTML = strHTML + "</table>";
}

function verificaManual(obj) {
	var index = obj.selectedIndex;
	if(obj.options[obj.selectedIndex].value == 0)
		document.fCadastrar.ComValor.disabled = 0;
	else {
		document.fCadastrar.ComValor.disabled = 1;	
		document.fCadastrar.ComValor.value = "0.00";	
	}	
}
</script>

<script type="text/javascript" src="javascript_martha.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body>

<h3 class="titulo_secao">Caixa - Registrar Receita</h3>
<form name="fCadastrar" action="_cadastrar_receita.php" method="post" onSubmit="return montaForm()">
<?php if($orcamento) { ?>
    <input type="hidden" name="IdCliente" value="<?=$IdCliente?>">
    <input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>"> 
	<input type="hidden" name="FormaPgto" value="<?=$FormaPgto?>">
	<input type="hidden" name="ParcValor" value="<?=$ParcValor?>">
	<input type="hidden" name="ParcVenc" value="<?=$ParcVenc?>">
    <input type="hidden" name="ServicosRefs" value="<?=$ServicosRefs?>"> 
	<input type="hidden" name="ServicosNomes" value="<?=$ServicosNomes?>">
	<input type="hidden" name="ServicosValores" value="<?=$ServicosValores?>">
    <input type="hidden" name="Subtotal" value="<?=$Subtotal?>"> 
    <input type="hidden" name="Parcelamento" value="<?=$Parcelamento?>"> 
    <input type="hidden" name="Desconto" value="<?=$Desconto?>"> 
    <input type="hidden" name="Total" value="<?=$Total?>"> 
    <input type="hidden" name="Obs" value="<?=$Obs?>"> 
    <input type="hidden" name="ref" value="orcamento"> 
<?php 
		$FormaPgto_aux = explode('||',$FormaPgto);
		$ParcValor_aux = explode('||',$ParcValor);		
	} else { ?>
    <input type="hidden" name="IdCliente" value="0">
    <input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>"> 
    <input type="hidden" name="ServicosRefs" value=""> 
    <input type="hidden" name="ServicosNomes" value=""> 
    <input type="hidden" name="ServicosValores" value=""> 
    <input type="hidden" name="Subtotal" value=""> 
    <input type="hidden" name="Total" value=""> 
<?php } ?>
    <input type="hidden" name="com_id" value=""> 
    <input type="hidden" name="com_perc" value=""> 	
    <input type="hidden" name="com_valor" value=""> 	

<table class="cadastrar">
  	<tr>
    	<td class="formulario">Caixa:</td>
        <td class="formulario">
			<select name="Caixa">
				<option value="0">-</option>
				<option value="Estética">Estética</option>
				<option value="Megahair">Megahair</option>
			</select>
		</td>
    </tr>
  	<tr>
    	<td class="formulario">Cliente:</td>
        <td class="formulario"><?php 
			if($orcamento) {
			 	$cliente = getCliente($orcamento["IdCliente"]);
				$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"];
				echo $cliente;
			} else {?><div id="divCliente"><a href="javascript:popCliente();">Clique aqui para selecionar o cliente</a></div><?php } ?></td>
    </tr>
<tr>
	<td class="formulario">Data:</b><br></td>
	<td class="formulario"><input type="text" name="DataTransacao" value="<?=date('d/m/Y')?>" size="10"></td>
</tr>
<tr>
	<td class="formulario">Número da Comanda:</b><br></td>
	<td class="formulario"><input type="text" name="NumComanda"></td>
</tr>
</tr>
	<td class="formulario">Cor:</td>
	<td><input type="text" name="CabeloCor" size="20" value="<?php if($orcamento) echo $CabeloCor?>">
</tr>
</tr>
<tr>
	<td class="formulario">Tipo do cabelo:</td>
	<td>
    	<select name="CabeloTipo">
        	<option value="0">-</option>
        	<option value="Liso" <?php if($orcamento && $CabeloTipo == "Liso") echo "selected"?>>Liso</option>
        	<option value="Ondulado" <?php if($orcamento && $CabeloTipo == "Ondulado") echo "selected"?>>Ondulado</option>
        	<option value="Crespo" <?php if($orcamento && $CabeloTipo == "Crespo") echo "selected"?>>Crespo</option>
        	<option value="Jeitoso" <?php if($orcamento && $CabeloTipo == "Jeitoso") echo "selected"?>>Jeitoso</option>
        	<option value="Crespo mola" <?php if($orcamento && $CabeloTipo == "Crespo mola") echo "selected"?>>Crespo mola</option>
        </select>
    </td>
</tr>
<tr>
	<td class="formulario">Tipo:</td>
	<td>
    	<select name="Tipo">
        	<option value="0">-</option>
        	<option value="Micro" <?php if($orcamento && $Tipo == "Micro") echo "selected"?>>Micro</option>
        	<option value="Normal" <?php if($orcamento && $Tipo == "Normal") echo "selected"?>>Normal</option>
        </select>
    </td>
</tr>
<tr>
	<td class="formulario">Comprimento:</td>
	<td class="formulario">
    	<select name="CabeloComprimento"><?php
				for($i=1;$i<=60;$i++) {
				?>
			<option value="<?=$i?>" <?php if($orcamento && $CabeloComprimento == $i) echo "selected"?>><?=$i?>cm</option><?php		
				}
			?>
        </select>
    </td>
</tr>
<tr>
	<td class="formulario">Peso:</td>
	<td><input type="text" name="CabeloPeso" size="20" value="<?php if($orcamento) echo $CabeloPeso?>">
</tr>
<tr>
	<td class="formulario">Número de mechas:</td>
	<td><select name="NumMechas" onBlur="javascript:atualizaTotalMechas();"><?php
				for($i=1;$i<=400;$i++) {
				?>
			<option value="<?=$i?>" <?php if($orcamento && $NumMechas == $i) echo "selected"?>><?=$i?></option><?php		
				}
			?>
        </select></td>
</tr>
<tr>
	<td class="formulario">Preço unitário da mecha:</td>
	<td><input type="text" name="PrecoMecha" size="20" value="<?php if($orcamento) echo $PrecoMecha; else echo "0.00";?>" onKeyUp="javascript:validaMonetario(this);" onBlur="javascript:atualizaTotalMechas();">
</tr>
<tr>
	<td class="formulario">Total em mechas</td>
	<td class="formulario"><div id="divTotalMechas">R$ <?php if($orcamento) echo number_format($TotalMechas,2,',','.'); else echo "0.00";?></div></td>
</tr>    		
<tr>
	<td class="formulario" colspan="2"><br><b>Descrição do serviço</b><br></td>
</tr>
<tr>
	<td colspan="2" class="formulario">

<table>
	<tr>
		<td class="formulario" width="80" valign="top"><b>Referência</b></td>    
		<td class="formulario" width="300" valign="top"><b>Serviço</b></td>    
		<td class="formulario" width="80" valign="top"><b>Valor</b></td>    
    </tr>
<?php
if($orcamento) {
	$ServicosNomes_aux = explode('||',$ServicosNomes);
	$ServicosValores_aux = explode('||',$ServicosValores);
	for($i=0;$i<sizeof($ServicosValores_aux);$i++) {?>
	<tr>
		<td class="formulario" width="80" valign="top">--</td>    
		<td class="formulario" width="300" valign="top"><?=$ServicosNomes_aux[$i]?></td>    
		<td class="formulario" width="80" valign="top"><?=$ServicosValores_aux[$i]?></td>    
    </tr>
<?php 
	}		
} else {
?>
    <tr>
		<td class="formulario" height="50" valign="top"><div id="divReferencias"></div></td>    
		<td class="formulario" height="50" valign="top"><div id="divServicos"><br><center>Nenhum item listado.<br></div></td>    
		<td class="formulario" height="50" valign="top"><div id="divValores"></td>    
	</tr>
<?php } ?>
    <tr>
    	<td class="formulario" colspan="2" align="right"><b>Subtotal</b></td>
        <td class="formulario"><?php 
			if($orcamento) {?>R$ <?=number_format($Subtotal, 2, ',','.')?><?php 
			} else {?><div id="divTotal">R$ 0,00</div><?php } ?></td>
    </tr>    		
</table>
<?php if(!$orcamento) { ?><a href="javascript:popProduto();">Clique aqui para inserir um item</a></div> <?php } ?><br><br><br>
    </td>
</tr>
<tr>
	<td class="formulario">Desconto:</td>
	<td class="formulario">
<?php if($orcamento) { 
		echo 100 - $Desconto*100 . "%";
	 } else { ?>	
    	<select name="Desconto" onChange="javascript:atualizaTotal()">
        	<option value="1">-</option>
        	<option value="0.95">5%</option>
        	<option value="0.92">8%</option>
        	<option value="0.90">10%</option>
        </select><br> 
<?php } ?>	
	</td>	
</tr>	    		
<tr>
	<td class="formulario">Entrada:</td>
	<td class="formulario">
<?php if($orcamento) {
		echo $FormaPgto_aux[0] . ' - R$ ' . number_format($ParcValor_aux[0], 2, ',','.');
	} else { ?>
		<select name="forma_pgto[0]" id="FormaPgto0">
			<option value="Dinheiro">Dinheiro</option>
			<option value="Cheque">Cheque</option>
			<option value="Cartão de Débito-Visa">Cartão de Débito - Visa</option>
			<option value="Cartão de Débito-Mastercard">Cartão de Débito - Mastercard</option>
			<option value="Cartão de Débito-Banrisul">Cartão de Débito - Banrisul</option>
			<option value="Cartão de Crédito-Visa">Cartão de Crédito - Visa</option>
			<option value="Cartão de Crédito-Mastercard">Cartão de Crédito - Mastercard</option>
		</select>
	<input type="text" name="parc_valor[0]" id="ParcValor0" value="0.00" size="8" onBlur="javascript:atualizaFalta();" onKeyUp="javascript:validaMonetario(this)";>		
	<input type="hidden" name="parc_venc[0]" id="ParcVenc0" value="<?=date('d/m/Y')?>">
	Cheque: <input type="text" name="parc_cheque[0]" id="ParcCheque" size="15">
<?php } ?>
	</td>
</tr>
<tr>
	<td class="formulario">Parcelamento:</td>
    <td class="formulario">
<?php if($orcamento) {
		echo $Parcelamento . 'x';
	} else { ?>	
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
<?php } ?>				
	</td>
	<tr>
		<td class="formulario">Forma de pagamento</td>
		<td class="formulario">
<?php if($orcamento) {?> 
		<table>
		<tr><td class="formulario">Parc.</td><td class="formulario">Forma de Pagamento</td><td class="formulario">Valor</td></tr>
<?php
		for($i=1;$i<=$Parcelamento;$i++) {
?>		
			<tr><td class="formulario"><?=$i?></td><td class="formulario"><?=$FormaPgto_aux[$i]?></td><td class="formulario">R$ <?=number_format($ParcValor_aux[$i], 2, ',','.')?></td></tr>
<?php 
		}
		echo "</table><br>";

	} else { ?>		
		<div id="divParcelas">a definir</div><div id="divFalta"></div>
<?php } ?>
	</td>
	</tr>
	<tr>
		<td class="formulario"></td>
		<td class="formulario" align="right"><b>
<?php if($orcamento) 
		echo "TOTAL: R$ " . $Total; 
	else {?>
		<div id="divTotalFinal">TOTAL: R$ 0,00</div>
<?php } ?>		
		</b>
		</td>
	</tr>
	<tr>
		<td class="formulario">Profissionais</td>
		<td class="formulario">
		<select name="Funcionario">
			<option value="0">-
<?php 
	$regs = getFuncionarios();
	foreach($regs as $reg) {
		extract($reg);
?>		<option value="<?=$Id?>"><?=$Nome . ' ' . $Sobrenome?><?php		
	}
?>			
		</select>
		<select name="Percentual" onChange="verificaManual(this);">
			<option value="0">Manual</option>
			<option value="0.30">30%</option>
			<option value="0.50">50%</option>
			<option value="0.60">60%</option>
			<option value="0.65" selected>65%</option>
		</select>
		<input type="text" name="ComValor" size="8" value="0.00" onKeyUp="validaMonetario(this);" disabled="true">
		<input type="button" onClick="javascript:addComissao();" value="Adicionar Loc. Espaço">
		<div id="divComissoes"></div>
		</td>
	</tr>
	<tr>
		<td class="formulario">Observações:</td>
		<td class="formulario"><?php if($orcamento) { echo $Obs; } 
			else {	?><textarea name="Obs" cols="25" rows="3"></textarea><?php } ?></td>
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