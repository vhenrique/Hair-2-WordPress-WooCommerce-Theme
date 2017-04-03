<?php

class Agenda extends Conexao {
	
	public function carregarPorData($data, $idFuncionario = 0) {
		
		$query = "
			SELECT
				a.Id AS agenda_id, a.Descricao AS descricao, DATE_FORMAT(a.HoraInicio, '%H:%i') AS hora, DATE_FORMAT(a.HoraInicio, '%d/%m/%Y') AS dia, a.HoraFim, a.Obs AS observacao, a.DataCadastro AS dataCadastro, a.ComoConheceu AS comoConheceu,
				CONCAT(c.Nome, ' ', c.Sobrenome) AS cliente,
				CONCAT(f.Nome, ' ', f.Sobrenome) AS funcionario 
			FROM
				" . $this->getPrefixo() . "agenda a
				JOIN " . $this->getPrefixo() . "clientes c ON c.Id = a.IdCliente
				JOIN " . $this->getPrefixo() . "funcionarios f ON f.Id = a.IdFuncionario
			WHERE
				DATE_FORMAT(a.HoraInicio, '%Y-%m-%d') = '" . $data . "'";
				
			if ($idFuncionario > 0) {
				$query .= "
				AND a.IdFuncionario = " . (int) $idFuncionario;	
			}
			
			$query .= "
			ORDER BY
				a.HoraInicio ASC
		";
		return  $this->executarQuery($query);
	}
	
	public function salvar($dados, $id = null) {
		if ( !is_null($id) && is_int($id) && ($id > 0) ) :
			$query = "
				UPDATE 
					" . $this->getPrefixo() . "agenda
				SET
					IdFuncionario = '" . $dados->idFuncionario . "',
					IdCliente = '" . $dados->idCliente . "',
					Descricao = '" . $dados->descricao . "',
					HoraInicio = '" . $dados->dataInicio . "',
					HoraFim = '" . $dados->dataFim . "',
					Obs = '" . $dados->observacao . "',
					ComoConheceu = '" . $dados->comoConheceu . "'
				WHERE
					id = " . $id;
		else :
			$query = "
				INSERT INTO " . $this->getPrefixo() . "agenda
					(IdFuncionario, IdCliente, Descricao, HoraInicio, HoraFim, Obs, DataCadastro, IdUsuario, ComoConheceu) 
				VALUES 
					(" . $dados->idFuncionario . ", " . $dados->idCliente . ", '" . $dados->descricao . "', '" . $dados->dataInicio . "', '" . $dados->dataFim . "', '" . $dados->observacao . "', NOW(), 0, '" . $dados->comoConheceu . "' )";
		endif;
		return mysql_query($query);
	}
}
