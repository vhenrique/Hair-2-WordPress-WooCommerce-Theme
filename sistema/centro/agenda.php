<?php

require_once("../init.php");

// abre conexão com o banco
$conexao = new Conexao();

$acao = (isset($_REQUEST['a']) && !empty($_REQUEST['a'])) ? $_REQUEST['a'] : 'index';

switch ($acao) :
	default:
		$agenda = new Agenda();
		$agenda->setPrefixo(_TABLE_PREFIX);
		//$agenda->setDebug(true);
		
		if (isset($_REQUEST["data"]) && !empty($_REQUEST["data"])) :
			$data = Util::convertDate($_REQUEST["data"]);
		else :
			$data = Util::convertDate(date("d/m/Y"));
		endif;
		
		$agendamentos = $agenda->carregarPorData($data, $_REQUEST["IdFuncionario"]);
		
		// carrega funcionarios
		$funcionarios = $conexao->carregarTodos(_TABLE_PREFIX . "funcionarios");
		
		// carrega avisos/manutenção
		$aviso = new Aviso();
		$aviso->setPrefixo(_TABLE_PREFIX);
		//$aviso->setDebug(true);
		$avisos = $aviso->carregarTodos();
		
		// template
		$template = 'agenda/lista';
		
		// dispatch
		require_once('../html/wrapper.php');
	break;
	
	case "salvar" :
		$agenda = new Agenda();
		$agenda->setPrefixo(_TABLE_PREFIX);
		//$agenda->setDebug(true);
		list($diaInicio, $mesInicio, $anoInicio) = explode("/", $_POST["data"]);
		$dataInicio = sprintf("%s-%s-%s %s:00", $anoInicio, $mesInicio, $diaInicio, $_POST["Inicio"]); 
		$dataFim = date("Y-m-d H:i:s", (strtotime($dataInicio) + ($_POST["Duracao"] * 3600)));
		
		$dados = (object) array(
			"idFuncionario" => $_POST["IdFuncionario"],
			"idCliente" => $_POST["IdCliente"],
			"descricao" => $_POST["Descricao"],
			"dataInicio" => $dataInicio,
			"dataFim" => $dataFim,
			"observacao" => $_POST["Obs"],
			"comoConheceu" => $_POST["ComoConheceu"]
		);
		
		$agenda->salvar($dados, (int)$_REQUEST["id"]);
		
		if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) :
			$html = '<html><body onload="alert(\'Dados atualizados com sucesso!\'); document.location.href=\'agenda.php\'"></body></html>';
		else :
			$html = '<html><body onload="alert(\'Dados cadastrados com sucesso!\'); document.location.href=\'agenda.php\'"></body></html>';
		endif;
		echo $html;
	break;
	
	case "excluir":
		$conexao->setDebug(true);
		if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) && is_int($_REQUEST["id"])) {
			$id = $_REQUEST["id"];
		}
		if ($conexao->excluirPorId(_TABLE_PREFIX . "agenda", $id)) {
			echo Util::toJson(true); 
		}
	break;
endswitch;

$conexao->desconectar();
