<?php
    include "kernel.martha_sys.inc.php";
	$login = md5($_POST['Email']); 
	$senha = md5($_POST['Senha']); 
	if(tryLogin("$login", "$senha")) {
		JSAlert("Bem-vindo ao sistema!");	
		JSLocation("main.php");
	} else {  
		JSAlert("Usu�rio ou senha inv�lidos!");	
		JSLocation("http://cabelobrasileiromarthahair.com.br/sistema/");
	}	
?>
