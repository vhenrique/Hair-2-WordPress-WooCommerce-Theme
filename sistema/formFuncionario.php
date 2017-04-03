<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	if(isset($_GET["acao"]) && ($_GET["acao"]=="edita")) {
		if(isset($_POST["Opcoes"])) 
			$id = $_POST["Opcoes"];
		else
			$id = $_GET["id"];
		$edita=true;
		$funcionario = getFuncionario($id);
		extract($funcionario);
  	    $DataNascimento = date("d/m/Y", strtotime($DataNascimento));
	    $DataEntrada = date("d/m/Y", strtotime($DataEntrada));   
	}
	else
		$edita=false;
		
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body bgcolor="#9999CC">

<h3 class="titulo_secao">
<?php
	if($edita)
		echo "Editar Funcionário";
	else
		echo "Cadastrar Funcionário";		
?>
</h3>
<form action="<?php if($edita) 
					echo "editar.php?id=" . $id . "&tabela=martha_funcionarios"; 
				else
					echo "cadastrar.php?tabela=martha_funcionarios"; 
			?>" method="post">
<table class="cadastrar">
<tr>
	<td class="style6">Nome:</td>
	<td><input type="text" name="Nome" size="20"
	<?php if($edita) {?>
		value="<?=$Nome?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="style6">Sobrenome:</td>
	<td><input type="text" name="Sobrenome" size="20"
	<?php if($edita) {?>
		value="<?=$Sobrenome?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="style6">Sexo:</td>
	<td class="style6">
		<input type="radio" name="Sexo" value="M"
		<?php	
			if($edita && ($Sexo == "M"))
				echo " CHECKED";
		?>
		>Masculino
		<input type="radio" name="Sexo" value="F"
		<?php	
			if($edita && ($Sexo == "F"))
				echo " CHECKED";
		?>
		>Feminino
	</td>
</tr>
<tr>
	<td class="style6">Data de Nascimento:</td>
	<td><input type="text" name="DataNascimento" size="10"
	<?php if($edita) {?>
		value="<?=$DataNascimento?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="style6">Telefone:</td>
	<td><input type="text" name="Telefone" size="10"
	<?php if($edita) {?>
		value="<?=$Telefone?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="style6">Celular:</td>
	<td><input type="text" name="Celular" size="10"
	<?php if($edita) {?>
		value="<?=$Celular?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="style6">Endereço:</td>
	<td><textarea name="Endereco" cols="20" rows="6"><?php if($edita) {	echo $Endereco;} ?></textarea></td>
</tr>
<tr>
	<td class="style6">Email:</td>
	<td><input type="text" name="Email" size="30"
	<?php if($edita) {?>
		value="<?=$Email?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="style6">Na empresa desde:</td>
	<td><input type="text" name="DataEntrada" size="10"
	<?php if($edita) {?>
		value="<?=$DataEntrada?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="style6">Função:</td>
	<td><input type="text" name="Funcao" size="10"
	<?php if($edita) {?>
		value="<?=$Funcao?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td colspan="2">
		<input type="submit" value="Enviar">
	</td>
</tr>
</table>
</form>
<?php if($edita) { ?>
		<a href="remover.php?tabela=martha_funcionarios&id=<?=$id?>">Remover este funcionário</a><br><br>
<?php } ?>
<a href="listarFuncionarios.php">Voltar</a>
</body>
</html>