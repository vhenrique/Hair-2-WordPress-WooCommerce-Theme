<?php
	include "kernel.martha_sys.inc.php";
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
</head>
<body bgcolor="#AC94B6">
<div id="divAniversarios" style="padding-left:10px;position:absolute;top:10px;left:10px;width:300px;height:200px; color:#FFFFFF; overflow:auto;">
<h3 class="titulo_secao">Aniversários</h3>
<?php
	connect();
	$q = mysql_query("SELECT *, DAYOFYEAR(DataNascimento) AS dia_do_ano, DAYOFYEAR(NOW()) AS hoje, YEAR(DataNascimento) AS ano_nasc FROM " . _TABLE_PREFIX . "clientes WHERE (DataNascimento != 0) AND (DataNascimento != '1969-12-31') ORDER BY DAYOFYEAR(DataNascimento)");
	echo mysql_error();
	while($r = mysql_fetch_assoc($q))
		if(($r['dia_do_ano']>=$r['hoje']) && ($r['dia_do_ano']<=($r['hoje']+15)%365)) {?>
				<li><?=date("d/m",strtotime($r['DataNascimento']))?>: <b><?=$r['Nome']?> <?=$r['Sobrenome']?></b> (<?=date('Y')-$r['ano_nasc']?>)<br>	
<?php		}	
?>
</div>

<div id="divAlertas" style="padding-left:10px;position:absolute;top:10px;left:320px;width:300px;height:200px; color:#FFFFFF; overflow:auto;">
<h3 class="titulo_secao">Manutenções</h3>
<?php
	connect();
	$q = mysql_query("SELECT * FROM " . _TABLE_PREFIX . "avisos ORDER BY Data ASC");
	echo mysql_error();
	while($r = mysql_fetch_assoc($q)) { 
		$cliente = getCliente($r['IdCliente']);
	?>
			[<a href="remover.php?id=<?=$r['Id']?>&tabela=avisos" target="_top">x</a>] <?=date("d/m",strtotime($r['Data']))?>: <b><?=$r['Descricao']?> <?=$cliente['Nome']?> <?=$cliente['Sobrenome']?></b><br>	
<?php	}	
?>
</div>
</body>
</html>
