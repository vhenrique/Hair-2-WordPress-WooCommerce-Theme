<?php
    include "kernel.martha_sys.inc.php";
	$login = $_POST['Email']; 
	$senha = $_POST['Senha']; 
	if(tryLogin("$login", "$senha"))
		JSAlert("Bem-vindo ao sistema!");	
	else  
		JSAlert("Usu�rio ou senha inv�lidos!");	
	JSLocation("main.php");
?>
