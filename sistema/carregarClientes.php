<?php
	include "kernel.martha_sys.inc.php";
	$clientes = getClientes();
	if($clientes) { 
		$resposta = "<select style=\"width:350px\" size=\"10\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($clientes as $cliente) {
			$nome = $cliente["Nome"] . " " . $cliente["Sobrenome"];	
			$id = $cliente["Id"];	
			$resposta .= "\t<option value=\"" . $id . "\">" . $nome . "</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
?>