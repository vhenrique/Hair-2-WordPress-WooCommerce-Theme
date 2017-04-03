<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<script language="javascript">
function enviaForm() {
	var envia = false;
	var f = document.fLogin;
	var franquia = document.fLogin.franquia.value;
	f.action = franquia + "/login.php";
	if(franquia != "")
		envia = true;
	else 
		alert("Por favor, escolha uma franquia.");
	return envia;			
	
}

</script>

<style type="text/css">
<!--
body {
	background-image: url(gradiente.jpg);
}
-->
</style>
</head>
<body>
  <div class="wrap">
    <img src="images/logo.png" class="main">
    <?php include "formLogin.php"; ?>
  </div>
</body>
</html>
