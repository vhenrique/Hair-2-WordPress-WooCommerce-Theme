<?php
	if(!$logged) {
		die("sessão não iniciada");
	}
	if(isset($_GET["acao"]) && ($_GET["acao"]=="edita")) {
		$edita=true;
		$usuario = getUsuario2($_GET["id"]);
		extract($usuario);
	}
	else
		$edita=false;
?>
<h3 class="titulo_secao">Cadastrar usuario</h3>
<form action="index.php?<?php if($edita) 
					echo "sec=editar&id=" . $_GET["id"] . "&tabela=usuarios"; 
				else
					echo "sec=cadastrar&tabela=usuarios"; 
			?>" method="post">
<table class="cadastrar">
<tr>
	<td>Nome</td>
	<td><input type="text" name="Nome" size="40"
	<?php if($edita) {?>
		value="<?=$Nome?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td>E-mail</td>
	<td><input type="text" name="Email" size="40"
	<?php if($edita) {?>
		value="<?=$Email?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td>Senha</td>
	<td><input type="password" name="Senha" size="20"
	<?php if($edita) {?>
		value="<?=$Senha?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td>MSN</td>
	<td><input type="text" name="MSN" size="40"
	<?php if($edita) {?>
		value="<?=$MSN?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td>Skype</td>
	<td><input type="text" name="Skype" size="20"
	<?php if($edita) {?>
		value="<?=$Skype?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td>Telefone Fixo</td>
	<td><input type="text" name="TelFixo" size="20"
	<?php if($edita) {?>
		value="<?=$TelFixo?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td>Celular</td>
	<td><input type="text" name="Celular" size="20"
	<?php if($edita) {?>
		value="<?=$Celular?>"
	<?php }?>
	></td>
</tr>
<tr>
	<td>Endereço</td>
	<td><textarea name="Endereco" rows="4" cols="25"><?php if($edita) {?><?=$Endereco?><?php }?></textarea>
	</td>
</tr>
<tr>
	<td>Função</td>
	<td>
		<select name="Funcao">
			<option value="Bolsista"<?php if($edita && ($Funcao == "Bolsista")) echo "SELECTED"; ?>>Bolsista</option>		
			<option value="Coordenador"<?php if($edita && ($Funcao == "Coordenador")) echo "SELECTED"; ?>>Coordenador</option>		
		</select>
	</td>
</tr>
<tr>
	<td colspan="2">
		<input type="submit" value="Cadastrar">
	</td>
</tr>
</table>
</form>

<a href="index.php?sec=listarUsuarios">Voltar</a>
