<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	$id = isset($_GET['id']) ? $_GET['id'] : die("Nenhuma id de contrato fornecida");
	connect();
	$contrato = getContrato($id);
	extract($contrato);
	$cliente = getCliente($IdCliente);
	disconnect();
	
?>
<html>
<head>
	<title><?=$Tipo?> - <?=$cliente['Nome'] . ' ' . $cliente['Sobrenome']?></title>
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
		<?=$Conteudo?>
	</body>
</html>