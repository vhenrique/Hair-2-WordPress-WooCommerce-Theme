function confirma(url) {
	var c = confirm("Tem certeza de que deseja remover este item?")
	if(c)
		window.location = url;
}

function incluirSelect(obj) {
	var novo = prompt("Qual a nova opção a ser adicionada?");
	if(novo!=null) {
		n = obj.length;
		obj.options[n] = new Option(novo,novo);
		obj.selectedIndex = n;
	}
}
