<?php
/*
# Biblioteca com as funções e constantes de uso comum aos scripts do site www.marthahair.com.br
#
#
#
*/

include "config.martha_sys.inc.php";



/*
 aqui vai varrer todos os REQUEST,POST e GET e jogar o seu valor para
 função limpa_sqlinjection, e retornar para o proprio REQUEST,POST e GET.

*/
unset($_REQUEST);
foreach ($_GET as $index=>$valor){
	$_GET[$index] = limpa_sqlinjection($valor);
}
foreach ($_POST as $index=>$valor){
	if($index!="Conteudo")
		$_POST[$index] = limpa_sqlinjection($valor);
}

function limpa_sqlinjection($var){
	$bl = array('*','--','=','select','insert','update','delete','where','join','left','inner','like','truncate','drop','create','alter','delimeter');
	foreach($bl as $w)
		if(strripos($var,$w)!==false) {
			JSLocation("http://www.clinicamarthahair.com.br/sistema");
		}
	return $var;
}


function connect() {
	$conexao = mysql_connect(_DB_LOCATION,_DB_USER,_DB_PASS) or die ("Impossível conectar ao servidor remoto.");
	$db = mysql_select_db(_DB_NAME) or die ("Não foi possível conectar ao banco " . $db_name . "." . mysql_error());
	return $db;
}

function disconnect() {
	mysql_close();
}

function tryLogin($user,$pass) {
//	$allowed = "1234567890_qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM"
	connect();
	$query = mysql_query("SELECT Id, Email,Senha FROM " . _TABLE_PREFIX . "usuarios WHERE (Email = '$user') AND (Senha = '$pass')");
	echo mysql_error();
	if(mysql_num_rows($query) > 0) {
		session_start();
		$_SESSION["logged"] = true;
		$reg = mysql_fetch_assoc($query);
		$_SESSION["idUser"] = $reg["Id"];
		$_SESSION["user"] = $reg["Email"];
		$_SESSION["pass"] = $reg["Senha"];
	} else {
		$_SESSION["logged"] = false;
	}
	disconnect();
	return $_SESSION["logged"];
}

function isLogged() {
	session_start();
	$_SESSION["logged"] = false;
	return tryLogin($_SESSION["user"],$_SESSION["pass"]);
}

function Nivel($n) {
	if(getUser("Nivel")>$n)
		die("Usuário sem permissão.");	
}

function deleteEntryById($id,$table) {
	connect();
	mysql_query("DELETE FROM $table WHERE Id = $id LIMIT 1");
	disconnect();
}

function getUser($oque) {
	connect();
	$user = $_SESSION["user"];
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "usuarios WHERE Email = '$user'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg[$oque];
}

function getUsuario2($id,$oque) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "usuarios WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg[$oque];
}

function getUsuario($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "usuarios WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getUsuarios() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "usuarios");
	unset($usuarios);
	while($usuario = mysql_fetch_assoc($query)) {
		$usuarios[] = $usuario; 
	}
	return $usuarios;
	disconnect();
}

function getFuncionario($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "funcionarios WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getContrato($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "contratos WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getAgendaFuncionario($id_funcionario,$d1,$d2) {
	$d1 = formatDate($d1);
	$d2 = formatDate($d2);
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "agenda WHERE (HoraInicio BETWEEN '$d1 00:00:00' and '$d2 23:59:59') AND (IdFuncionario = $id_funcionario)");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getCliente($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "clientes WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getFornecedor($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "fornecedores WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getProduto($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "produtos WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getEstoqueItem($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "estoque WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getCompromisso($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "agenda WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getOrcamento($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "orcamentos WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getReceita($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "receitas WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getDespesa($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "despesas WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getMovimentacao($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes WHERE Id = '$id'");
	echo mysql_error();
	$reg = mysql_fetch_assoc($query);
	disconnect();
	return $reg;
}

function getAll($tabela) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "$tabela");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	disconnect();
	return $regs;
}

function getFuncionarios() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "funcionarios ORDER BY Nome ASC");
	unset($funcionarios);
	while($funcionario = mysql_fetch_assoc($query)) {
		$funcionarios[] = $funcionario; 
	}
	return $funcionarios;
	disconnect();
}


function getClientes() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "clientes ORDER BY Nome ASC");
	unset($clientes);
	while($cliente = mysql_fetch_assoc($query)) {
		$clientes[] = $cliente; 
	}
	return $clientes;
	disconnect();
}

function getFornecedores() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "fornecedores ORDER BY Nome ASC");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getContas() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes ORDER BY Conta ASC");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg['Conta']; 
	}
	return array_unique($regs);
	disconnect();
}

function getProdutos() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "produtos");
	unset($produtos);
	while($produto = mysql_fetch_assoc($query)) {
		$produtos[] = $produto; 
	}
	return $produtos;
	disconnect();
}

function getEstoque() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "estoque");
	unset($estoque);
	while($produto = mysql_fetch_assoc($query)) {
		$estoque[] = $produto; 
	}
	return $estoque;
	disconnect();
}

function getOrcamentos() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "orcamentos");
	unset($orcamentos);
	while($orcamento = mysql_fetch_assoc($query)) {
		$orcamentos[] = $orcamento; 
	}
	return $orcamentos;
	disconnect();
}

function getReceitas() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "receitas");
	unset($receitas);
	while($receita = mysql_fetch_assoc($query)) {
		$receitas[] = $receita; 
	}
	return $receitas;
	disconnect();
}

function getHistoricoEstoque($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "receitas WHERE IdTufos = $id");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getHistoricoCliente($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "receitas WHERE IdCliente = $id");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getContratosCliente($id) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "contratos WHERE IdCliente = $id");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getReceitasPeriodo($d1,$d2,$caixa) {
	$d1 = formatDate($d1);
	$d2 = formatDate($d2);
	connect();
	if($caixa == '')
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "receitas WHERE DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59'");
	else
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "receitas WHERE (DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59') AND Caixa = '$caixa'");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}
function getMovimentacoesQuitadas($d1,$d2,$tipo,$caixa) {
	$d1 = formatDate($d1);
	$d2 = formatDate($d2);
	unset($filtro);
	if($tipo!='')
		$filtro[] = "(Tipo = '$tipo')";
	if($caixa!='')
		$filtro[] = "(Caixa = '$caixa')";
	if(sizeof($filtro)!=0) 
		$filtro = implode(' AND ',$filtro);
	else
		$filtro = '';	
	connect();
	if($filtro == '')
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes WHERE Quitado = 1 AND (DataQuitacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59')");
	else
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes WHERE Quitado = 1 AND (DataQuitacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59') AND " . $filtro);
	echo mysql_error();
//	die("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes WHERE Quitado = 1 AND (DataQuitacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59') AND " . $filtro);
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getMovimentacoesPeriodo($d1,$d2,$tipo,$caixa) {
	$d1 = formatDate($d1);
	$d2 = formatDate($d2);
	unset($filtro);
	if($tipo!='')
		$filtro[] = "(Tipo = '$tipo')";
	if($caixa!='')
		$filtro[] = "(Caixa = '$caixa')";
	if(sizeof($filtro)!=0) 
		$filtro = implode(' AND ',$filtro);
	else
		$filtro = '';	
	connect();
	if($filtro == '')
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes WHERE ParcVenc BETWEEN '$d1 00:00:00' and '$d2 23:59:59'");
	else
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes WHERE (ParcVenc BETWEEN '$d1 00:00:00' and '$d2 23:59:59') AND " . $filtro);
	echo mysql_error();
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getParcelas($id_pai) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes WHERE IdPai = $id_pai");
	echo mysql_error();
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getParcelasReceita($id_pai) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "movimentacoes WHERE IdPai = $id_pai AND Tipo = 'receita'");
	echo mysql_error();
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getDespesas() {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "despesas ORDER BY Id ASC");
	unset($despesas);
	while($despesa = mysql_fetch_assoc($query)) {
		$despesas[] = $despesa; 
	}
	disconnect();
	return $despesas;
}

function getDespesasPeriodo($d1,$d2,$caixa) {
	$d1 = formatDate($d1);
	$d2 = formatDate($d2);
	connect();
	if($caixa == '')
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "despesas WHERE DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59'");
	else
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "despesas WHERE (DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59') AND Caixa = '$caixa'");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getComissoesPeriodo($d1,$d2,$caixa) {
	$d1 = formatDate($d1);
	$d2 = formatDate($d2);
	connect();
	if($caixa == '')
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "comissoes WHERE DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59' ORDER BY DataTransacao ASC");
	else
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "comissoes WHERE DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59'  AND Caixa = '$caixa' ORDER BY DataTransacao ASC");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getValesPeriodo($d1,$d2,$caixa) {
	$d1 = formatDate($d1);
	$d2 = formatDate($d2);
	connect();
	if($caixa == '')
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "vales WHERE DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59' ORDER BY DataTransacao ASC");
	else
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "vales WHERE (DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59') AND Caixa = '$caixa' ORDER BY DataTransacao ASC");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function getEstoquePeriodo($d1,$d2,$caixa) {
	$d1 = formatDate($d1);
	$d2 = formatDate($d2);
	connect();
	if($caixa == '')
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "receitas WHERE DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59' ORDER BY DataTransacao ASC");
	else
		$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "receitas WHERE (DataTransacao BETWEEN '$d1 00:00:00' and '$d2 23:59:59') AND Caixa = '$caixa' ORDER BY DataTransacao ASC");
	unset($regs);
	while($reg = mysql_fetch_assoc($query)) {
		$regs[] = $reg; 
	}
	return $regs;
	disconnect();
}

function logout() {
	session_start();
	session_unset();
	session_destroy();
}

function insertData($data,$table) {
	$sql_campos = "(";
	$sql_valores = "(";
	foreach($data as $nome_campo => $valor_campo) {
		$sql_campos .= $nome_campo . ",";
		$sql_valores .= "\"$valor_campo\",";
	}			
	$sql_campos{strlen($sql_campos)-1} = ")";
	$sql_valores{strlen($sql_valores)-1} = ")";
	$query = mysql_query("INSERT INTO $table $sql_campos VALUES $sql_valores");
	echo mysql_error();
	return $query;
}

function updateData($id,$data,$table) {
	$query = "";
	foreach($data as $nome_campo => $valor_campo) {
		$query .= $nome_campo . " = " . "\"$valor_campo\",";
	}
	$query{strlen($query)-1} = " ";
	$query = "UPDATE $table SET " . $query . " WHERE Id = $id";
	mysql_query($query);			
	echo mysql_error();
	return $query;
}

function exist($value,$field,$table) {
	$query = mysql_query("select * from $table where $field like '$value'");
	if(mysql_num_rows($query))
		$r = TRUE;
	else
		$r = FALSE;
	$r=false;
	return $r;
}

function getIP() {
	return $_SERVER['REMOTE_ADDR'];
}

function setTimeLast($email) {
	$time = time();
	$sql = mysql_query("update usuarios set time_ultimo = '$time'");
}

function saveUploadedImage($tmp_name,$name) {
	$success = true;
	$dir = "imagens/";
	if(!move_uploaded_file($tmp_name, $dir . $name)) {
		$success = false;
	}
	return $success;
}



function JSAlert($msg) {
?>
	<script>
		alert('<?=$msg?>');
	</script>
<?php
}

function JSBack() {
?>
	<script>
		history.go(-1);
	</script>
<?php
}

function JSLocation($loc) {
?>
	<script>
		window.location = '<?=$loc?>';
	</script>
<?php
}

function sendMail($array) {
    $from = urldecode($array["NomeRemetente"]);
    if (eregi("(\r|\n)", $from)) {
      die("Why ?? :(");
    }
    $from = urldecode($array["EmailRemetente"]);
    if (eregi("(\r|\n)", $from)) {
      die("Why ?? :(");
    }

	$header = "From: " . $array["NomeRemetente"] . " <" . $array["EmailRemetente"] . ">\r\n";
	$header .= "X-Mailer: PHP/" . phpversion();
	$msg = $array["Mensagem"] . "\n\nEnviado por " . $array["NomeRemetente"] . "\nEmail: " . $array["EmailRemetente"] . "\nTelefone: " . $array["Telefone"];
	
	return mail("bernardoalcalde@gmail.com",$array["Assunto"],$msg,$header);
}

function formatDate($date) {
	$a = explode("/",$date);
	return $a[2] . "-" . $a[1] . "-" . $a[0]; 
}

function buscaFinanceira($array) {
	$hoje = date("Y-m-d H:i:s",time());
	extract($array);
	$data_inicio = formatDate($data_inicio);
	$data_fim = formatDate($data_fim);				

	//receitas
	if($receitas!='0') {
		$sql = "SELECT * FROM " . _TABLE_PREFIX . "movimentacoes";
		unset($ifs);
		$ifs[] = "(Tipo = 'receita')";
		switch($receitas) {
			case "quitadas": 
				$ifs[] = "(Quitado = '1')";
				break;			
			case "futuras": 
				$ifs[] = "(Quitado = '0' AND (ParcVenc >= '$hoje'))";
				break;			
			case "atrasadas": 
				$ifs[] = "(Quitado = '0' AND (ParcVenc < '$hoje'))";
				break;			
		}
		
		if($data_inicio != "" && $data_fim != "") {
			$ifs[] = "(ParcVenc BETWEEN '$data_inicio' AND '$data_fim')";
		}		

		if($IdCliente != "") {
			$ifs[] = "(IdCliente = $IdCliente)";
		}		

		if($Caixa != "") {
			$ifs[] = "(Caixa = '$Caixa')";
		}		

		if($FormaPgto != "") {
			$ifs[] = "(FormaPgto = '$FormaPgto')";
		}		

		$clauses = "";
		if(isset($ifs)) {
			$sql.=  " WHERE ";
			$clauses = implode(' AND ',$ifs);
		}
		$sql = $sql . $clauses . " ORDER BY ParcVenc ASC";
		$query = mysql_query($sql);
		unset($regs);
		while($reg=mysql_fetch_assoc($query)) {
			$regs[] = $reg;
		}
	}
	
	//despesas
	if($despesas!='0') {
		$sql = "SELECT * FROM " . _TABLE_PREFIX . "movimentacoes";
		unset($ifs);
		$ifs[] = "((Tipo = 'despesa') OR (Tipo = 'vale'))";
		switch($despesas) {
			case "quitadas": 
				$ifs[] = "(Quitado = '1')";
				break;			
			case "futuras": 
				$ifs[] = "(Quitado = '0' AND (ParcVenc >= '$hoje'))";
				break;			
			case "atrasadas": 
				$ifs[] = "(Quitado = '0' AND (ParcVenc < '$hoje'))";
				break;			
		}

		if($IdFornecedor != "") {
			$ifs[] = "(IdFornecedor = $IdFornecedor)";
		}		

		if($Conta != "") {
			$ifs[] = "(Conta = '$Conta')";
		}		

		if($Caixa != "") {
			$ifs[] = "(Caixa = '$Caixa')";
		}		

		if($FormaPgto != "") {
			$ifs[] = "(FormaPgto = '$FormaPgto')";
		}		

		if($data_inicio != "" && $data_fim != "") {
			$ifs[] = "(ParcVenc BETWEEN '$data_inicio' AND '$data_fim')";
		}		
		$clauses = "";
		if(isset($ifs)) {
			$sql.=  " WHERE ";
			$clauses = implode(' AND ',$ifs);
		}
		$sql = $sql . $clauses . " ORDER BY ParcVenc ASC";
		$query = mysql_query($sql);
		while($reg=mysql_fetch_assoc($query)) {
			$regs[] = $reg;
		}	
	}
	return $regs;
}


function getServicos($IdReceita) {
	connect();
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "comissoes WHERE IdReceita = $IdReceita");
	unset($regs);
	while($r = mysql_fetch_array($query)) {
		$regs[] = $r;
	}
	return $regs;
}

function buscaHistoricoFuncionario($id_funcionario,$caixa,$data_inicio,$data_fim) {
	$data_inicio = formatDate($data_inicio);
	$data_fim = formatDate($data_fim);
	$filtro_caixa = $caixa=="" ? ""	: " AND Caixa = '$caixa'";			
	unset($result);
	//receita
	
	//comissões
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "comissoes WHERE IdFuncionario = $id_funcionario AND (DataTransacao BETWEEN '$data_inicio' AND '$data_fim')" . $filtro_caixa);
	echo mysql_error();
	$result['num_atendimentos'] = mysql_num_rows($query);
	$acum_atendimentos = 0;
	$acum = 0;
	$deducao = 0;
	while($r = mysql_fetch_array($query)) {
		$acum += $r['Valor'];
		$acum_atendimentos += $r['ServValor'];
		if($r['Caixa']=='Estética') {
			$parcs = getParcelas($r['IdReceita']);
			if(substr($parcs[0]['FormaPgto'],0,11)=="Cartão de D") 
				$deducao += 0;
		}	
	}	
	$result['total_comissoes'] = $acum;	
	$result['total_atendimentos'] = $acum_atendimentos;	
	
	//vales
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "vales WHERE IdFuncionario = $id_funcionario AND (DataTransacao BETWEEN '$data_inicio' AND '$data_fim')" . $filtro_caixa);
	$result['num_vales'] = mysql_num_rows($query);
	$acum = 0;
	unset($r);
	while($r = mysql_fetch_array($query)) 
		$acum += $r['Total'];
	$result['total_vales'] = $acum;	
	$result['id_funcionario'] = $id_funcionario;
	$result['total_deducoes'] = $deducao;
	return $result;
}

function isConflitoAgenda($id_funcionario) {
	connect();
	$is_conflito = 0;
	$query = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "agenda WHERE IdFuncionario = $id_funcionario");
	while($reg = mysql_fetch_assoc($query)) {
		extract($reg);
		$query2 = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "agenda WHERE ((HoraInicio BETWEEN '$HoraInicio' and '$HoraFim') OR (HoraFim BETWEEN '$HoraInicio' and '$HoraFim')) AND IdFuncionario = $id_funcionario");
		if(mysql_num_rows($query2)>1) {
			$is_conflito = 1;
		}
	}
	disconnect();
	return $is_conflito;
}

?>
