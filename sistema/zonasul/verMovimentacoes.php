<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);
	$data_inicio = isset($_POST["data_inicio"]) ? $_POST["data_inicio"] : "01/" . date("m/Y", strtotime("today"));
	$data_fim = isset($_POST["data_fim"]) ? $_POST["data_fim"] : date("d/m/Y", strtotime("today"));
//	$mvts = getMovimentacoesPeriodo($data_inicio,$data_fim,'','');
	connect();
	$mvts = buscaFinanceira($_POST);
	disconnect();
	usort($mvts, "cmp"); 
	$total_mvts = 0;
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
<h3 class="titulo_secao">Movimentações</h3>
<div align="center">
<form action="verMovimentacoes.php" method="post">
<table>
	<tr>
		<td class="formulario" align="center">
			<b>RECEITAS</b><br>
			<input type="radio" name="receitas" value="todas" <?php if($_POST['receitas']=='todas') echo 'checked'; ?>>Todas 
			<input type="radio" name="receitas" value="quitadas" <?php if($_POST['receitas']=='quitadas') echo 'checked'; ?>>Quitadas<br>
			<input type="radio" name="receitas" value="futuras" <?php if($_POST['receitas']=='futuras') echo 'checked'; ?>>Futuras  
			<input type="radio" name="receitas" value="atrasadas" <?php if($_POST['receitas']=='atrasadas') echo 'checked'; ?>>Vencidas
			<input type="radio" name="receitas" value="0" <?php if($_POST['receitas']=='0') echo 'checked'; ?>>Não<br>
			Cliente: 
			<select name="IdCliente" style="width:100px;">
				<option value="">Todos</option>
	<?php 
		$regs = getClientes();
		foreach($regs as $r) {
	?>
				<option value="<?=$r['Id']?>"><?=$r['Nome']?>  <?=$r['Sobrenome']?></option>
	<?php
		}
	?>		
			</select> 
		</td>
		<td class="formulario" align="center">
			<b>DESPESAS</b><br>
			<input type="radio" name="despesas" value="todas" <?php if($_POST['despesas']=='todas') echo 'checked';?>>Todas 
			<input type="radio" name="despesas" value="quitadas" <?php if($_POST['despesas']=='quitadas') echo 'checked'; ?>>Quitadas<br>  
			<input type="radio" name="despesas" value="futuras" <?php if($_POST['despesas']=='futuras') echo 'checked'; ?>>Futuras  
			<input type="radio" name="despesas" value="atrasadas" <?php if($_POST['despesas']=='atrasadas') echo 'checked'; ?>>Vencidas
			<input type="radio" name="despesas" value="0" <?php if($_POST['despesas']=='0') echo 'checked'; ?>>Não<br>
			Fornecedor: 
			<select name="IdFornecedor" style="width:100px;">
				<option value="">Todos</option>
	<?php 
		$regs = getFornecedores();
		foreach($regs as $r) {
	?>
				<option value="<?=$r['Id']?>"><?=$r['Nome']?>  <?=$r['Sobrenome']?></option>
	<?php
		}
	?>		
			</select><br> 
			Conta: 
			<select name="Conta" style="width:100px;">
				<option value="">Todas</option>
	<?php 
		$regs = getContas();
		foreach($regs as $r) {
	?>
				<option value="<?=$r?>"><?=$r?></option>
	<?php
		}
	?>		
			</select> 
		</td>
		<td class="formulario" align="center">
			<b>PERÍODO</b><br>
			<input type="text" name="data_inicio" size="10" value="<?=$data_inicio?>"> a <input type="text" name="data_fim" size="10" value="<?=$data_fim?>"><br>
			Caixa: 
			<select name="Caixa">
				<option value="">Todas</option>
				<option value="Estética">Estética</option>
				<option value="Megahair">Megahair</option>
			</select><br>
			Forma: 
			<select name="FormaPgto" style="width:100px ">
				<option value="">Todas</option>
				<option value="Dinheiro">Dinheiro</option>
				<option value="Cheque">Cheque</option>
				<option value="Boleto Bancário">Boleto</option>
				<option value="Cartão de Débito-Visa">Cartão de Débito - Visa</option>
				<option value="Cartão de Débito-Mastercard">Cartão de Débito - Mastercard</option>
				<option value="Cartão de Débito-Banrisul">Cartão de Débito - Banrisul</option>
				<option value="Cartão de Crédito-Visa">Cartão de Crédito - Visa</option>
				<option value="Cartão de Crédito-Mastercard">Cartão de Crédito - Mastercard</option>
			</select>
		</td>
		<td>
			<input type="submit" value="gerar relatório">		
		</td>
</tr>
</form>
</table>
</div>

<table cellpadding="1" cellspacing="0">
	<tr>
    	<td class="formulario">Quitação</td>
    	<td class="formulario">Vencimento</td>
    	<td class="formulario">Registro</td>
    	<td class="formulario">Usuário</td>
       	<td class="formulario" width="250">Descrição</td>
    	<td class="formulario">Forma</td>
    	<td class="formulario">Valor</td>
    	<td class="formulario">Conta</td>
		<td class="formulario"></td>            
		<td class="formulario"></td>            

	</tr><?php foreach($mvts as $item) {
			extract($item);
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; 
			$conta="";
			if($Tipo == 'receita') {
				$total_mvts += $ParcValor; 
				$cliente = getCliente($IdCliente);
				$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
				$rec = getReceita($IdPai);
				$descricao = $cliente . " - " . implode(', ',explode('||',$rec['ServicosNomes'])) . "(Parcela " . $ParcNum . "/" . $rec['Parcelamento'] . ")";			
				$cor = '#66CC33';
			} else {
				$total_mvts -= $ParcValor; 
				$cor = '#FF3333';
				if($Tipo == 'despesa') {
					$fornecedor = getFornecedor($IdFornecedor);
					$fornecedor = $fornecedor["Nome"] . " " . $fornecedor["Sobrenome"]; 
					$desp = getDespesa($IdPai);
					$conta = $desp["Conta"];
					$descricao = $fornecedor . " - " . implode(', ',explode('||',$desp['Descricao'])) . " (Parcela " . $ParcNum . "/" . $desp['Parcelamento'] . ")";			
				} else {
					$funcionario = getFuncionario($IdFuncionario);
					$funcionario = $funcionario["Nome"] . " " . $funcionario["Sobrenome"]; 
					$descricao = $funcionario . " - VALE ";			
				}
			}	
			?>
    <tr>
    	<td class="tabela_pqno" bgcolor="<?=$cor?>"><?php if($DataQuitacao!=0) echo date("d/m/Y", strtotime($DataQuitacao));?></td>
    	<td class="tabela_pqno" bgcolor="<?=$cor?>"><?=date("d/m/Y", strtotime($ParcVenc));?></td>
    	<td class="tabela_pqno" bgcolor="<?=$cor?>"><?=date("d/m/Y", strtotime($Data));?><br><?=date("H:i:s", strtotime($Data));?></td>
    	<td class="tabela_pqno" bgcolor="<?=$cor?>"><?=$usuario?></td>
    	<td class="tabela_pqno" bgcolor="<?=$cor?>"><?=$descricao?></td>
    	<td class="tabela_pqno" bgcolor="<?=$cor?>"><?=$FormaPgto?></td>
    	<td class="tabela_pqno" bgcolor="<?=$cor?>"><?=number_format($ParcValor, 2, ',','.')?></td>
    	<td class="tabela_pqno" bgcolor="<?=$cor?>"><?=$conta?></td>
		<td class="tabela_pqno" bgcolor="<?=$cor?>"><a href="javascript:enviaForm('remover_movimentacao.php?tipo=<?=$Tipo?>&id=<?=$Id?>&id_pai=<?=$IdPai?>',true);">remover</a></td>
		<td class="tabela_pqno" bgcolor="<?=$cor?>"><a href="verParcela.php?id=<?=$Id?>">ver</a></td>
    </tr><?php 
				} ?>
    <tr>
    	<td colspan="4" align="right"><b>Total no período</b></td>
   		<td><b>R$ <?=number_format($total_mvts, 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>

</body>
</html>

<?php
	function cmp($a, $b)
	{
		return strcmp($a["ParcVenc"], $b["ParcVenc"]);
	} 	
?>

