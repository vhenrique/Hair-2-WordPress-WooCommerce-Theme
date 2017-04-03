<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);
	
	$id = isset($_GET["id"]) ? $_GET["id"] : die('Nenhum id fornecido.');
	$data_inicio = isset($_GET["data_inicio"]) ? $_GET["data_inicio"] : "01/" . date("m/Y", strtotime("today"));
	$data_fim = isset($_GET["data_fim"]) ? $_GET["data_fim"] : date("d/m/Y", strtotime("today"));
	$caixa = isset($_GET['caixa']) ? $_GET['caixa'] : "";

	$comissoes = getComissoesPeriodo($data_inicio,$data_fim,$caixa);
	$vales = getValesPeriodo($data_inicio,$data_fim,$caixa);
	$funcionario = getFuncionario($id);
	$funcionario = $funcionario["Nome"] . " " . $funcionario["Sobrenome"];
	$total_comissoes = 0;	
	$total_vales = 0;	
	connect();
	$aux_func = buscaHistoricoFuncionario($id,$caixa,$data_inicio,$data_fim);
	$num_atendimentos = $aux_func['num_atendimentos'];
	$num_vales = $aux_func['num_vales'];	
	$total_deducoes = $aux_func['total_deducoes'];	
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
<h3 class="titulo_secao">Loc. Espaço e Vales  - Profissional: <?=$funcionario?> - período: <?=$data_inicio?> a <?=$data_fim?> <?=$caixa?></h3>
<div align="right">
</div>

<table width="750">
	<tr>
    	<td colspan="9"><b>Loc. Espaço</b></td>	
	</tr>
	<tr>
    	<td class="formulario">Data</td>
    	<td class="formulario">Usuário</td>
    	<td class="formulario">Cliente</td>
    	<td class="formulario">Comanda</td>
    	<td class="formulario">Descrição</td>
    	<td class="formulario">%</td>
    	<td class="formulario">Loc. Espaço</td>
    	<td class="formulario">Dedução</td>
    	<td class="formulario">A receber</td>
    	<td class="formulario"></td>
	</tr><?php foreach($comissoes as $item) 
		if($item["IdFuncionario"]==$id){
			extract($item);
			$deducao = 0;
			$rec_aux = getReceita($IdReceita);
			$mov_aux = getParcelas($IdReceita);
			$forma_pgto = $mov_aux[0]['FormaPgto'];
			$total_comissoes += $Valor; 
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; 
			$num_comanda = $rec_aux['NumComanda'];
			$caixa = $rec_aux['Caixa'];
			$cliente = getCliente($rec_aux['IdCliente']);
			$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
			$servicos = implode(', ',explode('||',$rec_aux['ServicosNomes']));
			if($caixa=='Estética' && substr($forma_pgto,0,11)=="Cartão de D") {
				$deducao = 0.12*$ServValor;
			}	
		?>
	<tr>
		<td class="formulario"><?=date('d/m/Y',strtotime($DataTransacao))?></td>
		<td class="formulario"><?=$usuario?></td>
		<td class="formulario"><?=$cliente?></td>
		<td class="formulario"><?=$num_comanda?></td>
		<td class="formulario"><?=$servicos?></td>
		<td class="formulario"><?=number_format($Percentual*100, 0,',','.')?></td>
		<td class="formulario"><?=number_format($Valor, 2, ',','.')?></td>
		<td class="formulario"><?=number_format($deducao, 2, ',','.')?></td>
		<td class="formulario"><?=number_format($Valor-$deducao, 2, ',','.')?></td>
		<td class="formulario"><a href="javascript:enviaForm('remover.php?tabela=comissoes&id=<?=$Id?>',true);">remover</a></td>
	</tr>
<?php 
		}
?>
    <tr>
    	<td colspan="10" align="right"><b>Total em Loc. Espaço no período: R$ <?=number_format($total_comissoes, 2, ',','.')?></b></td>
	</tr>
	<tr>	
    	<td colspan="10" align="right"><b>Total em deduções no período: R$ <?=number_format($total_deducoes, 2, ',','.')?></b></td>
	</tr>
	<tr>	
    	<td colspan="10" align="right"><b>Total em Loc. Espaço a receber: R$ <?=number_format($total_comissoes-$total_deducoes, 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>

<table width="750">
	<tr>
    	<td colspan="9"><b>Vales</b></td>	
	</tr>
	<tr>
    	<td class="formulario">Data</td>
    	<td class="formulario">Usuário</td>
    	<td class="formulario">Valor</td>
    	<td class="formulario">Caixa</td>
	</tr><?php foreach($vales as $item) 
		if($item["IdFuncionario"]==$id){
			extract($item);
			$total_vales += $Total; 
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; 
?>
    <tr>
    	<td class="formulario"><?=date("d/m/Y", strtotime($DataTransacao));?></td>
    	<td class="formulario"><?=$usuario?></td>
    	<td class="formulario">R$ <?=number_format($Total, 2, ',','.')?></td>
		<td class="formulario"><?=$Caixa?></td>		
    </tr><?php 
				} ?>
    <tr>
    	<td colspan="9" align="right"><b>Total em vales no período: R$ <?=number_format($aux_func['total_vales'], 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>
<table>
	<tr>
		<td></td>
		<td>Atendimentos:</td>
		<td><?=$num_atendimentos?></td>
	</tr>
	<tr>
		<td></td>
		<td>Vales:</td>
		<td><?=$num_vales?></td>
	</tr>
	<tr>
		<td>(+)</td>
		<td>Total em Loc. Espaço:</td>
		<td>R$ <?=number_format($total_comissoes, 2, ',','.')?></td>
	</tr>
	<tr>
		<td>(-)</td>
		<td>Total em deduções:</td>
		<td>R$ <?=number_format($total_deducoes, 2, ',','.')?></td>
	</tr>
	<tr>
		<td>(-)</td>
		<td>Total em vales:</td>
		<td>R$ <?=number_format($total_vales, 2, ',','.')?></td>
	</tr>
	<tr>
    	<td colspan="3" align="right"><b>TOTAL A PAGAR: R$ <?=number_format($total_comissoes-$total_deducoes-$total_vales, 2, ',','.')?></b></td>	
	</tr>
</table>

</body>
</html>