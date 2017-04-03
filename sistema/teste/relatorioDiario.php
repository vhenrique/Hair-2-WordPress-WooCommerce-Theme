<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);
	$caixa = isset($_GET["caixa"]) ? $_GET["caixa"] : '';
	$data = isset($_POST["data"]) ? $_POST["data"] : date("d/m/Y", strtotime("today"));
	$receitas = getMovimentacoesQuitadas($data,$data,"receita",$caixa);
	$despesas = getMovimentacoesQuitadas($data,$data,"despesa",$caixa);
	$comissoes = getComissoesPeriodo($data,$data);
	$vales = getValesPeriodo($data,$data,$caixa);
	$estoque = getEstoquePeriodo($data,$data,$caixa);
	$total_receitas = 0;
	$total_despesas = 0;
	$total_comissoes = 0;
	$total_vales = 0;
	
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
<h3 class="titulo_secao">Relatorio Diário<?php if($caixa) echo ' - ' . $caixa;?> - <?=$data?></h3>
<div align="right">
<form action="relatorioDiario.php?caixa=<?=$caixa?>" method="post">
Escolha uma data: <input type="text" name="data" size="10" value="<?=$data?>"><input type="submit" value="gerar relatório">
</form>
</div>

<table width="750">
	<tr>
    	<td colspan="6"><b>Receitas</b></td>	
	</tr>
	<tr>
    	<td class="formulario">Registro</td>
    	<td class="formulario" width="100">Usuário</td>
       	<td class="formulario" width="250">Descrição</td>
    	<td class="formulario">Valor</td>
    	<td class="formulario">Forma</td>
	</tr><?php foreach($receitas as $item) {
			extract($item);
			$total_receitas += $TotalPago; 
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; 
			$cliente = getCliente($IdCliente);
			$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
			$rec = getReceita($IdPai);
			$descricao = $cliente . " - " . implode(', ',explode('||',$rec['ServicosNomes'])) . "(Parcela " . $ParcNum . "/" . $rec['Parcelamento'] . ")";				
			?>
    <tr>
    	<td class="formulario"><?=date("d/m/Y", strtotime($Data));?><br><?=date("H:i:s", strtotime($Data));?></td>
    	<td class="formulario"><?=$usuario?></td>
    	<td class="formulario"><?=$descricao?></td>
    	<td class="formulario"><?=number_format($TotalPago, 2, ',','.')?></td>
    	<td class="formulario"><?=$FormaPgto?></td>
    </tr><?php 
				} ?>
    <tr>
    	<td colspan="9" align="right"><b>Total em receitas no dia: R$ <?=number_format($total_receitas, 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>

<table width="750">
	<tr>
    	<td colspan="6"><b>Despesas</b></td>	
	</tr>
	<tr>
    	<td class="formulario">Registro</td>
    	<td class="formulario">Usuário</td>
    	<td class="formulario">Documento</td>
       	<td class="formulario">Descrição</td>
    	<td class="formulario">Valor</td>
	</tr><?php foreach($despesas as $item) { 
			extract($item);
			$total_despesas += $TotalPago; 
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; 
			$fornecedor = getFornecedor($IdFornecedor);
			$fornecedor = $fornecedor["Nome"] . " " . $fornecedor["Sobrenome"]; 
			$desp = getDespesa($IdPai);
			$descricao = $fornecedor . " - " . implode(', ',explode('||',$desp['Descricao'])) . " (Parcela " . $ParcNum . "/" . $desp['Parcelamento'] . ")";			
			?>
    <tr>
    	<td class="formulario"><?=date("d/m/Y", strtotime($Data));?><br><?=date("H:i:s", strtotime($Data));?></td>
    	<td class="formulario"><?=$usuario?></td>
    	<td class="formulario"><?=$Documento?></td>
    	<td class="formulario"><?=$descricao?></td>
    	<td class="formulario"><?=number_format($TotalPago, 2, ',','.')?></td>
    </tr><?php 
			}	 ?>
    <tr>
    	<td colspan="9" align="right"><b>Total em despesas no dia: R$ <?=number_format($total_despesas, 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>

<table width="750">
	<tr>
    	<td colspan="6"><b>Estoque</b></td>	
	</tr>
	<tr>
    	<td class="formulario">Registro</td>
    	<td class="formulario" width="100">Usuário</td>
       	<td class="formulario" width="250">Descrição</td>
    	<td class="formulario">Estoque</td>
	</tr><?php foreach($estoque as $item) if($IdTufos!=0){
			extract($item);
			$total_receitas += $TotalPago; 
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; 
			$cliente = getCliente($IdCliente);
			$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
			$rec = getReceita($IdPai);
			$descricao = $cliente . " - " . implode(', ',explode('||',$rec['ServicosNomes'])) . "(Parcela " . $ParcNum . "/" . $rec['Parcelamento'] . ")";				
			?>
    <tr>
    	<td class="formulario"><?=date("d/m/Y", strtotime($Data));?><br><?=date("H:i:s", strtotime($Data));?></td>
    	<td class="formulario"><?=$usuario?></td>
    	<td class="formulario"><?=$descricao?></td>
    	<td class="formulario">Id: <?=$IdTufos?> - Qtde utilizada: <?=$QtdeTufos?> - Qtde remanescente: <?=$SobrouTufos?></td>
    </tr><?php 
				} ?>
</table>
<br><br>

<table width="750">
	<tr>
    	<td colspan="9"><b>Loc. Espaço</b></td>	
	</tr>
	<tr>
    	<td class="formulario">Cliente</td>
    	<td class="formulario">Comanda</td>
       	<td class="formulario">Profissional</td>
    	<td class="formulario">Descrição</td>
    	<td class="formulario">%</td>
    	<td class="formulario">Valor</td>
	</tr><?php foreach($comissoes as $item) 
		if($item["IdFuncionario"]!=0){
			extract($item);
			$rec_aux = getReceita($IdReceita);
			if($caixa == '' || $rec_aux['Caixa'] == $caixa) {
				$total_comissoes += $Valor; 
				$cliente = getCliente($rec_aux['IdCliente']);
				$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
				$usuario = getUsuario($IdUsuario);
				$usuario = $usuario["Nome"]; 
				$funcionario = getFuncionario($IdFuncionario);
				$funcionario = $funcionario["Nome"] . " " . $funcionario["Sobrenome"]; 
				$num_comanda = $rec_aux['NumComanda'];
				$servicos = implode(', ',explode('||',$rec_aux['ServicosNomes']));
			?>
	<tr>
		<td class="formulario"><?=$cliente?></td>
		<td class="formulario"><?=$num_comanda?></td>
		<td class="formulario"><?=$funcionario?></td>
		<td class="formulario"><?php if($ServNome != "") echo $ServNome; else echo $servicos; ?></td>
		<td class="formulario"><?=number_format($Percentual*100, 2,',','.')?></td>
		<td class="formulario"><?=number_format($Valor, 2, ',','.')?></td>
	</tr>
<?php 
			}
		}
?>
    <tr>
    	<td colspan="9" align="right"><b>Total em Loc. Espaço no dia: R$ <?=number_format($total_comissoes, 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>

<table width="750">
	<tr>
    	<td colspan="9"><b>Vales</b></td>	
	</tr>
	<tr>
    	<td class="formulario">Registro</td>
    	<td class="formulario">Usuário</td>
       	<td class="formulario">Profissional</td>
    	<td class="formulario">Valor</td>
	</tr><?php foreach($vales as $item) {
			extract($item);
			$total_vales += $Total; 
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; 
			$funcionario = getFuncionario($IdFuncionario);
			$funcionario = $funcionario["Nome"] . " " . $funcionario["Sobrenome"]; 
?>
    <tr>
    	<td class="formulario"><?=date("d/m/Y", strtotime($Data));?><br><?=date("H:i:s", strtotime($Data));?></td>
    	<td class="formulario"><?=$usuario?></td>
    	<td class="formulario"><?=$funcionario?></td>
    	<td class="formulario"><?=number_format($Total, 2, ',','.')?></td>
    </tr><?php 
				} ?>
    <tr>
    	<td colspan="9" align="right"><b>Total em vales no dia: R$ <?=number_format($total_vales, 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>
<div align="right">
<table>
	<tr>
		<td>(+)</td>
		<td>Total em receitas:</td>
		<td>R$ <?=number_format($total_receitas, 2, ',','.')?></td>
	</tr>
	<tr>
		<td>(-)</td>
		<td>Total em despesas:</td>
		<td>R$ <?=number_format($total_despesas, 2, ',','.')?></td>
	</tr>
	<tr>
		<td>(-)</td>
		<td>Total em Loc. Espaço:</td>
		<td>R$ <?=number_format($total_comissoes, 2, ',','.')?></td>
	</tr>
	<tr>
		<td>(-)</td>
		<td>Total em vales:</td>
		<td>R$ <?=number_format($total_vales, 2, ',','.')?></td>
	</tr>
	<tr>
    	<td colspan="3" align="right"><b>FLUXO DO DIA: R$ <?=number_format($total_receitas-$total_despesas-$total_comissoes-$total_vales, 2, ',','.')?></b></td>	
	</tr>
</table>
</div>
<br><br>

</body>
</html>