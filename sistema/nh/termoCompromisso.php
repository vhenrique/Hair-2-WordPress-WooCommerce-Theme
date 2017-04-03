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
function escreveConteudo(f) {
	editarContrato();
	f.Conteudo.value = document.body.innerHTML;
	return true;
}

function escondeDiv(obj_name) {
	document.getElementById(obj_name).style.visibility = "hidden";
} 

function editarContrato() {
	var fields = new Array();
	fields[0] = 'Valor';

	for(var i=0;i<fields.length;i++)
		document.getElementById('span' + fields[i]).innerHTML = document.getElementById('txt' + fields[i]).value;

}
</script>
<body>
<div id="divEdicao">
<table>
	<tr>
		<td>
			Valor:<br>
			<input type="text" id="txtValor" name="valor" value="<?=number_format($receita['Total'],2,',','.')?>" size="10"><br>
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
			<input type="button" value="Editar" onClick="javascript:editarContrato()">
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
		<form method="post" action="_salvarConteudo.php" onSubmit="return escreveConteudo(this);">
			<input type="submit" value="Salvar">
			<input type="hidden" name="Tipo" value="Termo de Compromisso">
			<input type="hidden" name="IdUsuario" value="<?=getUser("Id")?>">
			<input type="hidden" name="IdCliente" value="<?=$id?>">
			<input type="hidden" name="Conteudo" value="">	
		</form>	
		</td>
	</tr>
</table>
</div>
<inicio_contrato>
<center>
<b><u>TERMO DE COMPROMISSO</u></b>
</center>
<br><br><br>
<div align="justify">

A utiliza��o do processo de EXTENS�O COM KERATINA requer algumas observa��es e cuidados indispens�veis, que esclareceremos neste contrato:<br>
01 � N�O UTILIZAR PRODUTOS COM BASE ALCO�LICA<br>
02 � SHAMPOO: Lavar os cabelos no m�nimo 4 vezes intercaladas na semana com shampoos para cabelos oleosos e pelo menos 1 vez por semana lav�-los com shampoo de limpeza profunda. Recomendamos a linha de produtos vendida na Cl�nica, pois foi testada e aprovada.<br>
03- N�o utilizar shampoos �2 em 1�, shampoos para cabelos secos ou de tratamento.<br>
04- CONDICIONADOR ou outros cremes: somente nas pontas.<br>
05 � HIDRATA��O: Somente na cl�nica.<br>
06 � TINTURAS OU QU�MICAS: poder�o ser realizadas desde que com a aprova��o pr�via dos profissionais da cl�nica. A cl�nica s� se responsabiliza por qu�micas realizadas pelos seus profissionais.<br>
07 � SECADOR DE CABELOS ou outro tipo de aparelho que utilize calor: n�o utilizar pr�ximo a raiz, para evitar a queda das mechas.<br>
08 � PRODUTOS OLEOSOS: como reparador (silicone), cremes sem enx�g�e, termo-ativados e outros, somente nas pontas dos cabelos.<br>
09 � N�o deixar a raiz do cabelo oleosa, pois a cola poder� amolecer. Lavar os cabelos com freq��ncia e sem utilizar �gua quente.<br>
10 - CUIDADOS AO PENTEAR: Utilizar escovas de cerdas com �bolinhas� nas pontas (jacar�), para desembara�ar ap�s o banho desde a raiz e pente de dentes largos nas demais situa��es. Pentear e desembara�ar os cabelos todos os dias, da raiz as pontas. A Cl�nica n�o se responsabiliza pela m� escova��o que poder� ocasionar o embara�o das mechas, prejudicando o reajuste e ocasionando perda de fios al�m do normal.<br>
11 � BRONZEAMENTO ARTIFICIAL: Poder� ser feito, mas com ressalvas: enrolar uma toalha umedecida com �gua fria na cabe�a e n�o utilizar touca pl�stica.<br>
12 � GARANTIA DE COLOCA��O: Em caso de troca, ajustes de cor, quantidade de cabelos ou queda de fios ou mechas, a cliente poder� retornar a cl�nica no prazo m�ximo de 15 (quinze) dias, para retocar sem �nus algum.<br>
13 � VALOR DE SUA MANUTEN��O DE 45 A 120 DIAS R$ <span id="spanValor">XXX,XX</span>. Podendo ocorrer varia��es neste valor, salvo observa��o da profissional.<br>
14 � PER�ODO DE MANUTEN��O: A manuten��o deve ser realizada entre 45 E 120 dias, a cl�nica n�o se responsabiliza pelos poss�veis danos causados ap�s este per�odo. � recomend�vel marcar corte e hidrata��o para o dia da manuten��o.<br>
15 � A manuten��o dever� ser marcada com pelo menos 10 (dez) dias de anteced�ncia para garantir hor�rio dispon�vel.<br>
16 � Na manuten��o, n�o vir com os cabelos naturais ou as mechas do cabelo posti�o com �leo, condicionador ou outros cremes. Vir com os cabelos limpos.<br>
17 � Os hor�rios devem ser desmarcados com no m�nimo de 12 horas de anteced�ncia ou a Cl�nica se reserva o direito de cobrar uma taxa equivalente a 50% do valor da manuten��o.<br>
18- Na realiza��o da manuten��o ocorre a perda de 2 a 3 cm do cabelo posti�o.<br>
19 �No per�odo de utiliza��o do cabelo e na realiza��o da manuten��o ocorre � perda de fios, ou seja, perda de volume, sendo �s vezes necess�rio juntar duas ou mais mechas, diminuindo assim a quantidade de cabelos posti�os.<br>
19.1 � � normal ocorrer � perda de at� 10 mechas por m�s.<br>
20 � Os cabelos implantados, apesar de naturais, reagem somente de 30% a 70% aos est�mulos qu�micos (tinturas, descolora��es, hidrata��es, etc)<br>
21 � A durabilidade do aplique depende diretamente da adapta��o dos cabelos naturais da contratante, bem como das qu�micas que ele possui e de sua oleosidade natural que pode ser acentuada pela alimenta��o, estresse ou outros problemas de sa�de.<br>
22 � As mudan�as clim�ticas tamb�m influenciam na durabilidade de seu aplique, com resultado melhor em �pocas do ano frias e secas e ao contr�rio, em quentes e �midas.<br>
23 � Os cabelos implantados, reagem menos e mais devagar aos est�mulos, necessitando de maiores cuidados, como hidrata��es peri�dicas. Recomendamos hidrata��es quinzenais na cl�nica.<br>
24 � Dura��o do reajuste: 4 a 7 horas.<br>
25 � EM CASO DE N�O COMPARECIMENTO NA MANUTEN��O: poder� ocasionar a perda de todos as mechas posti�as. A cl�nica n�o se responsabilizar�, se a cliente n�o comparecer no per�odo determinado.<br>
26 � DORES DE CABE�A: Em pessoas sens�veis poder� ocorrer dores no couro cabeludo durante um per�odo de adapta��o, que pode durar at� 07 dias.<br>
27 � RETIRADA DO APLIQUE: Ser� feita atrav�s de removedor, obedecendo ao prazo m�nimo de 45 dias (para n�o danificar os cabelos naturais da cliente ou machucar seu couro cabeludo, j� que a �cola� est� forte e muito pr�xima da raiz). Sendo que haver� custo igual a manuten��o acima citada.<br><br>
EU, <?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?>, CPF: <?=$CPF?>, RG: <?=$RG?>, FILHO DE <?=mb_strtoupper($NomeMae)?> E <?=mb_strtoupper($NomePai)?>, DATA NASCIMENTO: <?=date('d/m/Y',strtotime($DataNascimento))?> ENDERE�O: <?=mb_strtoupper($Endereco)?>, TEL: <?=$Telefone?> / <?=$Celular?>, DECLARO ESTAR CIENTE DO TRABALHO REALIZADO PELA CL�NICA MARTHA, E QUE A MESMA N�O ACEITAR� DEVOLU��O.<br>


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
			TAPE HAIR BRASIL LTDA.		</td>
		<td width="50%" align="center">
			CONTRATANTE<br><br><br>
			<hr size="1" width="80%" color="#000000">
			<?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?><br>
            CPF: <?=$CPF?>
		</td>
	</tr>
</table>
</center>
</body>
</html>