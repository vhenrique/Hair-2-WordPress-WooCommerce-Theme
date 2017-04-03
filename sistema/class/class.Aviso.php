<?php

class Aviso extends Conexao {
	
	public function carregarTodos($data = null) {
		
		$query = "
			SELECT
				a.Id AS aviso_id, a.Tipo AS tipo, a.Descricao AS descricao, DATE_FORMAT(a.Data, '%d/%m/%Y') AS data, a.DataCadastro AS dataCadastro,
				CONCAT(c.Nome, ' ', c.Sobrenome) AS cliente 
			FROM
				" . $this->getPrefixo() . "avisos a
				JOIN " . $this->getPrefixo() . "clientes c ON c.Id = a.IdCliente
			WHERE
				Data > NOW() ";
							
			$query .= "
			ORDER BY
				a.Data ASC
		";
		return  $this->executarQuery($query);
	}
}