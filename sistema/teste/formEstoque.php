<?php

require_once("../init.php");

// abre conexão com o banco
$conexao = new Conexao();

$cores = $conexao->carregarTodos("cabelo_cor");
$tipos = $conexao->carregarTodos("cabelo_tipo");

$conexao->desconectar();

	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);
	
	if(isset($_GET["acao"]) && ($_GET["acao"]=="edita")) {
		if(isset($_POST["Opcoes"])) 
			$id = $_POST["Opcoes"];
		else
			$id = $_GET["id"];
		$edita=true;
		$produto = getEstoqueItem($id);
		extract($produto);
  	    $DataEntrada = strtotime($DataEntrada)!=0 ? date("d/m/Y", strtotime($DataEntrada)) : "";		
	}
	else
		$edita=false;


?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<script type="text/javascript" src="javascript_martha.js"></script>
<script language="javascript">
function validaMonetario(obj) {
	var validos="0123456789";
	var valor = obj.value;
	for(i=0;i<obj.value.length;i++) 
		if(validos.indexOf(obj.value.charAt(i))==-1) {
			obj.value = obj.value.replace(obj.value.charAt(i),'');
		}

	valor = obj.value;
	
	if(valor.length<3) {
		var n = 3-valor.length;
		for(i=1;i<=n;i++)
			valor = '0' + valor;
	} else {
		if(valor.length>3 && valor.charAt(0) == '0' )
			valor = valor.replace(valor.charAt(0),'');
	}
	
	var ini = valor.substring(0,valor.length-2);
	var fim = valor.substring(valor.length-2);
	//obj.value = '';
	var valor = ini + '.' + fim;
	obj.value = valor;
}

</script>

<link rel="stylesheet" href="martha_sys.css" type="text/css">

<link href="/sistema/css/smoothness/jquery-ui-1.10.1.custom.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="/sistema/js/jquery-ui-1.10.1.custom.js"></script>

<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
</script>
</head>
<body bgcolor="#AC94B6">
<h3 class="titulo_secao">
<?php
	if($edita)
		echo "Editar Estoque";
	else
		echo "Cadastrar Estoque";		
?>
</h3>
<form action="<?php if($edita) 
					echo "editar.php?id=" . $id . "&tabela=estoque"; 
				else
					echo "cadastrar.php?tabela=estoque"; 
			?>" method="post">
<table class="cadastrar">
<?php if($edita) { ?>
<tr>
	<td class="formulario">Id:</td>
	<td><?=$Id?></td>
</tr>
<?php } ?>
<tr>
	<td class="formulario">Cor:</td>
	<td>
    	<select name="IdCor">
        	<?php foreach ($cores as $cor) : ?>
            <option value="<?php echo $cor->id; ?>" <?php if($IdCor == $cor->id) : ?>selected="selected" <?php endif; ?>><?php echo $cor->nome; ?></option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>
<tr>
	<td class="formulario">Tipo:</td>
	<td>
    	<select name="IdTipo">
        	<?php foreach ($tipos as $tipo) : ?>
            <option value="<?php echo $tipo->id; ?>" <?php if($IdTipo == $tipo->id) : ?>selected="selected" <?php endif; ?>><?php echo $tipo->nome; ?></option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>
<tr>
	<td class="formulario">Comprimento:</td>
	<td>
    	<select name="Comprimento">
			<?php for ($i=1;$i<=60;$i++) : ?>
			<option value="<?php echo $i?>" <?php if($Comprimento == $i) : ?>selected="selected" <?php endif; ?>><?php echo $i?>cm</option>
			<?php endfor; ?>
      	</select>
    </td>
</tr>
<?php if($edita) { ?>
<?php } ?>
<tr>
  <td class="formulario">Unidade:</td>
  <td>
  	<select name="Unidade">
    	<option value="T" <?php if($Unidade == "T") : ?>selected="selected" <?php endif; ?>>Tufos</option>
        <option value="G" <?php if($Unidade == "G") : ?>selected="selected" <?php endif; ?>>Gramas</option>
    </select>
  </td>
</tr>
<tr>
  <td class="formulario">Quantidade:</td>
  <td><input type="text" name="Quantidade" size="10" <?php if($edita) : ?>value="<?php echo $Quantidade; ?>" <?php endif; ?>></td>
</tr>
<tr>
  <td class="formulario">Data de entrada:</td>
  <td>
    <input name="DataEntrada" type="text" id="datepicker" size="30" <?php if($edita) : ?>value="<?php echo $DataEntrada; ?>"<?php endif; ?> />
    </td>
</tr>
<tr>
	<td class="formulario">Obs:</td>
	<td><textarea name="Obs" cols="20" rows="4"><?php if($edita) {	echo $Obs;} ?></textarea></td>
</tr>
<tr>
	<td colspan="2">
		<input type="submit" value="Enviar">
	</td>
</tr>
</table>
<?php if($edita) { ?>
<h3 class="titulo_secao">Histórico do item</h3><br>
Quantidade inicial: <?=$TufosInicial?><br>
<?php
	$hist = getHistoricoEstoque($Id);
	if(sizeof($hist)>0) { 
?>
<table>
	<tr>
		<td class="formulario"><b>Data</b></td>
		<td class="formulario"><b>Comanda</b></td>
		<td class="formulario"><b>Cliente</b></td>
		<td class="formulario"><b>Quantidade</b></td>
	</tr>
<?php
		$acum = 0;
		foreach($hist as $h) {
			extract($h);
			$acum += $QtdeTufos;
			$cliente = getCliente($IdCliente);
			$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
?>
	<tr>
		<td class="formulario"><?=date("d/m/Y", strtotime($DataTransacao))?></td>
		<td class="formulario"><?=$NumComanda?></td>
		<td class="formulario"><?=$cliente?></td>
		<td class="formulario" align="right"><?=$QtdeTufos?></td>
	</tr>
<?php			
		}
?>
	<tr>
		<td class="formulario" align="right" colspan="3"><b>Total utilizado: </b></td>	
		<td class="formulario" align="right"><b><?=$acum?></b></td>	
	</tr>
	<tr>
		<td class="formulario" align="right" colspan="3"><b>Estoque estimado (inicial - utilizado): </b></td>	
		<td class="formulario" align="right"><b><?=$TufosInicial - $acum?></b></td>	
	</tr>
</table>	
<?php
	}
?>

<?php } ?>
</form>
</body>
</html>