<?php
	include "kernel.martha_sys.inc.php";
	$sec = isset($_GET["sec"]) ? $_GET["sec"] : "main";
	if($sec == "listarFuncionarios") 
		$onload = "javascript:inicializaAjax();carregarFuncionarios();";
	elseif($sec == "listarClientes") 
		$onload = "javascript:inicializaAjax();carregarClientes();";
	else
		$onload = "javascript:inicializaAjax();";
	
	$logged = isLogged();
?>
<html></html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(gradiente.jpg);
}
-->
</style>

<script language="javascript">
var ids = new Array();
var nomes = new Array();
	function iniciaLista() {
		document.Cadastro.Opcoes.length = 0;
		for(i=0;i<nomes.length;i++) 
			document.Cadastro.Opcoes[i] = new Option(nomes[i],ids[i]);
	}

	function atualizaLista() {
		document.Cadastro.Opcoes.length = 0;
		var str = document.Cadastro.Nome.value;
		for(i=0;i<nomes.length;i++)
			if(nomes[i].indexOf(str)!=-1)
				document.Cadastro.Opcoes[document.Cadastro.Opcoes.length] = new Option(nomes[i],ids[i]);
	}
	
	function selecionaOpcao() {
		document.Cadastro.Nome.value = document.Cadastro.Opcoes[document.Cadastro.Opcoes.selectedIndex].text;
	}

function carregarClientes() {
	var divOp = document.getElementById("Opcoes");
	if(ajax) {
		ajax.open('POST','carregarClientes.php',true);
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');			
		ajax.send('');
		ajax.onreadystatechange = function() {
			if(ajax.readyState == 4) {
				if (ajax.status == 200) {
					divOp.innerHTML = ajax.responseText;
					for(var i=0;i<document.Cadastro.Opcoes.options.length;i++) {
						ids[i] = document.Cadastro.Opcoes.options[i].value;
						nomes[i] = document.Cadastro.Opcoes.options[i].text;
					}
				} else {
					alert('Erro com a solicitação! (AJAX)');
				}
			}
		}
	}
}

function carregarFuncionarios() {
	var divOp = document.getElementById("Opcoes");
	if(ajax) {
		ajax.open('POST','carregarFuncionarios.php',true);
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');			
		ajax.send('');
		ajax.onreadystatechange = function() {
			if(ajax.readyState == 4) {
				if (ajax.status == 200) {
					divOp.innerHTML = ajax.responseText;
					for(var i=0;i<document.Cadastro.Opcoes.options.length;i++) {
						ids[i] = document.Cadastro.Opcoes.options[i].value;
						nomes[i] = document.Cadastro.Opcoes.options[i].text;
					}
				} else {
					alert('Erro com a solicitação! (AJAX)');
				}
			}
		}
	}
}

</script>

<script type="text/javascript" src="ajax.js"></script>

</head>

<body topmargin="5" leftmargin="5" onload="<?=$onload?>">
<table width="100%" height="550" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td height="70" class="style6"><!--url's used in the movie-->
  <!--text used in the movie-->
  <!-- saved from url=(0013)about:internet -->
  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="177" height="63" id="logopqno" align="middle">
    <param name="allowScriptAccess" value="sameDomain" />
    <param name="movie" value="logopqno.swf" />
    <param name="quality" value="high" />
    <param name="wmode" value="transparent" />
    <param name="bgcolor" value="#ffffff" />
    <embed src="logopqno.swf" quality="high" wmode="transparent" bgcolor="#ffffff" width="177" height="63" name="logopqno" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
  </object><br></td>
  </tr>
  <tr>
    <td valign="top" class="style6">
		<?php
			if(!$logged) 
				include "formLogin.php";
			else
				include $sec . ".php";
		?>
	</td>
  </tr>
</table>
</body>
</html>
