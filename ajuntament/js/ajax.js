function ordenaPrioritat(){
	// Fem una petici� HTTP primer de tot
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	// Comprovar que el servidor estigui llest
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			// Indiques en quin "div" voldr�s escriure el contingut que carregues des del teu
			document.getElementById("items").innerHTML=xmlhttp.responseText;
		}
	}
	// Omples una variable amb els par�metres que necessitis passar al php
	var ordenar = "preu";
	// Fas la petici� http per obrir la p�gina php que vulguis amb la funci� open(m�tode, p�gina, true)
	xmlhttp.open("GET","mostrarLlistaItems.php?ordenar=prioritat",true);
	xmlhttp.send(null);
}