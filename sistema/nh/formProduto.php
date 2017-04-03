<?php
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
		$produto = getProduto($id);
		extract($produto);
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
</head>
<body bgcolor="#AC94B6">
<h3 class="titulo_secao">
<?php
	if($edita)
		echo "Editar Produto";
	else
		echo "Cadastrar Produto";		
?>
</h3>
<form action="<?php if($edita) 
					echo "editar.php?id=" . $id . "&tabela=produtos"; 
				else
					echo "cadastrar.php?tabela=produtos"; 
			?>" method="post">
<table class="cadastrar">
<tr>
	<td class="formulario">Referência:</td>
	<td><input type="text" name="Referencia" size="20"
	<?php if($edita) {?>
		value="<?=$Referencia?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Nome:</td>
	<td><input type="text" name="Nome" size="30"
	<?php if($edita) {?>
		value="<?=$Nome?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Descrição:</td>
	<td><textarea name="Descricao" cols="20" rows="4"><?php if($edita) {	echo $Descricao;} ?></textarea></td>
</tr>
<tr>
	<td class="formulario">Valor:</td>
	<td class="formulario"><input type="text" name="Valor" size="10" onKeyUp="javascript:validaMonetario(this);"
	<?php if($edita) {?>
		value="<?=$Valor?>"
	<?php } else {?>
		value="0.00"
	<?php } ?>
		></td>
</tr>
<tr>
	<td colspan="2">
		<input type="submit" value="Enviar">
	</td>
</tr>
</table>
</form>
</body>
</html>