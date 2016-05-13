function deshabilitar_checkbox_LTCAT()
{
	if (document.getElementById("LTCAT3").checked == true){
		document.getElementById("publicats3").checked = false;
		document.getElementById("finalitzats3").checked = false;
	}
	return false;
}
function deshabilitar_checkbox_publicats()
{
	if (document.getElementById("publicats3").checked == true){
		document.getElementById("LTCAT3").checked = false;
		document.getElementById("finalitzats3").checked = false;
	}
	return false;
}
function deshabilitar_checkbox_finalitzats()
{
	if (document.getElementById("finalitzats3").checked == true){
		document.getElementById("LTCAT3").checked = false;
		document.getElementById("publicats3").checked = false;
	}
	return false;
}