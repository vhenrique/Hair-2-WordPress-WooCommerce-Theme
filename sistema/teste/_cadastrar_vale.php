<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
//	print_r($_POST);
	$tabela = 'vales';
	connect();
	$_POST['DataTransacao'] = formatDate($_POST['DataTransacao']);
	unset($_POST['Valor']);

		
	if(insertData($_POST,_TABLE_PREFIX . $tabela)) {
		$id_reg = mysql_insert_id();
		$tabela = 'movimentacoes';
		unset($array);
		$array['Caixa'] = $_POST['Caixa'];
		$array['Tipo'] = 'vale';		
 		$array['IdPai'] = $id_reg;
 		$array['IdFuncionario'] = $_POST['IdFuncionario'];
 		$array['ParcVenc'] = $_POST['DataTransacao'];
 		$array['DataQuitacao'] = $_POST['DataTransacao'];
 		$array['ParcValor'] = $_POST['Total'];
 		$array['TotalPago'] = $_POST['Total'];
		$array['IdUsuario'] = $_POST['IdUsuario'];		
 		$array['FormaPgto'] = 'Dinheiro';
 		$array['Quitado'] = '1';
		unset($_POST['IdFuncionario']);
		insertData($array,_TABLE_PREFIX . $tabela);
		JSAlert("Dados inseridos com sucesso!");
	}	else
		JSAlert("Houve falha na inserção dos dados. Tente novamente.");
	disconnect();
?>

	<script>
		history.go(-1);
	</script>
	</body></html>