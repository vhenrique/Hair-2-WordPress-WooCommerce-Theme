<?php

require_once("../init.php");

// abre conexão com o banco
$conexao = new Conexao();

	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);	
	
	$tabela = 'receitas';
	
	/*
	if($_POST["IdTufos"]*$_POST["QtdeTufos"]>0) {
		connect();
		$tufos = getEstoqueItem($_POST["IdTufos"]);
		if(!$tufos)
			die("Item com Id " . $_POST["IdTufos"] . " inválido.");
		if($_POST["QtdeTufos"]>$tufos["Tufos"])
			die("A quantidade em estoque é de apenas " . $tufos["Tufos"] . " tufos, insuficiente para os " . $_POST["QtdeTufos"] . " solicitados.");
		else {
			connect();	
			unset($reg);
			$reg["Tufos"] =	$tufos["Tufos"]-$_POST["QtdeTufos"];
			$_POST["SobrouTufos"] = $reg["Tufos"];
			updateData($_POST["IdTufos"],$reg,_TABLE_PREFIX . 'estoque');
		}
							
	}
	*/
	
	if ( $_POST["idEstoque"] != 0) :
		$estoque = new Estoque();
		$estoque->setPrefixo(_TABLE_PREFIX);
		$estoqueSelecionado = $estoque->carregarPorId($_POST["idEstoque"]);
		if ($_POST["Quantidade"] > $estoqueSelecionado->Quantidade) {
			die("A quantidade em estoque é de apenas " . $tufos["Tufos"] . " tufos, insuficiente para os " . $_POST["QtdeTufos"] . " solicitados.");
		} else {
			$quantidade = $estoqueSelecionado->Quantidade - $_POST["Quantidade"];
			$estoque->atualizarEstoque($_POST["idEstoque"], $quantidade);
		}
	endif;
	
	if($_POST["Retornar"]==1) {
		unset($retorno);
		$cliente = getCliente($_POST["IdCliente"]);
		$retorno["Tipo"] = "Manutenção";
		$retorno["Data"] = date("Y-m-d",strtotime("+ " . $_POST["retornar_dias"] . " days",strtotime(formatDate($_POST["DataTransacao"]))));
//		$retorno["Descricao"] = $cliente["Nome"] . "  " . $cliente["Sobrenome"];
		$retorno["DataCadastro"] = date("Y-m-d H:i:s");
		$retorno["IdUsuario"] = $_POST['IdUsuario'];
		$retorno["IdCliente"] = $_POST['IdCliente'];
connect();
		insertData($retorno,_TABLE_PREFIX . 'avisos');
		echo mysql_error();		
	}

	unset($_POST["Retornar"]);
	unset($_POST["retornar_dias"]);
	connect();
	if(!isset($_POST['ref'])) {
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
	}
	$_POST['DataTransacao'] = formatDate($_POST['DataTransacao']);
	$ComissaoPerc = explode('||',$_POST['com_perc']);
	$ComissaoValor = explode('||',$_POST['com_valor']);	
	$ComissaoServNome = explode('||',$_POST['com_serv_nome']);	
	$ComissaoServValor = explode('||',$_POST['com_serv_valor']);	
	$IdFunc = explode('||',$_POST['com_id']);
	unset($_POST['com_valor']);
	unset($_POST['com_perc']);
	unset($_POST['com_id']);
	unset($_POST['com_serv_nome']);	
	unset($_POST['com_serv_valor']);	
	unset($_POST['Percentual']);
	unset($_POST['Funcionario']);
	unset($_POST['Servico']);
	unset($_POST['forma_pgto']);
	unset($_POST['parc_valor']);	
	unset($_POST['parc_venc']);	
	unset($_POST['parc_cheque']);	
	unset($_POST['parc_quitado']);		
	unset($_POST['parc_dataquitacao']);			
	unset($_POST['ref']);	
	unset($_POST['ServNome']);
	unset($_POST['ServQtde']);		
	unset($_POST['ServValor']);			
	unset($_POST['ComValor']);	
	unset($_POST['idEstoque']);
	unset($_POST['Quantidade']);		

	if(insertData($_POST,_TABLE_PREFIX . $tabela)) {
		$id_reg = mysql_insert_id();
		//lança comissões
		for($i=0;$i<sizeof($IdFunc);$i++) {
			unset($dados);
			$dados['IdUsuario'] = $_POST['IdUsuario'];
			$dados['IdFuncionario'] = $IdFunc[$i];
			$dados['Percentual'] = $ComissaoPerc[$i];
			$dados['Valor'] = $ComissaoValor[$i];
			$dados['ServNome'] = $ComissaoServNome[$i];
			$dados['ServValor'] = $ComissaoServValor[$i];	
			$dados['Caixa'] = $_POST['Caixa'];
			$dados['DataTransacao'] = $_POST['DataTransacao'];
			$dados['IdReceita'] = $id_reg;					
			insertData($dados,_TABLE_PREFIX . 'comissoes');
			echo mysql_error();			
		}
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
			$dados['IdCliente'] = $_POST['IdCliente'];
			$dados['Tipo'] = 'receita';
			$dados['IdPai'] = $id_reg;
			$dados['IdUsuario'] = $_POST['IdUsuario'];
			$dados['FormaPgto'] = $FormaPgto[$i];
			$dados['ParcValor'] = $ParcValor[$i];
			$dados['ParcVenc'] = formatDate($ParcVenc[$i]);	
			$dados['ParcNum'] = $i;		
			$dados['Caixa'] = $_POST['Caixa'];
			insertData($dados,_TABLE_PREFIX . 'movimentacoes');
			echo mysql_error();
		}
		JSAlert("Dados inseridos com sucesso!");
	}	else
		JSAlert("Houve falha na inserção dos dados. Tente novamente.");
		
		
	disconnect();
	$conexao->desconectar();
?>

	<script>
		//history.go(-2);
		document.location.href = 'caixaReceita.php';
	</script>
	</body></html>