<?php
	include "kernel.martha_sys.inc.php";
	$produtos = getProdutos();
	$resposta = "<center>Nenhum registro encontrado.</center>";	
	if($produtos) { 
		$resposta = "<select style=\"width:500px\" size=\"15\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($produtos as $produto) {
			$nome = $produto["Nome"];	
			$ref = $produto["Referencia"];	
			$valor = $produto["Valor"];
			$id = $produto["Id"];	
			$resposta .= "\t<option value=\"" . $id . "\">" . $nome . " (REF. " . $ref . ") - R$ " . $valor . "</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
?>