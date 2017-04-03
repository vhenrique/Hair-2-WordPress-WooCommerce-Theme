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
	fields[0] = 'Valor1';	
	fields[1] = 'Valor2';

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
			<input type="text" id="txtValor1" name="valor1" value="" size="10"><br>
		</td>
		<td>
			Valor:<br>
			<input type="text" id="txtValor2" name="valor2" value="" size="10"><br>
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
			<input type="button" value="Editar" onClick="javascript:editarContrato()">
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
		<form method="post" action="_salvarConteudo.php" onSubmit="return escreveConteudo(this);">
			<input type="submit" value="Salvar">
			<input type="hidden" name="Tipo" value="Termo de Vistoria de Colocação de Prótese">
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
<b><u>TERMO DE VISTORIA DE COLOCAÇÃO DE PROTESE</u></b>
</center>
<br><br><br>
<div align="justify">

Pelo presente termo de vistoria, assinado após a denominada colocação, declaro que o implante de PROTESE foi colocado com exatidão e
presteza, estando em perfeito estado de uso e conservação, reservando–me ao direito de gozar dos benefícios contratuais firmados com a empresa CABELOS POR KILO DO BRASIL LTDA, adimplindo e ratificando todas suas cláusulas. O cliente tem 15 dias para fazer qualquer reparo na mesma e a empresa não se responsabiliza por danos causados devido mal uso dos clientes.O VALOR DA MANUTENÇÃO DE SUA PROTESE É R$ <span id="spanValor1">XXX,XX</span>. E a colocação foi paga no valor de <span id="spanValor2">XXX,XX</span>.</div>
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
			<?=mb_strtoupper($Nome)?> <?=mb_strtoupper($Sobrenome)?>		
        </td>
	</tr>
</table>
</center>
</body>
</html>