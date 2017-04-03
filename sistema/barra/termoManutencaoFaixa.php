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
	fields[0] = 'NumFaixas';
	fields[1] = 'Valor';

	for(var i=0;i<fields.length;i++)
		document.getElementById('span' + fields[i]).innerHTML = document.getElementById('txt' + fields[i]).value;

}
</script>
<body>
<div id="divEdicao">
<table>
	<tr>
		<td>
			Núm. faixas:<br>
			<input type="text" id="txtNumFaixas" name="num_faixas" value="X" size="10">
		</td>
		<td>
			Valor:<br>
			<input type="text" id="txtValor" name="valor" value="XX,XX" size="10"><br>
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
			<input type="button" value="Editar" onClick="javascript:editarContrato()">
		</td>
		<td rowspan="2" style="vertical-align:top"><br>
		<form method="post" action="_salvarConteudo.php" onSubmit="return escreveConteudo(this);">
			<input type="submit" value="Salvar">
			<input type="hidden" name="Tipo" value="Termo de Vistoria de Manutenção de Faixa">
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
<b><u>TERMO DE VISTORIA DE MANUTENÇÃO DE FAIXA</u></b>
</center>
<br><br><br>
<div align="justify">
Pelo presente termo de vistoria, assinado após a denominada manutenção, declaro que o implante de FAIXAS foi colocado com exatidão e presteza, estando em perfeito estado de uso e conservação, reservando – me ao direito de gozar dos benefícios contratuais firmados com a empresa TAPE HAIR BRASIL LTDA, adimplindo e ratificando todas suas cláusulas. O VALOR DE SUA COLOCAÇÃO DE <span id="spanNumFaixas">XX</span> FAIXAS É R$ <span id="spanValor">XXX,XX</span>.</div>
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