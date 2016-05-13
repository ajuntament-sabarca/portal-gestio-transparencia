function ordenaPrioritat(){
	// Fem una petició HTTP primer de tot
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	// Comprovar que el servidor estigui llest
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			// Indiques en quin "div" voldràs escriure el contingut que carregues des del teu
			document.getElementById("items").innerHTML=xmlhttp.responseText;
		}
	}
	// Omples una variable amb els paràmetres que necessitis passar al php
	var ordenar = "preu";
	// Fas la petició http per obrir la pàgina php que vulguis amb la funció open(mètode, pàgina, true)
	xmlhttp.open("GET","mostrarLlistaItems.php?ordenar=prioritat",true);
	xmlhttp.send(null);
}