<?php
	include "kernel.martha_sys.inc.php";
	$funcionarios = getFuncionarios();
	
	if($funcionarios) { 
	
		$resposta = "<select style=\"width:350px\" size=\"10\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($funcionarios as $funcionario) {
			$nome = $funcionario["Nome"] . " " . $funcionario["Sobrenome"];	
			$id = $funcionario["Id"];	
			$resposta .= "\t<option value=\"" . $id . "\">" . $nome . "</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
?>