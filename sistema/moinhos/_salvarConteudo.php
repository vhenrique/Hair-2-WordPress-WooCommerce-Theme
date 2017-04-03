<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	$conteudo = explode('<inicio_contrato>',$_POST['Conteudo']);
	$conteudo = $conteudo[1];
	$_POST["Conteudo"] = addslashes($conteudo);
	$_POST["DataCadastro"] = date('Y-m-d');
	$cliente = getCliente($_POST['IdCliente']);
	$tabela = "contratos";
	connect();
	if(insertData($_POST,_TABLE_PREFIX . $tabela))
		JSAlert("Contrato salvo com sucesso!");
	else
		JSAlert("Houve falha na inserção do contrato:\n" . mysql_error());
	disconnect();
?>	
<html>
<head>
	<title><?=$_POST['Tipo']?> - <?=$cliente['Nome'] . ' ' . $cliente['Sobrenome']?></title>
	<style type="text/css">
	body,td {
		font-family:Arial, Helvetica, sans-serif;
		font-size:9pt;
		color:#000000
		}
	</style>	
	<script language="javascript">
	function escondeDiv(obj_name) {
		document.getElementById(obj_name).style.visibility = "hidden";
	} 
	</script>
</head>
<body>
<div id="divEdicao">
<table>
	<tr>
		<td width="100%" align="right">
			<button id="btImprimir" onClick="escondeDiv('divEdicao');javascript:window.print();">Imprimir</button>
		</td>
	</tr>
</table>
</div>	
		<?=$conteudo?>
	</body>
</html>