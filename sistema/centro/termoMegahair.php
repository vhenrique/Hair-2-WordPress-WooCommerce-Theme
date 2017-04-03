<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	$id = isset($_GET["id"]) ? $_GET["id"] : die('Nenhum id fornecido.');
	$cliente = getCliente($id);
	extract($cliente);
?>
<html>
<head>
<title>MarthaHair - Contrato</title>
</head>
<style type="text/css">
body,td {
	font-family:Arial, Helvetica, sans-serif;
	font-size:9pt;
	color:#000000
	}
</style>
<script language="javascript">
var n_parcelas;
function escreveConteudo(f) {
	f.Conteudo.value = document.body.innerHTML;
	return true;
}

function escondeDiv(obj_name) {
	document.getElementById(obj_name).style.visibility = "hidden";
} 

function editarContrato() {
	var fields = new Array();
	fields[0] = 'Obs';
	fields[1] = 'Valor';	
	fields[2] = 'Descricao';	
	for(var i=0;i<fields.length;i++)
		document.getElementById('span' + fields[i]).innerHTML = document.getElementById('txt' + fields[i]).value;
	escreveParcelas();
}

function setaVencimentos(n) {
	n_parcelas = n;
	var strHTML = "<table><tr><td class='formulario'><b>Forma</b></td><td class='formulario'><b>Valor</b><td class='formulario'><b>Vencimento</b></td><td class='formulario'><b>Cheque</b></td></tr>";
	for(i=1;i<=n;i++) {
		strHTML += "<tr><td><select name='forma_pgto[" + i + "]' id='FormaPgto" + i + "'><option value='Dinheiro'>Dinheiro</option><option value='Cheque'>Cheque</option><option value='Cartão de Débito-Visa'>Cartão de Débito - Visa</option><option value='Cartão de Débito-Mastercard'>Cartão de Débito - Mastercard</option><option value='Cartão de Débito-Banrisul'>Cartão de Débito - Banrisul</option><option value='Cartão de Crédito-Visa'>Cartão de Crédito - Visa</option><option value='Cartão de Crédito-Mastercard'>Cartão de Crédito - Mastercard</option></select></td>";
		strHTML += "<td><input type='text' name='parc_valor[" + i + "]' id='ParcValor" + i + "' value='0.00' size='8' onKeyUp=javascript:validaMonetario(this);></td>";
		strHTML += "<td><input type='text' name='parc_venc[" + i + "]' id='ParcVenc" + i + "' value='' size='8'></td>";
		strHTML += "<td><input type='text' name='parc_cheque[" + i + "]' id='ParcCheque" + i + "' value='' size='15'></td>";
	}
	objDivParcelas = document.getElementById("spanParcelas");
	objDivParcelas.innerHTML = strHTML + "</table>";		
}

function escreveParcelas() {
	var strHTML = "<table><tr><td class='formulario'><b>Forma</b></td><td class='formulario'><b>Valor</b><td class='formulario'><b>Vencimento</b></td><td class='formulario'><b>Cheque</b></td></tr>";
	for(i=1;i<=n_parcelas;i++) {
		strHTML += "<tr><td>"+document.getElementById('FormaPgto' + i).value.toString().replace('.',',')+"</td>";
		strHTML += "<td>"+document.getElementById('ParcValor' + i).value.toString().replace('.',',')+"</td>";
		strHTML += "<td>"+document.getElementById('ParcVenc' + i).value+"</td>";
		strHTML += "<td>"+document.getElementById('ParcCheque' + i).value+"</td>";
	}
	objDivParcelas = document.getElementById("spanParcelas2");
	objDivParcelas.innerHTML = strHTML + "</table>";		
}

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

</script>
<body>
<div id="divEdicao">
<form name="fContrato">
<table>
	<tr>
		<td>
			Descrição:<br>
			<input type="text" id="txtDescricao" name="descricao" value="DESCRIÇÃO DO SERVIÇO" size="20"><br>
		</td>
		<td>
			Valor:<br>
			<input type="text" id="txtValor" name="valor" value="XX,XX" size="10"><br>
		</td>
		<td>
			Observações:<br>
			<input type="text" id="txtObs" name="valor" value="Obs.: " size="20"><br>
		</td>
	</tr>
	<tr>
		<td colspan="3">Num. de Parcelas: 		
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
		</form>
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
			<input type="button" value="Editar" onClick="javascript:editarContrato()">
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
		<form name="Gravar" method="post" action="_salvarConteudo.php" onSubmit="return escreveConteudo(this);">
			<input type="submit" value="Salvar">
			<input type="hidden" name="Tipo" value="Contrato de Prestação de Serviços e Outras Avenças">
			<input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>">
			<input type="hidden" name="IdCliente" value="<?=$id?>">
			<input type="hidden" name="Conteudo" value="">	
		</form>	
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<span id="spanParcelas"></span>
		</td>
	</tr>
</table>
</div>
<inicio_contrato>
<center>
<b><u>CONTRATO DE PRESTAÇÃO DE SERVIÇOS E OUTRAS AVENÇAS<br><br>
Contrato nº</u></b>
</center>
<br><br><br>
<div align="justify">
Pelo presente instrumento particular que fazem, de uma parte a empresa CABELOS POR KILO DO BRASIL LTDA,  com sede na Avenida Paulista, 1159 Conjunto 903 - Bela Vista, São Paulo - SP, doravante denominada CONTRATADA e de outro lado a CONTRATANTE, abaixo qualificada.<br>
<br>
 
NOME: <?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?>, CPF: <?=$CPF?>, RG: <?=$RG?>, FILHO DE <?=mb_strtoupper($NomeMae)?> E <?=mb_strtoupper($NomePai)?>, DATA NASCIMENTO: <?=date('d/m/Y',strtotime($DataNascimento))?> ENDEREÇO: <?=mb_strtoupper($Endereco)?>, TEL: <?=$Telefone?> / <?=$Celular?>, que resolvem pactuar o contrato de prestação de Serviços, conforme as claúsulas e condições abaixo descriminadas:<br><br>

Cláusula primeira: A CONTRATADA prestará serviços à CONTRATANTE para colocação de material denominado MEGA HAIR, consistente em implante artificial de cabelos naturais, mediante a técnica adotada pela CONTRATANTE.<br><br> 

Cláusula segunda: A CONTRATANTE declara neste ato estar ciente das técnicas adotadas para a colocação do implante, sendo vedado à mesma qualquer tipo de reivindicação contrária a tais métodos, especialmente quanto ao material usado pela CONTRATADA (keratina, cabelos naturais, métodos alternativos, etc).<br><br>

Parágrafo primeiro – A CONTRATANTE DECLARA ESTAR CIENTE DE QUE, APESAR DOS CABELOS IMPLANTADOS SEREM NATURAIS, ELES REAGEM SOMENTE DE 30% A 70% AOS ESTÍMULOS QUÍMICOS (TINTURAS, DESCOLORAÇÕES, HIDRATAÇÃO, ETC), POR NÃO SE TRATAREM DE CABELOS “VIVOS”.<br><br>

Parágrafo segundo: A CONTRATANDE DECLARA ESTAR CIENTE DE QUE A DURABILIDADE DA KERATINA DEPENDE DIRETAMENTE DA OLEOSIDADE DOS CABELOS NATURAIS DA CONTRATANTE, BEM COMO DE SEU NÍVEL DE ESTRESSE E DO CLIMA.<br><br>

Parágrafo terceiro – A CONTRATANTE DECLARA ESTAR CIENTE DE QUE SEUS CABELOS IMPLANTADOS NÃO REAGEM DE FORMA IGUAL AOS SEUS CABELOS NATURAIS, NECESSITANDO, INCLUSIVE, DE MAIORES CUIDADOS.<br><br>

Cláusula terceira: A CONTRATADA, após a colocação do MEGA HAIR, assume toda e qualquer responsabilidade quanto ao material e mão-de-obra empregados.<br><br>
 
Cláusula quarta: A CONTRATANTE, após a realização dos trabalhos, não poderá exercer o direito de arrependimento em virtude de resultado estético, eximindo a CONTRATADA de qualquer responsabilidade quanto à avaliação visual e subjetiva, ressalvado os casos previstos na legislação específica. <br><br>
 
Cláusula quinta: A CONTRATANTE declara expressamente estar ciente que o resultado da implantação do MEGA HAIR dependerá de circunstâncias que a CONTRATADA não detém autonomia, uma vez que dependerão dos cuidados arrolados no termo de compromisso, que integra o presente. <br><br>

Cláusula sexta: A CONTRATANTE, em contra-prestação aos serviços prestados, pagará à CONTRATADA o total de R$ <span id="spanValor">XXX,XX</span> REFERENTE A <span id="spanDescricao">XXXX</span>.<br><br>

Efetuado nas seguintes condições:<br><br>
<span id="spanParcelas2"></span>
<br><br>
PARÁGRAFO PRIMEIRO: A contratante fica ciente que de em caso de desistir de permanecer com o MEGA HAIR após a colocação, o valor contratado ainda será devido na integralidade.<br><br>

PARÁGRAFO SEGUNDO: Se for do interesse da cliente devolver os cabelos à clínica, ainda será devido o valor de 90% do preço ajustado, para cobrir custas e o horário da colocação.<br><br>

Cláusula sétima: A CONTRATANTE, após a colocação do MEGA HAIR deverá exercer o seu direito de MANUTENÇÃO E RETOQUES do implante, de forma gratuita, devendo marcar consulta prévia, agendada com antecedência, observado o período máximo da garantia.<br><br>  

Parágrafo primeiro: Após ultrapassado o período de quinze dias da garantia, fica devidamente convencionado que a CONTRATANTE deverá periodicamente ajustar seu MEGA HAIR em virtude do crescimento natural dos cabelos e outros motivos naturais (oleosidade, PH, matrizes, etc), eximindo a CONTRATADA de qualquer responsabilidade indenizatória em caso de descumprimento das normas aqui avençadas.<br><br> 

§ segundo: A CONTRATADA prestará manutenção gratuita pelo período de quinze dias, devendo a CONTRATANTE arcar com os custos de manutenção, após ultrapassado tal prazo de garantia. A contratante não terá direito à reposição de mechas implantadas após a colocação. Poderá adquirir mais mechas, porém efetuando o pagamento da mesma. Fica ressalvado que o MEGA HAIR, por sua natureza, deve ser periodicamente ajustado para que se obtenha seu maior aproveitamento, não responsabilizando-se a CONTRATADA pelas conseqüências do mau uso e conservação.<br><br>

Cláusula oitava: A CONTRATADA garante à CONTRATANTE todos os custos de reajustes e retoques necessários para a boa colocação do MEGA HAIR durante o período da garantia (cláusula terceira), desde que verificado que a CONTRATANTE manteve os cuidados de higiene e conservação dos cabelos, conforme termo de compromisso.<br><br> 

Cláusula nona: A CONTRATADA reserva-se ao direito de promover toda e qualquer diligência para a garantia de esclarecimentos de eventuais litígios, tais como fotografias (antes e depois), elaboração de laudos, acompanhamento técnico, etc., sendo vedado o uso de tal material para qualquer outra atividade que não seja correspondente ao objeto do presente contrato.<br><br> 

Cláusula décima: A CONTRATANTE declara expressamente estar de acordo com todos os riscos de colocação e conservação do MEGA-HAIR, comprometendo-se a comparecer na sede da CONTRATADA sempre que lhe for requerido com o objetivo de REVISAR A COLOCAÇÃO para solucionar qualquer ajuste que se fizer necessário e VEDANDO a participação de terceiros estranhos ao presente contrato, da qual constatado tal intervenção, não poderá a CONTRATANTE exercer seu direito de garantia.<br><br> 

Cláusula décima-primeira:  A CONTRATADA não responsabiliza-se pelo uso de materiais vedados ao implante (termo de compromisso em anexo), bem como pelo manuseio por pessoas desautorizadas ou descredenciadas da empresa.<br><br>

Claúsula décima segunda: A COTRATANTE concorda em receber da CONTRATADA correspodências através de todo e qualquer meio de comunicação. ( ) SIM     ( ) NÃO<br><br>
<span id="spanObs"></span><br><br>
E assim, estando justos e contratados, as partes elegem o foro da comarca de Porto Alegre para dirimir eventuais dúvidas provenientes do presente, firmando a presente em duas vias de igual teor, na presença de duas testemunhas que a tudo assistiram, produzindo seus jurídicos e legais efeitos. 
</div>
<br><br><br>
<div align="right">
               <dd>PORTO ALEGRE, <?=date('d')?> DE <?=mb_strtoupper($mes_nome[date('m')])?> DE <?=date('Y')?>.
</div>
<br><br><br>
<center>
<table width="80%">
	<tr>
		<td width="50%" align="center">
			CONTRATADA<br><br><br>
			<hr size="1" width="80%" color="#000000">
			CABELOS POR KILO DO BRASIL LTDA</td>
		<td width="50%" align="center">
			CONTRATANTE<br><br><br>
			<hr size="1" width="80%" color="#000000">
			<?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?><br>
			CPF: <?=$CPF?>			
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br><br><br>TESTEMUNHAS</td>
	</tr>
	<tr>
		<td><br><br>1 -</td>
		<td><br><br>2 -</td>		
	</tr>	
</table>
</center>
</body>
</html>