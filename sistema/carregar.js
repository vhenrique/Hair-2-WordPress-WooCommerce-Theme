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



