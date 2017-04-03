<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sess�o n�o iniciada");
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
		strHTML += "<tr><td><select name='forma_pgto[" + i + "]' id='FormaPgto" + i + "'><option value='Dinheiro'>Dinheiro</option><option value='Cheque'>Cheque</option><option value='Cart�o de D�bito-Visa'>Cart�o de D�bito - Visa</option><option value='Cart�o de D�bito-Mastercard'>Cart�o de D�bito - Mastercard</option><option value='Cart�o de D�bito-Banrisul'>Cart�o de D�bito - Banrisul</option><option value='Cart�o de Cr�dito-Visa'>Cart�o de Cr�dito - Visa</option><option value='Cart�o de Cr�dito-Mastercard'>Cart�o de Cr�dito - Mastercard</option></select></td>";
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
			Descri��o:<br>
			<input type="text" id="txtDescricao" name="descricao" value="DESCRI��O DO SERVI�O" size="20"><br>
		</td>
		<td>
			Valor:<br>
			<input type="text" id="txtValor" name="valor" value="XX,XX" size="10"><br>
		</td>
		<td>
			Observa��es:<br>
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
			<input type="hidden" name="Tipo" value="Contrato de Presta��o de Servi�os e Outras Aven�as">
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
<b><u>CONTRATO DE PRESTA��O DE SERVI�OS E OUTRAS AVEN�AS<br><br>
Contrato n�</u></b>
</center>
<br><br><br>
<div align="justify">
Pelo presente instrumento particular que fazem, de uma parte a empresa CABELOS POR KILO DO BRASIL LTDA,  com sede na Avenida Paulista, 1159 Conjunto 903 - Bela Vista, S�o Paulo - SP, doravante denominada CONTRATADA e de outro lado a CONTRATANTE, abaixo qualificada.<br>
<br>
 
NOME: <?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?>, CPF: <?=$CPF?>, RG: <?=$RG?>, FILHO DE <?=mb_strtoupper($NomeMae)?> E <?=mb_strtoupper($NomePai)?>, DATA NASCIMENTO: <?=date('d/m/Y',strtotime($DataNascimento))?> ENDERE�O: <?=mb_strtoupper($Endereco)?>, TEL: <?=$Telefone?> / <?=$Celular?>, que resolvem pactuar o contrato de presta��o de Servi�os, conforme as cla�sulas e condi��es abaixo descriminadas:<br><br>

Cl�usula primeira: A CONTRATADA prestar� servi�os � CONTRATANTE para coloca��o de material denominado MEGA HAIR, consistente em implante artificial de cabelos naturais, mediante a t�cnica adotada pela CONTRATANTE.<br><br> 

Cl�usula segunda: A CONTRATANTE declara neste ato estar ciente das t�cnicas adotadas para a coloca��o do implante, sendo vedado � mesma qualquer tipo de reivindica��o contr�ria a tais m�todos, especialmente quanto ao material usado pela CONTRATADA (keratina, cabelos naturais, m�todos alternativos, etc).<br><br>

Par�grafo primeiro � A CONTRATANTE DECLARA ESTAR CIENTE DE QUE, APESAR DOS CABELOS IMPLANTADOS SEREM NATURAIS, ELES REAGEM SOMENTE DE 30% A 70% AOS EST�MULOS QU�MICOS (TINTURAS, DESCOLORA��ES, HIDRATA��O, ETC), POR N�O SE TRATAREM DE CABELOS �VIVOS�.<br><br>

Par�grafo segundo: A CONTRATANDE DECLARA ESTAR CIENTE DE QUE A DURABILIDADE DA KERATINA DEPENDE DIRETAMENTE DA OLEOSIDADE DOS CABELOS NATURAIS DA CONTRATANTE, BEM COMO DE SEU N�VEL DE ESTRESSE E DO CLIMA.<br><br>

Par�grafo terceiro � A CONTRATANTE DECLARA ESTAR CIENTE DE QUE SEUS CABELOS IMPLANTADOS N�O REAGEM DE FORMA IGUAL AOS SEUS CABELOS NATURAIS, NECESSITANDO, INCLUSIVE, DE MAIORES CUIDADOS.<br><br>

Cl�usula terceira: A CONTRATADA, ap�s a coloca��o do MEGA HAIR, assume toda e qualquer responsabilidade quanto ao material e m�o-de-obra empregados.<br><br>
 
Cl�usula quarta: A CONTRATANTE, ap�s a realiza��o dos trabalhos, n�o poder� exercer o direito de arrependimento em virtude de resultado est�tico, eximindo a CONTRATADA de qualquer responsabilidade quanto � avalia��o visual e subjetiva, ressalvado os casos previstos na legisla��o espec�fica. <br><br>
 
Cl�usula quinta: A CONTRATANTE declara expressamente estar ciente que o resultado da implanta��o do MEGA HAIR depender� de circunst�ncias que a CONTRATADA n�o det�m autonomia, uma vez que depender�o dos cuidados arrolados no termo de compromisso, que integra o presente. <br><br>

Cl�usula sexta: A CONTRATANTE, em contra-presta��o aos servi�os prestados, pagar� � CONTRATADA o total de R$ <span id="spanValor">XXX,XX</span> REFERENTE A <span id="spanDescricao">XXXX</span>.<br><br>

Efetuado nas seguintes condi��es:<br><br>
<span id="spanParcelas2"></span>
<br><br>
PAR�GRAFO PRIMEIRO: A contratante fica ciente que de em caso de desistir de permanecer com o MEGA HAIR ap�s a coloca��o, o valor contratado ainda ser� devido na integralidade.<br><br>

PAR�GRAFO SEGUNDO: Se for do interesse da cliente devolver os cabelos � cl�nica, ainda ser� devido o valor de 90% do pre�o ajustado, para cobrir custas e o hor�rio da coloca��o.<br><br>

Cl�usula s�tima: A CONTRATANTE, ap�s a coloca��o do MEGA HAIR dever� exercer o seu direito de MANUTEN��O E RETOQUES do implante, de forma gratuita, devendo marcar consulta pr�via, agendada com anteced�ncia, observado o per�odo m�ximo da garantia.<br><br>  

Par�grafo primeiro: Ap�s ultrapassado o per�odo de quinze dias da garantia, fica devidamente convencionado que a CONTRATANTE dever� periodicamente ajustar seu MEGA HAIR em virtude do crescimento natural dos cabelos e outros motivos naturais (oleosidade, PH, matrizes, etc), eximindo a CONTRATADA de qualquer responsabilidade indenizat�ria em caso de descumprimento das normas aqui aven�adas.<br><br> 

� segundo: A CONTRATADA prestar� manuten��o gratuita pelo per�odo de quinze dias, devendo a CONTRATANTE arcar com os custos de manuten��o, ap�s ultrapassado tal prazo de garantia. A contratante n�o ter� direito � reposi��o de mechas implantadas ap�s a coloca��o. Poder� adquirir mais mechas, por�m efetuando o pagamento da mesma. Fica ressalvado que o MEGA HAIR, por sua natureza, deve ser periodicamente ajustado para que se obtenha seu maior aproveitamento, n�o responsabilizando-se a CONTRATADA pelas conseq��ncias do mau uso e conserva��o.<br><br>

Cl�usula oitava: A CONTRATADA garante � CONTRATANTE todos os custos de reajustes e retoques necess�rios para a boa coloca��o do MEGA HAIR durante o per�odo da garantia (cl�usula terceira), desde que verificado que a CONTRATANTE manteve os cuidados de higiene e conserva��o dos cabelos, conforme termo de compromisso.<br><br> 

Cl�usula nona: A CONTRATADA reserva-se ao direito de promover toda e qualquer dilig�ncia para a garantia de esclarecimentos de eventuais lit�gios, tais como fotografias (antes e depois), elabora��o de laudos, acompanhamento t�cnico, etc., sendo vedado o uso de tal material para qualquer outra atividade que n�o seja correspondente ao objeto do presente contrato.<br><br> 

Cl�usula d�cima: A CONTRATANTE declara expressamente estar de acordo com todos os riscos de coloca��o e conserva��o do MEGA-HAIR, comprometendo-se a comparecer na sede da CONTRATADA sempre que lhe for requerido com o objetivo de REVISAR A COLOCA��O para solucionar qualquer ajuste que se fizer necess�rio e VEDANDO a participa��o de terceiros estranhos ao presente contrato, da qual constatado tal interven��o, n�o poder� a CONTRATANTE exercer seu direito de garantia.<br><br> 

Cl�usula d�cima-primeira:  A CONTRATADA n�o responsabiliza-se pelo uso de materiais vedados ao implante (termo de compromisso em anexo), bem como pelo manuseio por pessoas desautorizadas ou descredenciadas da empresa.<br><br>

Cla�sula d�cima segunda: A COTRATANTE concorda em receber da CONTRATADA correspod�ncias atrav�s de todo e qualquer meio de comunica��o. ( ) SIM     ( ) N�O<br><br>
<span id="spanObs"></span><br><br>
E assim, estando justos e contratados, as partes elegem o foro da comarca de Porto Alegre para dirimir eventuais d�vidas provenientes do presente, firmando a presente em duas vias de igual teor, na presen�a de duas testemunhas que a tudo assistiram, produzindo seus jur�dicos e legais efeitos. 
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