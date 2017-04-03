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
		$cliente = getCliente($id);
		extract($cliente);
  	    $DataNascimento = date("d/m/Y", strtotime($DataNascimento));
	    $DataEntrada = date("d/m/Y", strtotime($DataEntrada));   
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
<body bgcolor="#AC94B6">
<h3 class="titulo_secao">
<?php
	if($edita)
		echo "Editar Cliente";
	else
		echo "Cadastrar Cliente";		
?>
</h3>
<form action="<?php if($edita) 
					echo "editar.php?id=" . $id . "&tabela=clientes"; 
				else
					echo "cadastrar.php?tabela=clientes"; 
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
<tr>
	<td class="formulario">Sobrenome:</td>
	<td><input type="text" name="Sobrenome" size="20"
	<?php if($edita) {?>
		value="<?=$Sobrenome?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Sexo:</td>
	<td class="formulario">
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
	<td class="formulario">Data de Nascimento:</td>
	<td><input type="text" name="DataNascimento" size="10"
	<?php if($edita) {?>
		value="<?=$DataNascimento?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">CPF:</td>
	<td><input type="text" name="CPF" size="10"
	<?php if($edita) {?>
		value="<?=$CPF?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">RG:</td>
	<td><input type="text" name="RG" size="10"
	<?php if($edita) {?>
		value="<?=$RG?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Telefone:</td>
	<td><input type="text" name="Telefone" size="10"
	<?php if($edita) {?>
		value="<?=$Telefone?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Telefone Comercial:</td>
	<td><input type="text" name="TelefoneComercial" size="10"
	<?php if($edita) {?>
		value="<?=$TelefoneComercial?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Celular:</td>
	<td><input type="text" name="Celular" size="10"
	<?php if($edita) {?>
		value="<?=$Celular?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Endereço:</td>
	<td><textarea name="Endereco" cols="20" rows="6"><?php if($edita) {	echo $Endereco;} ?></textarea></td>
</tr>
<tr>
	<td class="formulario">Email:</td>
	<td><input type="text" name="Email" size="30"
	<?php if($edita) {?>
		value="<?=$Email?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Como conheceu?</td>
	<td><input type="text" name="Midia" size="20"
	<?php if($edita) {?>
		value="<?=$Midia?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Cliente desde:</td>
	<td><input type="text" name="DataEntrada" size="10"
	<?php if($edita) {?>
		value="<?=$DataEntrada?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">
		Histórico e Observações:
    </td>
    <td>
		<textarea name="Historico" cols="60" rows="15" wrap="off"><?php if($edita) {	echo $Historico;} ?></textarea></textarea>
	</td>
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