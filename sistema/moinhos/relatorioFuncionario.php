<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);
	$data_inicio = isset($_POST["data_inicio"]) ? $_POST["data_inicio"] : "01/" . date("m/Y", strtotime("today"));
	$data_fim = isset($_POST["data_fim"]) ? $_POST["data_fim"] : date("d/m/Y", strtotime("today"));
	$funcionarios = getFuncionarios();
	$caixa = isset($_POST['caixa']) ? $_POST['caixa'] : "";
	unset($regs);
	foreach($funcionarios as $f) 
		$regs[] = buscaHistoricoFuncionario($f['Id'],$caixa,$data_inicio,$data_fim);
		
	$sigma_atendimentos = 0;	
	$sigma_comissoes = 0;	
	$sigma_vales = 0;	
	$sigma_deducoes = 0;
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
</head>
<body>
<h3 class="titulo_secao">Loc. Espaço e Vales - período: <?=$data_inicio?> a <?=$data_fim?> <?=$caixa?></h3>
<div align="right">
<form action="relatorioFuncionario.php" method="post">
Caixa: 
<select name="caixa">
	<option value="">Qualquer
	<option value="Estética">Estética
	<option value="Megahair">Megahair	
</select>
&nbsp;&nbsp;&nbsp;
Período: de <input type="text" name="data_inicio" size="10" value="<?=$data_inicio?>"> a <input type="text" name="data_fim" size="10" value="<?=$data_fim?>">
<input type="submit" value="gerar relatório">		

</form>
</div>

<table width="750">
	<tr>
    	<td class="formulario">Nome</td>
    	<td class="formulario">N</td>
    	<td class="formulario">Atend.</td>
    	<td class="formulario">Loc. Espaço</td>
    	<td class="formulario">Lucro</td>	
    	<td class="formulario">Deduções</td>
       	<td class="formulario">Vales</td>
    	<td class="formulario">A pagar<br>(Loc. Espaço - deduções - vales)</td>
	</tr>
	<?php foreach($regs as $item) {
			extract($item);
			$funcionario = getFuncionario($id_funcionario);
			$funcionario = $funcionario["Nome"] . " " . $funcionario["Sobrenome"]; 

			$sigma_atendimentos += $num_atendimentos;	
			$sigma_total_atendimentos += $total_atendimentos;	
			$sigma_comissoes += $total_comissoes;	
			$sigma_deducoes += $total_deducoes;	
			$sigma_vales += $total_vales;	
			?>
    <tr>
    	<td class="formulario"><a href="relatorioIndividual.php?id=<?=$id_funcionario?>&data_inicio=<?=$data_inicio?>&data_fim=<?=$data_fim?>&caixa=<?=$caixa?>"><?=$funcionario?></td>
    	<td class="formulario"><?=$num_atendimentos?></td>
    	<td class="formulario"><?=number_format($total_atendimentos, 2, ',','.')?></td>
    	<td class="formulario"><?=number_format($total_comissoes, 2, ',','.')?></td>
    	<td class="formulario"><?=number_format($total_atendimentos-$total_comissoes, 2, ',','.')?></td>
    	<td class="formulario"><?=number_format($total_deducoes, 2, ',','.')?></td>		
    	<td class="formulario"><?=number_format($total_vales, 2, ',','.')?></td>		
    	<td class="formulario"><?=number_format($total_comissoes-$total_deducoes-$total_vales, 2, ',','.')?></td>		
    </tr><?php 
				} ?>

    <tr>
    	<td><b>TOTAIS</b></td>
    	<td><b><?=$sigma_atendimentos?></b></td>
    	<td><b><?=number_format($sigma_total_atendimentos, 2, ',','.')?></b></td>
    	<td><b><?=number_format($sigma_comissoes, 2, ',','.')?></b></td>
    	<td><b><?=number_format($sigma_total_atendimentos-$sigma_comissoes, 2, ',','.')?></b></td>
    	<td><b><?=number_format($sigma_deducoes, 2, ',','.')?></b></td>		
    	<td><b><?=number_format($sigma_vales, 2, ',','.')?></b></td>		
    	<td><b><?=number_format($sigma_comissoes-$sigma_deducoes-$sigma_vales, 2, ',','.')?></b></td>		
    </tr>
</table>	
<br><br>

</body>
</html>