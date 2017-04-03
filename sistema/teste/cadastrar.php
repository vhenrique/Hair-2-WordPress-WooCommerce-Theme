<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
?>
<html>
<head>
<style type="text/css">
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size:10pt;
	color:#000000;
	background-color:#AC94B6;
}
a:link {
	color: #FFFFFF;
	text-decoration: underline;
}
a:visited {
	color: #FFFFFF;
	text-decoration: underline;
}
a:hover {
	color: #FFFFFF;
	text-decoration: underline;
}
a:active {
	color: #FFFFFF;
	text-decoration: underline;
}

</style>
</head>
<body>
<?php
	if(!isset($_GET["tabela"]))
		die("Nenhuma tabela foi fornecida");
	$tabela = $_GET["tabela"];
	connect();

	if($tabela == 'agenda') {
		$_POST['HoraInicio'] = formatDate($_POST['Data']) . ' ' . $_POST['Inicio'] . ':00';
		$_POST['HoraFim'] = date('Y-m-d H:i:s',strtotime($_POST['HoraInicio'] . ' +' . $_POST['Duracao']));
		unset($_POST['Data']);
		unset($_POST['Inicio']);
		unset($_POST['Duracao']);
		connect();
		insertData($_POST,_TABLE_PREFIX . $tabela);
		$id_ultimo = mysql_insert_id();
		disconnect();
		if(isConflitoAgenda($_POST['IdFuncionario'])==1) {
			JSAlert('Já há compromisso marcado para esse horário');
			deleteEntryById($id_ultimo,_TABLE_PREFIX . $tabela);			
		}
		JSAlert("Dados inseridos com sucesso!");
			?>
				<script>
					history.go(-1);
				</script>
			<?php
		exit;
	}


	if($tabela=="receitas") {
		$_POST['FormaPgto'] = implode('||',$_POST['forma_pgto']);
		$_POST['ValorParc'] = implode('||',$_POST['parc_valor']);		
		//lança comissões
		$ComissaoPerc = explode('||',$_POST['com_perc']);
		$IdFunc = explode('||',$_POST['com_id']);
		for($i=0;$i<sizeof($IdFunc);$i++) {
			unset($dados);
			$dados['IdUsuario'] = $_POST['IdUsuario'];
			$dados['IdFuncionario'] = $IdFunc[$i];
			$dados['Percentual'] = $ComissaoPerc[$i];
			$dados['IdReceita'] = 0;					
			$dados['Valor'] = $ComissaoPerc[$i]*$_POST['Total'];
			insertData($dados,_TABLE_PREFIX . 'comissoes');
		}
		unset($_POST['com_perc']);
		unset($_POST['com_id']);
		unset($_POST['Percentual']);
		unset($_POST['Funcionario']);
		unset($_POST['forma_pgto']);
		unset($_POST['parc_valor']);	
	}

	if($tabela=="orcamentos") {
		$_POST["FormaPgto"] = implode('||',$_POST["forma_pgto"]);
		$_POST["ParcValor"] = implode('||',$_POST["parc_valor"]);
		$_POST["ParcVenc"] = implode('||',$_POST["parc_venc"]);
		$_POST["ServicosNomes"] = implode('||',$_POST["serv_desc"]);
		$_POST["ServicosValores"] = implode('||',$_POST["serv_valor"]);
		unset($_POST["serv_desc"]);
		unset($_POST["serv_valor"]);
		unset($_POST["forma_pgto"]);
		unset($_POST["parc_valor"]);
		unset($_POST["parc_venc"]);
	}

	if($tabela=="receitas" || $tabela=="despesas") {
		$_POST["DataTransacao"] = formatDate($_POST["DataTransacao"]);
	}

	if($tabela=="estoque") {
		$_POST["DataEntrada"] = formatDate($_POST["DataEntrada"]);
		$_POST["TufosInicial"] = $_POST["Tufos"];
	}

	if($tabela=="usuarios") {
		$_POST["Email"] = md5($_POST["Email"]);
		$_POST["Senha"] = md5($_POST["Senha"]);		
	}
	
	if($tabela=="funcionarios" || $tabela=="clientes")  {
		$_POST["DataNascimento"] = formatDate($_POST["DataNascimento"]);
		$_POST["DataEntrada"] = formatDate($_POST["DataEntrada"]);
	}
	if(insertData($_POST,_TABLE_PREFIX . $tabela)) {
		$id_reg = mysql_insert_id();
		if($tabela == 'orcamentos') {?>
			<font face="Arial, Helvetica, sans-serif" color="#FFFFFF">Orçamento inserido com sucesso. <a href='imprimirOrcamento.php?id=<?=$id_reg?>' target="_blank">Clique aqui</a> para visualizá-lo.</font>
			</body></html>
		<?php 
			die();
		}
		JSAlert("Dados inseridos com sucesso!");
	}	else
		JSAlert("Houve falha na inserção dos dados. Tente novamente.");
	disconnect();
?>

	<script>
		history.go(-2);
	</script>
	</body></html>