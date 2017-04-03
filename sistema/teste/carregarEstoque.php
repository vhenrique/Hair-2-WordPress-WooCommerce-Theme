<?php

require_once("../init.php");

// abre conexão com o banco
$conexao = new Conexao();
$estoque = new Estoque();
$estoque->setPrefixo(_TABLE_PREFIX);

$itensDoEstoque = $estoque->carregarItens();
$conexao->desconectar();

$html = '<select name="Opcoes" onclick="selecionaOpcao()" style="width:500px;" size="15">';
foreach ($itensDoEstoque as $item) :
	$unidade = ($item->Unidade == "G") ? "gramas" : "tufos" ;
	$html .= '<option value="' . $item->estoque_id . '">ID: ' . $item->estoque_id . '| Cor: ' . $item->cor . ' | Tipo: ' . $item->tipo . ' | Cm: ' . $item->comprimento . ' | Quantidade: ' . $item->Quantidade . " " . $unidade . '</option>';
endforeach;
$html .= "</select>";
echo utf8_encode($html);

	/*
	include "kernel.martha_sys.inc.php";
	$produtos = getEstoque();
	$resposta = "<center>Nenhum registro encontrado.</center>";	
	if($produtos) { 
		$resposta = "<select style=\"width:500px\" size=\"15\" name=\"Opcoes\" onClick=\"selecionaOpcao();\">\n";
		foreach($produtos as $produto) {
			$id = $produto["Id"];	
			$cor = $produto["Cor"];	
			$tipo = $produto["Tipo"];	
			$tufos = $produto["Tufos"];	
			$valor = $produto["Valor"];
			$comprimento = $produto["Comprimento"];
			$resposta .= "\t<option value=\"" . $id . "\">ID: " . $id . " - " . $cor . " - " . $tipo . " - " . $comprimento . "cm -  Em estoque: " . $tufos . "</option>\n";
		}
		$resposta .= "</select> ";
	}
	echo utf8_encode($resposta);
	*/
?>