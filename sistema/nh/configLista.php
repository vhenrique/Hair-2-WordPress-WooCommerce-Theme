<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sess�o n�o iniciada");
	}
	if(isset($_GET["tabela"])) 
		$tabela = $_GET["tabela"];
	else
		die("Voc� n�o forneceu nenhuma tabela.");
	$lista = getAll($tabela);
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<script language="javascript">
function windowContrato(url) {
  	var wProduto = window.open(url,'MyWin','width=800,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}
</script>
</head>
<body>
<h3 class="titulo_secao">Configurar Lista - <?=$tabela?></h3>
<b>Instru��es:</b><br>
<li>Um registro por linha;
<li>Ao inv�s de v�rgula, usar ponto;
<li>N�o usar nenhum sinal que n�o for n�mero ou ponto;
<br><br>
<form action="_configLista.php?tabela=<?=$tabela?>" method="post">
<textarea name="lista" cols="10" rows="10">
<?php
	foreach($lista as $item) {
		echo $item["Valor"] . "\n";
	}
?>
</textarea>
<br>
<input type="submit" value="Atualizar">
</form>
<br><br>
</body>
</html>