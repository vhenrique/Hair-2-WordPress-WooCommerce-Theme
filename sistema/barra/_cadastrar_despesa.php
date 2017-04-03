<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);
		
	$tabela = 'despesas';
	connect();
	$FormaPgto = $_POST['forma_pgto'];
	$ParcValor = $_POST['parc_valor'];
	$ParcVenc = $_POST['parc_venc'];	
	$ParcCheque = $_POST['parc_cheque'];	
	$ParcQuitado = $_POST['parc_quitado'];	
	$ParcDataQuitacao = $_POST['parc_dataquitacao'];	

	$_POST['FormaPgto'] = implode('||',$_POST['forma_pgto']);
	$_POST['ParcValor'] = implode('||',$_POST['parc_valor']);		
	$_POST['ParcVenc'] = implode('||',$_POST['parc_venc']);		
	$_POST['ParcCheque'] = implode('||',$_POST['parc_cheque']);		
	$ParcVenc[0] = $DataTransacao;	
	$_POST['DataTransacao'] = formatDate($_POST['DataTransacao']);
	unset($_POST['Valor']);
	unset($_POST['forma_pgto']);
	unset($_POST['parc_valor']);	
	unset($_POST['parc_venc']);	
	unset($_POST['parc_cheque']);		
	unset($_POST['parc_quitado']);		
	unset($_POST['parc_dataquitacao']);		
	unset($_POST['ref']);	
	if(insertData($_POST,_TABLE_PREFIX . $tabela)) {
		$id_reg = mysql_insert_id();
		//lança parcelas
		for($i=0;$i<sizeof($FormaPgto);$i++) {
			unset($dados);
			if($ParcQuitado[$i] == 1) {
				$dados['Quitado'] = 1;
				$dados['DataQuitacao'] = formatDate($ParcDataQuitacao[$i]);
				$dados['TotalPago'] = $ParcValor[$i];				
			} else {
				$dados['Quitado'] = 0;
				$dados['DataQuitacao'] = '';
			}
			$dados['ParcCheque'] = $ParcCheque[$i];		
			$dados['Caixa'] = $_POST['Caixa'];
			$dados['IdFornecedor'] = $_POST['IdFornecedor'];
			$dados['Tipo'] = 'despesa';
			$dados['Conta'] = $_POST['Conta'];
			$dados['IdPai'] = $id_reg;
			$dados['IdUsuario'] = $_POST['IdUsuario'];
			$dados['FormaPgto'] = $FormaPgto[$i];
			$dados['ParcValor'] = $ParcValor[$i];
			$dados['ParcVenc'] = formatDate($ParcVenc[$i]);	
			$dados['ParcNum'] = $i;		
			if($dados['ParcValor'] != '0.00')
				insertData($dados,_TABLE_PREFIX . 'movimentacoes');
			echo mysql_error();
		}
		JSAlert("Dados inseridos com sucesso!");
	}	else
		JSAlert("Houve falha na inserção dos dados. Tente novamente.");
	disconnect();
	die();
?>

	<script>
		history.go(-2);
	</script>
	</body></html>