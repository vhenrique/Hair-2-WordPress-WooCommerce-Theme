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
	fields[0] = 'Descricao';	
	fields[1] = 'Entrada';
	fields[2] = 'Valor';

	for(var i=0;i<fields.length;i++)
		document.getElementById('span' + fields[i]).innerHTML = document.getElementById('txt' + fields[i]).value;

}
</script>
<body>
<div id="divEdicao">
<table>
	<tr>
		<td>
			Descri��o:<br>
			<input type="text" id="txtDescricao" name="valor" value="XXX MECHAS DE XX CM" size="40"><br>
		</td>
		<td>
			Entrada:<br>
			<input type="text" id="txtEntrada" name="valor" value="" size="10"><br>
		</td>
		<td>
			Valor:<br>
			<input type="text" id="txtValor" name="valor" value="" size="10"><br>
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
			<input type="button" value="Editar" onClick="javascript:editarContrato()">
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
		<form method="post" action="_salvarConteudo.php" onSubmit="return escreveConteudo(this);">
			<input type="submit" value="Salvar">
			<input type="hidden" name="Tipo" value="Termo de Encomenda">
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
<b><u>TERMO DE ENCOMENDA</u></b>
</center>
<br><br><br>
<div align="justify">

EU, <?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?>, CPF: <?=$CPF?>, ENCOMENDO MECHAS PARA APLICA��O DO MEGA HAIR, <span id="spanDescricao">XXX MECHAS DE XX CM</span>.<br><br>

O VALOR TOTAL DO SERVI�O, CONFORME O OR�AMENTO FEITO NESTA DATA, � DE R$ <span id="spanValor">XXX,XX</span> SENDO QUE SER� DADA COMO SINAL A QUANTIA DE R$ <span id="spanEntrada">XXX,XX</span>. O RESTANTE DO VALOR, SER� ACERTADO NO DIA DA COLOCA��O.<br><br>

A CONSUMIDORA FICA CIENTE DE QUE, O VALOR DADO DE SINAL N�O SER� DEVOLVIDO A NO CASO DE DESIST�NCIA DA PRESTA��O DO SERVI�O, POIS TER� SIDO USADO PARA O PREPARO DO CABELO POR ELA ESCOLHIDO, COMO TINTURA, PREPARA��O DE TUFOS, ENTRE OUTROS PROCEDIMENTOS.<br><br>

QUANDO DA REALIZA��O DO SERVI�O, 90% DO VALOR SER� RETIDO PELA CL�NICA PARA COBRIR OS CUSTOS COM A PREPARA��O, HIDRATA��O E ESTERELIZA��O DAS MECHAS, BEM COMO RESSARCIMENTO PELO HOR�RIO UTILIZADO PARA A REALIZA��O DO SERVI�O.<br><br>


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
			TAPE HAIR BRASIL LTDA</td>
		<td width="50%" align="center">
			CONTRATANTE<br><br><br>
			<hr size="1" width="80%" color="#000000">
			<?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?>			
		</td>
	</tr>
</table>
</center>
</body>
</html>