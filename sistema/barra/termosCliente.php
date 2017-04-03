<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	if(isset($_POST["Opcoes"])) 
		$id = $_POST["Opcoes"];
	else
		$id = $_GET["id"];
	$cliente = getCliente($id);
	$contratos = getContratosCliente($id);
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<script language="javascript">
function windowContrato(url) {
  	var wProduto = window.open(url,'MyWin','width=800,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}
</script>
</head>
<body>
<h3 class="titulo_secao">Termos e Contratos - <?=$cliente['Nome'] . ' ' . $cliente['Sobrenome']?></h3>
<b>Gerar novo:</b><br>
<a href="javascript:windowContrato('termoMegahair.php?id=<?=$id?>');">Contrato Mega Hair</a><br>
<a href="javascript:windowContrato('termoEncomenda.php?id=<?=$id?>');">Termo de Encomenda</a><br>
<a href="javascript:windowContrato('termoCompromisso.php?id=<?=$id?>');">Termo de Compromisso</a><br>
<a href="javascript:windowContrato('termoResponsabilidade.php?id=<?=$id?>');">Termo de Responsabilidade de Retirada</a><br>
<a href="javascript:windowContrato('termoManutencao.php?id=<?=$id?>');">Termo de Vistoria de Manutenção</a><br>
<a href="javascript:windowContrato('termoManutencaoFaixa.php?id=<?=$id?>');">Termo de Vistoria de Manutenção de Faixa</a><br>
<a href="javascript:windowContrato('termoVistoriaProtese.php?id=<?=$id?>');">Termo de Vistoria de Colocação de Prótese</a><br>
<a href="javascript:windowContrato('termoVistoriaColocacao.php?id=<?=$id?>');">Termo de Vistoria de Colocação</a><br>

<br><br>
<b>Contratos arquivados:</b><br>
<?php
	foreach($contratos as $contrato) {
		extract($contrato);
?>
	<a href="javascript:windowContrato('verContrato.php?id=<?=$Id?>')"><?=date('d/m/Y',strtotime($DataCadastro))?> - <?=$Tipo?></a><br>
<?php		
	}
?>

<br><br>
</body>
</html>