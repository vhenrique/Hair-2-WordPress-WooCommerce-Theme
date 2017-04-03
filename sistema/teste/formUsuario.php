<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(1);
	if(isset($_GET["acao"]) && ($_GET["acao"]=="edita")) {
		if(isset($_POST["Opcoes"])) 
			$id = $_POST["Opcoes"];
		else
			$id = $_GET["id"];
		$edita=true;
		$usuario = getUsuario($id);
		extract($usuario);
	}
	else
		$edita=false;


?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<script type="text/javascript" src="javascript_martha.js"></script>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body>
<h3 class="titulo_secao">
<?php
	if($edita)
		echo "Editar Usuário";
	else
		echo "Cadastrar Usuário";		
?>
</h3>
<form action="<?php if($edita) 
					echo "editar.php?id=" . $id . "&tabela=usuarios"; 
				else
					echo "cadastrar.php?tabela=usuarios"; 
			?>" method="post">
<table class="cadastrar">
<tr>
	<td class="formulario">Nome:</td>
	<td><input type="text" name="Nome" size="20"
	<?php if($edita) {?>
		value="<?=$Nome?>"
	<?php }?>
	></td>
</tr>
<?php if(!$edita) { ?>
<tr>
	<td class="formulario">Email:</td>
	<td><input type="text" name="Email" size="20"
	<?php if($edita) {?>
		value="<?=$Email?>"
	<?php }?>
	></td>
</tr>
<?php } ?>
<tr>
	<td class="formulario">Senha</td>
	<td><input type="password" name="Senha" size="20"
	<?php if($edita) {?>
		value="<?=$Senha?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Nível:</td>
	<td class="formulario">
	<?php if(!$edita) {?>
		<select name="Nivel">
			<option value="3">Funcionário</option>
			<option value="2">Financeiro</option>
		</select></td>
	<?php } else { 
		switch($Nivel) {
	     case 0: 
		 	echo "Administrador";
			break;
	     case 1: 
		 	echo "Gerente";
			break;
		 case 2: 
		 	echo "Financeiro";
			break;
		 case 3: 
		 	echo "Funcionário";
			break;
		}
	 } ?>
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