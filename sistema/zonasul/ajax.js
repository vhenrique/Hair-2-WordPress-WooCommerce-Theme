var ajax;

function inicializaAjax() {
	if (window.XMLHttpRequest) { // Mozilla, Safari, ...
		ajax = new XMLHttpRequest();
		if (ajax.overrideMimeType) {
			ajax.overrideMimeType('text/xml');
			// See note below about this line
		}
	} 
	else if (window.ActiveXObject) { // IE
		try {
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
		   try {
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
		   } catch (e) {}
		}
	}

	if (!ajax) {
		alert('Giving up :( Cannot create an XMLHTTP instance');
		return false;
	} 
}	


