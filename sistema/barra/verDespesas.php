<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	$data_inicio = isset($_POST["data_inicio"]) ? $_POST["data_inicio"] : "01/" . date("m/Y", strtotime("today"));
	$data_fim = isset($_POST["data_fim"]) ? $_POST["data_fim"] : date("d/m/Y", strtotime("today"));
	$despesas = getDespesasPeriodo($data_inicio,$data_fim);
	$total_despesas = 0;
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<script language="javascript">
function enviaForm(action_url,confirma) {
	var envia = true;
	if(confirma)
		envia = confirm("Tem certeza?");
	if(envia)
		window.location = action_url;
}

</script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="carregar.js"></script>
</head>
<body>
<h3 class="titulo_secao">Despesas</h3>
<div align="right">
<form action="verDespesas.php" method="post">
Por período: <input type="text" name="data_inicio" size="10" value="<?=$data_inicio?>"> a <input type="text" name="data_fim" size="10" value="<?=$data_fim?>"><input type="submit" value="gerar relatório">
</form>
</div>
<table>
	<tr>
    	<td class="formulario">Transação</td>
    	<td class="formulario">Registro</td>
    	<td class="formulario" width="100">Usuário</td>
    	<td class="formulario" width="100">Destino</td>
       	<td class="formulario" width="250">Descrição</td>
    	<td class="formulario">Valor</td>            
	</tr><?php foreach($despesas as $item) {
			extract($item);
			$total_despesas += $Total; 
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; ?>
    <tr>
    	<td class="formulario"><?=date("d/m/Y", strtotime($DataTransacao));?></td>
    	<td class="formulario"><?=date("d/m/Y", strtotime($Data));?><br><?=date("H:i:s", strtotime($Data));?></td>
    	<td class="formulario"><?=$usuario?></td>
    	<td class="formulario"><?=$Destino?></td>
    	<td class="formulario"><?=$Descricao?></td>
    	<td class="formulario">R$ <?=number_format($Total, 2, ',','.')?></td>
		<td class="formulario"><a href="javascript:enviaForm('remover.php?tabela=despesas&id=<?=$Id?>',true);">remover</a></td>
    </tr><?php 
				} ?>
    <tr>
    	<td colspan="4" align="right"><b>Total no período</b></td>
   		<td><b>R$ <?=number_format($total_despesas, 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>

</body>
</html>