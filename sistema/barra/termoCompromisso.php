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

A utilização do processo de EXTENSÃO COM KERATINA requer algumas observações e cuidados indispensáveis, que esclareceremos neste contrato:<br>
01 – NÃO UTILIZAR PRODUTOS COM BASE ALCOÓLICA<br>
02 – SHAMPOO: Lavar os cabelos no mínimo 4 vezes intercaladas na semana com shampoos para cabelos oleosos e pelo menos 1 vez por semana lavá-los com shampoo de limpeza profunda. Recomendamos a linha de produtos vendida na Clínica, pois foi testada e aprovada.<br>
03- Não utilizar shampoos “2 em 1”, shampoos para cabelos secos ou de tratamento.<br>
04- CONDICIONADOR ou outros cremes: somente nas pontas.<br>
05 – HIDRATAÇÃO: Somente na clínica.<br>
06 – TINTURAS OU QUÍMICAS: poderão ser realizadas desde que com a aprovação prévia dos profissionais da clínica. A clínica só se responsabiliza por químicas realizadas pelos seus profissionais.<br>
07 – SECADOR DE CABELOS ou outro tipo de aparelho que utilize calor: não utilizar próximo a raiz, para evitar a queda das mechas.<br>
08 – PRODUTOS OLEOSOS: como reparador (silicone), cremes sem enxágüe, termo-ativados e outros, somente nas pontas dos cabelos.<br>
09 – Não deixar a raiz do cabelo oleosa, pois a cola poderá amolecer. Lavar os cabelos com freqüência e sem utilizar água quente.<br>
10 - CUIDADOS AO PENTEAR: Utilizar escovas de cerdas com “bolinhas” nas pontas (jacaré), para desembaraçar após o banho desde a raiz e pente de dentes largos nas demais situações. Pentear e desembaraçar os cabelos todos os dias, da raiz as pontas. A Clínica não se responsabiliza pela má escovação que poderá ocasionar o embaraço das mechas, prejudicando o reajuste e ocasionando perda de fios além do normal.<br>
11 – BRONZEAMENTO ARTIFICIAL: Poderá ser feito, mas com ressalvas: enrolar uma toalha umedecida com água fria na cabeça e não utilizar touca plástica.<br>
12 – GARANTIA DE COLOCAÇÃO: Em caso de troca, ajustes de cor, quantidade de cabelos ou queda de fios ou mechas, a cliente poderá retornar a clínica no prazo máximo de 15 (quinze) dias, para retocar sem ônus algum.<br>
13 – VALOR DE SUA MANUTENÇÃO DE 45 A 120 DIAS R$ <span id="spanValor">XXX,XX</span>. Podendo ocorrer variações neste valor, salvo observação da profissional.<br>
14 – PERÍODO DE MANUTENÇÃO: A manutenção deve ser realizada entre 45 E 120 dias, a clínica não se responsabiliza pelos possíveis danos causados após este período. É recomendável marcar corte e hidratação para o dia da manutenção.<br>
15 – A manutenção deverá ser marcada com pelo menos 10 (dez) dias de antecedência para garantir horário disponível.<br>
16 – Na manutenção, não vir com os cabelos naturais ou as mechas do cabelo postiço com óleo, condicionador ou outros cremes. Vir com os cabelos limpos.<br>
17 – Os horários devem ser desmarcados com no mínimo de 12 horas de antecedência ou a Clínica se reserva o direito de cobrar uma taxa equivalente a 50% do valor da manutenção.<br>
18- Na realização da manutenção ocorre a perda de 2 a 3 cm do cabelo postiço.<br>
19 –No período de utilização do cabelo e na realização da manutenção ocorre à perda de fios, ou seja, perda de volume, sendo às vezes necessário juntar duas ou mais mechas, diminuindo assim a quantidade de cabelos postiços.<br>
19.1 – É normal ocorrer à perda de até 10 mechas por mês.<br>
20 – Os cabelos implantados, apesar de naturais, reagem somente de 30% a 70% aos estímulos químicos (tinturas, descolorações, hidratações, etc)<br>
21 – A durabilidade do aplique depende diretamente da adaptação dos cabelos naturais da contratante, bem como das químicas que ele possui e de sua oleosidade natural que pode ser acentuada pela alimentação, estresse ou outros problemas de saúde.<br>
22 – As mudanças climáticas também influenciam na durabilidade de seu aplique, com resultado melhor em épocas do ano frias e secas e ao contrário, em quentes e úmidas.<br>
23 – Os cabelos implantados, reagem menos e mais devagar aos estímulos, necessitando de maiores cuidados, como hidratações periódicas. Recomendamos hidratações quinzenais na clínica.<br>
24 – Duração do reajuste: 4 a 7 horas.<br>
25 – EM CASO DE NÃO COMPARECIMENTO NA MANUTENÇÃO: poderá ocasionar a perda de todos as mechas postiças. A clínica não se responsabilizará, se a cliente não comparecer no período determinado.<br>
26 – DORES DE CABEÇA: Em pessoas sensíveis poderá ocorrer dores no couro cabeludo durante um período de adaptação, que pode durar até 07 dias.<br>
27 – RETIRADA DO APLIQUE: Será feita através de removedor, obedecendo ao prazo mínimo de 45 dias (para não danificar os cabelos naturais da cliente ou machucar seu couro cabeludo, já que a “cola” está forte e muito próxima da raiz). Sendo que haverá custo igual a manutenção acima citada.<br><br>
EU, <?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?>, CPF: <?=$CPF?>, RG: <?=$RG?>, FILHO DE <?=mb_strtoupper($NomeMae)?> E <?=mb_strtoupper($NomePai)?>, DATA NASCIMENTO: <?=date('d/m/Y',strtotime($DataNascimento))?> ENDEREÇO: <?=mb_strtoupper($Endereco)?>, TEL: <?=$Telefone?> / <?=$Celular?>, DECLARO ESTAR CIENTE DO TRABALHO REALIZADO PELA CLÍNICA MARTHA, E QUE A MESMA NÃO ACEITARÁ DEVOLUÇÃO.<br>


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