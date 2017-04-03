<?php
	include "kernel.martha_sys.inc.php";
	$regs = getFornecedores();
	$resposta = "<center>Nenhum registro encontrado.</center>";
	if($regs) { 
		$resposta = "<select style=\"width:500px\" size=\"15\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($regs as $reg) {
			$nome = $reg["Nome"];
			$ramo = $reg["Ramo"];	
			$telefone = $reg["Telefone"];
			$id = $reg["Id"];	
			$resposta .= "\t<option value=\"" . $id . "\">" . $nome . " :: " . $ramo . " (" . $telefone . ")</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
?>