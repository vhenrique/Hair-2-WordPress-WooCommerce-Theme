<?php

class Conexao {
	
	const   MENSAGEM_ERRO = "Ops! Ocorreu um erro";
	
	private $host    = MYSQL_HOST;
	private $usuario = MYSQL_USUARIO;
	private $senha   = MYSQL_SENHA;
	private $banco   = MYSQL_BANCO;
	public  $conexao;
	public  $query;
	public  $resultado;
	public  $debug   = false;
	public  $prefixo = "teste";
	
	/**
	 * construtor da classe
	 * respons�vel por abrir uma conex�o caso j� n�o exista uma aberta
	 * Obs.: uma conex�o sempre deve ser aberta inicialmente e pode ser reutilizada passando-a no construtor da classe
	 * 
	 * @param resource conexao - conex�o j� aberta
	 * @return - abre uma conex�o com o banco ou apenas retorna a conex�o existente
	 */
	public function __construct($conexao = NULL) {
		if (!is_null($conexao) ) {
			$this->conexao = $conexao;
		} else {
			$this->conectar();
		}
	}
	
	/**
	 * realiza conex�o
	 *
	 * @return boolean - retorna TRUE caso a conex�o foi aberta com sucesso ou FALSE em caso de erro
	 */
	public function conectar() {
		// verifica se a conex�o foi realizada com sucesso
		if ( ($this->conexao = mysql_connect(MYSQL_HOST, MYSQL_USUARIO, MYSQL_SENHA)) !== false ) {
			// seleciona o banco a ser utilizado pela conex�o
			if (mysql_select_db(MYSQL_BANCO, $this->conexao)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	 * executa uma query
	 *
	 * o m�todo j� � respons�vel por realizar tratamentos nos caracteres que s�o informados,
	 * evitando a inser��o de conte�do indesejado
	 *
	 * @param String query - query a ser executada
	 * @return array - retorna um array de objetos casos algum registro seja encontrado
	 */
	public function executarQuery($query, $list = true) {
		$this->query = addslashes($query);
		if ($this->debug == true) {
			echo "<pre style='border:1px solid #999; background:#000; color:#FFF; padding:10px'>" . $query . "</pre>";
		}
		if ($this->resultado = mysql_query($query)) {
			$resultado = $this->resultado;
			
			if ($list == true) {
				$lista = array();		
				while ($rs = mysql_fetch_assoc($resultado)) {
					$lista[] = (object)$rs;
				}
				return $lista;
			} else {
				if (mysql_num_rows($resultado) == 0) {
					return false;
				} elseif (mysql_num_rows($resultado) == 1) {
					return (object)mysql_fetch_assoc($resultado);
				}
			}
		} else {
			echo "<!--" . mysql_error() . "-->";
			$this->desconectar();
			exit(self::MENSAGEM_ERRO);
		}
	}

	/**
	 * carregas todos os registros da tabela informada, limitando o resultado caso solicitado
	 *
	 * @param String tabela - nome da tabela a ser consultada
	 * @param Integer maximoResultados - caso informado, limita o n�mero de resultados
	 * @return array - retorna uma lista com todos os registros encontrados
	 */
	public function carregarTodos($tabela, $maximoResultados = NULL) {
		$query = "
			SELECT *
			FROM " . $tabela;
		if (!is_null($maximoResultados)) {
			$query .= "
			LIMIT " . $maximoResultados;
		}
		return $this->executarQuery($query);
	}
	
	public function carregarPorId($tabela, $id) {
		$query = "
			SELECT *
			FROM " . $tabela . "
			WHERE
				id = " . (int) $id;
		return $this->executarQuery($query, false);
	}
	
	public function excluirPorId($tabela, $id) {
		$query = "
			DELETE FROM " . $tabela . "
			WHERE
				Id = " . (int) $id . "
			LIMIT
				1
		";
		return mysql_query($query);
	}
	
	public function setDebug($debug) {
		$this->debug = $debug;
	}
	
	public function getPrefixo() {
		return $this->prefixo;
	}
	
	public function setPrefixo($prefixo) {
		$this->prefixo = $prefixo;
	}
	
	/**
	 * encerra a conex�o com o banco
	 */
	public function desconectar() {
		return mysql_close($this->conexao);
	}
}