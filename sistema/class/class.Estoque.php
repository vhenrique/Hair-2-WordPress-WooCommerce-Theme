<?php

class Estoque extends Conexao {
	
	public function carregarItens($idEstoque = null) {
		
		$query = "
			SELECT
				e.Id AS estoque_id, e.Comprimento AS comprimento, e.Quantidade, e.Unidade, e.Obs AS observacao,
				c.nome AS cor,
				t.nome AS tipo
			FROM
				" . $this->getPrefixo() . "estoque e
				JOIN cabelo_cor c ON c.id = e.IdCor
				JOIN cabelo_tipo t ON t.id = e.IdTipo
			WHERE
				e.Quantidade > 0";
		
		if (!is_null($idEstoque)) :
			$query .= "
				AND e.Id = " . (int) $idEstoque;
		endif;
		return  $this->executarQuery($query);
	}
	
	public function carregarPorId($idEstoque) {
		$item = $this->carregarItens($idEstoque);
		return current($item);
	}
	
	public function atualizarEstoque($idEstoque, $quantidade) {
		$query = "
			UPDATE
				" . $this->getPrefixo() . "estoque
			SET
				Quantidade = " . $quantidade . "
			WHERE
				Id = " . (int) $idEstoque . "
			LIMIT 
				1";
		return mysql_query($query);
	}
}