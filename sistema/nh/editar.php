<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	if(!isset($_GET["tabela"]))
		die("Nenhuma tabela foi fornecida");
	if(!isset($_GET["id"]))
		die("Nenhum Id foi fornecido");		
	$tabela = $_GET["tabela"];
	$id = $_GET["id"];
	connect();
	if($tabela=="funcionarios" || $tabela=="clientes")  {
		$_POST["DataNascimento"] = formatDate($_POST["DataNascimento"]);
		$_POST["DataEntrada"] = formatDate($_POST["DataEntrada"]);
	}

	if($tabela=="estoque") {
		$_POST["DataEntrada"] = formatDate($_POST["DataEntrada"]);
	}
	if($tabela=="usuarios") {
		$_POST["Email"] = md5($_POST["Email"]);
		$_POST["Senha"] = md5($_POST["Senha"]);		
	}

	if($tabela=="movimentacoes") {
		$_POST["DataQuitacao"] = formatDate($_POST["DataQuitacao"]);
		$_POST["TotalPago"] = $_POST["ParcValor"] + $_POST["Acrescimos"] - $_POST["Abatimentos"];
		unset($_POST['quitar']);
	}
	if(updateData($id,$_POST,_TABLE_PREFIX . $tabela))
		JSAlert("Dados editados com sucesso!");
	else
		JSAlert("Houve falha na edição dos dados. Tente novamente.");
	disconnect();
	if($tabela=="agenda") {?>
		<script>
			window.close();		
		</script>
<?php } ?>
	<script>
		history.go(-2);
	</script>