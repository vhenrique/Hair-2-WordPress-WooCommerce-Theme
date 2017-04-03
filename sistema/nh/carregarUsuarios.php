<?php
	include "kernel.martha_sys.inc.php";
	$usuarios = getUsuarios();
	$resposta = "<center>Nenhum registro encontrado.</center>";	
	if($usuarios) { 
		$resposta = "<select style=\"width:500px\" size=\"15\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($usuarios as $usuario) {
			$nome = $usuario["Nome"];	
			$id = $usuario["Id"];	
			$resposta .= "\t<option value=\"" . $id . "\">" . $nome . "</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
?>