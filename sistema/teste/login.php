<?
    include "kernel.martha_sys.inc.php";
	$login = md5($_POST['Email']); 
	$senha = md5($_POST['Senha']); 
	if($_SERVER['HTTP_REFERER']!='http://www.clinicamarthahair.com.br/sistema/') die();
	if(tryLogin("$login", "$senha")) {
		JSAlert("Bem-vindo ao sistema!");	
		JSLocation("main.php");
	} else {  
		JSAlert("Usuário ou senha inválidos!");	
		JSLocation("http://www.clinicamarthahair.com.br/sistema");
	}	
?>
