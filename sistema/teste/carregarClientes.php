<?php
	include "kernel.martha_sys.inc.php";
	$clientes = getClientes();
	$resposta = "<center>Nenhum registro encontrado.</center>";
	if($clientes) { 
		$resposta = "<select style=\"width:500px\" size=\"15\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($clientes as $cliente) {
			$nome = $cliente["Nome"] . " " . $cliente["Sobrenome"];	
			$celular = $cliente["Celular"];
			$telefone = $cliente["Telefone"];
			$id = $cliente["Id"];	
			$resposta .= "\t<option value=\"" . $id . "\">" . $nome . " (" . $telefone . " / " . $celular . ")</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
?>