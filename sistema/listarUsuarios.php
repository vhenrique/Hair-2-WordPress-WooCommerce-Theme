<?php
	if(!$logged) {
		die("sess�o n�o iniciada");
	}
?>
<h3 class="titulo_secao">Usu�rios cadastrados</h3>
<table class="listar">
	<tr>
		<th>Id</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Comunicadores</th>
		<th>Telefones</th>
		<th>Endere�o</th>
		<th>Fun��o</th>
		<th>Editar</th>
		<th>Remover</th>
	</tr>
<?php 
	$usuarios = getUsuarios();
	foreach($usuarios as $usuario) { 
		extract($usuario);
?>

	<tr>
		<td><?=$Id?></td>
		<td><?=$Nome?></td>
		<td><?=$Email?></td>
		<td>
		<?php
			if($MSN)
				echo "MSN: " . $MSN . "<br>";
			if($Skype)
				echo "Skype: " . $Skype . "<br>";
		?>
		</td>
		<td>
		<?php
			if($TelFixo)
				echo "Telefone fixo: " . $TelFixo . "<br>";
			if($Celular)
				echo "Celular: " . $Celular . "<br>";
		?>
		</td>

		<td><?=$Endereco?></td>
		<td><?=$Funcao?></td>
		<td><a href="index.php?sec=formUsuario&acao=edita&id=<?=$Id?>">Editar</a></td>
		<td><a href="index.php?sec=remover&tabela=usuarios&id=<?=$Id?>">Remover</a></td>
	</tr>
	
<?php } ?>
</table>
<a href="index.php?sec=formUsuario&acao=cadastra">Cadastrar Usu�rio</a><br><br>

<a href="index.php">Voltar</a>
