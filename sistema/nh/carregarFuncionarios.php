<?php
	include "kernel.martha_sys.inc.php";
	$funcionarios = getFuncionarios();
	$resposta = "<center>Nenhum registro encontrado.</center>";
	if($funcionarios) { 
		$resposta = "<select style=\"width:500px\" size=\"15\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($funcionarios as $funcionario) {
			$nome = $funcionario["Nome"] . " " . $funcionario["Sobrenome"];	
			$id = $funcionario["Id"];	
			$celular = $funcionario["Celular"];
			$telefone = $funcionario["Telefone"];
			$resposta .= "\t<option value=\"" . $id . "\">" . $nome . " (" . $telefone . " / " . $celular . ")</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
?>