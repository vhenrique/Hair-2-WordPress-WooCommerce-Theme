<?php
	include "kernel.martha_sys.inc.php";
	$orcamentos = getOrcamentos();
	$resposta = "<center>Nenhum registro encontrado.</center>";	
	if($orcamentos) { 
		$resposta = "<select style=\"width:500px\" size=\"15\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($orcamentos as $orcamento) {
			$usuario = getUsuario($orcamento["IdUsuario"]);	
			$cliente = getCliente($orcamento["IdCliente"]);
			$usuario = $usuario["Email"];
			$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"];	
			$valor = $orcamento["Total"];
	
			$id = $orcamento["Id"];	
			$resposta .= "\t<option value=\"" . $id . "\">" . $cliente . " - R$ " . $valor . " (" . $usuario . ")</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
?>