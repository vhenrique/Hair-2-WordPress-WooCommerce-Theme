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
			Descrição:<br>
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

EU, <?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?>, CPF: <?=$CPF?>, ENCOMENDO MECHAS PARA APLICAÇÃO DO MEGA HAIR, <span id="spanDescricao">XXX MECHAS DE XX CM</span>.<br><br>

O VALOR TOTAL DO SERVIÇO, CONFORME O ORÇAMENTO FEITO NESTA DATA, É DE R$ <span id="spanValor">XXX,XX</span> SENDO QUE SERÁ DADA COMO SINAL A QUANTIA DE R$ <span id="spanEntrada">XXX,XX</span>. O RESTANTE DO VALOR, SERÁ ACERTADO NO DIA DA COLOCAÇÃO.<br><br>

A CONSUMIDORA FICA CIENTE DE QUE, O VALOR DADO DE SINAL NÃO SERÁ DEVOLVIDO A NO CASO DE DESISTÊNCIA DA PRESTAÇÃO DO SERVIÇO, POIS TERÁ SIDO USADO PARA O PREPARO DO CABELO POR ELA ESCOLHIDO, COMO TINTURA, PREPARAÇÃO DE TUFOS, ENTRE OUTROS PROCEDIMENTOS.<br><br>

QUANDO DA REALIZAÇÃO DO SERVIÇO, 90% DO VALOR SERÁ RETIDO PELA CLÍNICA PARA COBRIR OS CUSTOS COM A PREPARAÇÃO, HIDRATAÇÃO E ESTERELIZAÇÃO DAS MECHAS, BEM COMO RESSARCIMENTO PELO HORÁRIO UTILIZADO PARA A REALIZAÇÃO DO SERVIÇO.<br><br>


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