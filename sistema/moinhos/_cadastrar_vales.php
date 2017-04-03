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