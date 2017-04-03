<?php

	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}

	if(isset($_GET['id']) || isset($_POST['Opcoes']))
		$id = isset($_GET['id']) ? $_GET['id'] : $_POST["Opcoes"];
	else
		die('Nenhum orçamento fornecido');
	$orcamento = getOrcamento($id);
	if($orcamento) {
		extract($orcamento);
		$ServicosNomes = explode("||",$ServicosNomes);
		$ServicosValores = explode("||",$ServicosValores);
		$FormaPgto = explode("||",$FormaPgto);		
		$ParcValor = explode("||",$ParcValor);
		$ParcVenc = explode("||",$ParcVenc);
		$cliente = getCliente($IdCliente);
		$NomeCliente = $cliente['Nome'] . ' ' . $cliente['Sobrenome'];
		$NomeUsuario = getUsuario2($IdUsuario,'Nome');
	}
	else
		die('Orçamento inexistente.');
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<style type="text/css">
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size:10pt;
	color:#000000;
	background-color:#AC94B6;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}

table.listar {
	font-family:Arial, Helvetica, sans-serif;
	font-size:10pt;
}

.formulario {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12pt;
	padding:5px;
}

.formulario_caput {
	font-family:Arial, Helvetica, sans-serif;
	font-size:14pt;
	font-weight:bold;
	padding:3px;
}

</style>
<script language="javascript">
</script>

<script type="text/javascript" src="javascript_martha.js"></script>
</head>
<body bgcolor="#ffffff" style="background-color:#FFFFFF ">
<table class="cadastrar" border="0">
	<tr>
		<td colspan="3" align="center" width="600"><img src="logo_impressao.png"></td>
	</tr>
	<tr>
		<td colspan="3"><h3 class="titulo_secao">Orçamento</h3></td>
	</tr>
  	<tr>
    	<td class="formulario"><strong>Cliente:</strong> <?=$NomeCliente?></td>
    	<td class="formulario"><strong>Orçado por:</strong> <?=$NomeUsuario?></td>
    	<td class="formulario"><strong>Data:</strong> <?=date("d/m/Y",strtotime($Data));?></td>
    </tr>
<tr>
	<td class="formulario_caput" colspan="3"><br>Descrição do cabelo do cliente</td>
</tr>
	<td class="formulario"><strong>Cor:</strong> <?=$CabeloCor?></td>
	<td class="formulario"><strong>Tipo do cabelo:</strong> <?=$CabeloTipo?></td>
	<td class="formulario"><strong>Tipo:</strong> <?=$Tipo?></td>
</tr>
<tr>
	<td class="formulario"><strong>Comprimento:</strong> <?=$CabeloComprimento?>cm</td>
	<td class="formulario"><strong>Peso:</strong> <?=$CabeloPeso?>g</td>
</tr>
<tr>
	<td class="formulario"><strong>Número de mechas:</strong> <?=$NumMechas?></td>
	<td class="formulario"><strong>Preço por mecha:</strong> R$ <?=number_format($PrecoMecha, 2, ',','.')?></td>
	<td class="formulario"><strong>Total em mechas:</strong> R$ <?=number_format($TotalMechas, 2, ',','.')?></td>
</tr>    		
<tr>
	<td class="formulario" colspan="3"><strong>Outras informações:</strong><br>
	<?=$Obs?></td>
</tr>
<tr>
	<td class="formulario_caput" colspan="3"><br>Descrição do serviço</td>
</tr>
<tr>
	<td colspan="3" class="formulario">

<table>
	<tr>
		<td class="formulario" width="200" valign="top"><b>Descrição</b></td>    
		<td class="formulario" width="100" valign="top"><b>Valor</b></td>    
    </tr>
<?php
	for($i=0;$i<sizeof($ServicosNomes);$i++) {
		if($ServicosNomes[$i]!="") {
?>
			<tr>
				<td class="formulario" valign="top"><?=$ServicosNomes[$i]?></td>    
				<td class="formulario" valign="top">R$ <?=number_format($ServicosValores[$i], 2, ',','.')?></td>    
			</tr>
<?php
		}
	}
?>
    <tr>
    	<td class="formulario" align="right"><b>Subtotal</b></td>
        <td class="formulario">R$ <?=number_format($Subtotal, 2, ',','.')?></td>
    </tr>    		
</table>
    </td>
</tr>
<tr>
	<td class="formulario_caput" colspan="3"><br>Plano de pagamento<td>
</tr>
<tr>
	<td class="formulario" colspan="3">
		<table>
			<tr>
				<td class="formulario"><b>Parcela</b></td>
				<td class="formulario"><b>Forma de pagamento</b></td>
				<td class="formulario"><b>Valor</b></td>
				<td class="formulario"><b>Vencimento</b></td>
			</tr>
			<tr>
				<td class="formulario">Entrada</td>
				<td class="formulario"><?=$FormaPgto[0]?></td>
				<td class="formulario">R$ <?=number_format($ParcValor[0], 2, ',','.')?></td>
				<td class="formulario"><?=$ParcVenc[0]?></td>
			</tr>
<?php
	for($i=1;$i<sizeof($FormaPgto);$i++) {
?>    <tr>
		<td class="formulario"><?=$i?></td>
		<td class="formulario"><?=$FormaPgto[$i]?></td>
		<td class="formulario">R$ <?=number_format($ParcValor[$i], 2, ',','.')?></td>
		<td class="formulario"><?=$ParcVenc[$i]?></td>
	</tr><?php
	}
?>
		</table>
	</td>
</tr>
<?php if($Desconto!=1) { ?>	
<tr>
	<td class="formulario_caput" colspan="3" align="right"><br>Desconto: <?=number_format((1-$Desconto)*100, 0, ',','.')?>%</td>
</tr>
<?php } ?>
<tr>
	<td class="formulario_caput" colspan="3" align="right"><br>Total: R$ <?=number_format($Total, 2, ',','.')?></td>
</tr>
<tr>
	<td class="formulario_caput" colspan="3" align="right"><br>Manutenção: R$ <?=number_format($Manutencao, 2, ',','.')?></td>
</tr>
<tr>
	<td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:10px" colspan="5"><br><br><center>
	  <b>CABELOS POR KILO DO BRASIL LTDA. <br>
	  Rua Borges medeiros, 453/ conj 104 - Porto Alegre(RS)<br>
	(51) 3211.7184 - (51) 3228.9711 <br> 
	http://www.clinicamarthahair.com.br - atendimentocentro@clinicamarthahair.com.br</b>
	</center></td>
</tr>
</table>
</form>
</body>
</html>