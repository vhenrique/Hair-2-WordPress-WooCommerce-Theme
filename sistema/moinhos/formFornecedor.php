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
		$fornecedor = getFornecedor($id);
		extract($fornecedor);
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
		echo "Editar Fornecedor";
	else
		echo "Cadastrar Fornecedor";		
?>
</h3>
<form action="<?php if($edita) 
					echo "editar.php?id=" . $id . "&tabela=fornecedores"; 
				else
					echo "cadastrar.php?tabela=fornecedores"; 
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
	<td class="formulario">Razão Social:</td>
	<td><input type="text" name="RazaoSocial" size="20"
	<?php if($edita) {?>
		value="<?=$RazaoSocial?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Ramo de Atividade:</td>
	<td><input type="text" name="Ramo" size="20"
	<?php if($edita) {?>
		value="<?=$Ramo?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Inscrição Municipal:</td>
	<td><input type="text" name="InscMunicipal" size="20"
	<?php if($edita) {?>
		value="<?=$InscMunicipal?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Inscrição Estadual</td>
	<td><input type="text" name="InscEstadual" size="20"
	<?php if($edita) {?>
		value="<?=$InscEstadual?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">CNPJ:</td>
	<td><input type="text" name="CNPJ" size="20"
	<?php if($edita) {?>
		value="<?=$CNPJ?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">Endereço:</td>
	<td><textarea name="Endereco" cols="20" rows="6"><?php if($edita) {	echo $Endereco;} ?></textarea></td>
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
	<td class="formulario">Fax:</td>
	<td><input type="text" name="Fax" size="10"
	<?php if($edita) {?>
		value="<?=$Fax?>"
	<?php }?>
	></td>
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
	<td class="formulario">Site:</td>
	<td><input type="text" name="Site" size="20"
	<?php if($edita) {?>
		value="<?=$Site?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td class="formulario">
		Observações:
    </td>
    <td>
		<textarea name="Obs" cols="30" rows="6" wrap="off"><?php if($edita) {	echo $Obs;} ?></textarea></textarea>
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