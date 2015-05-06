function lolFnct(field, value) {
	var x = document.getElementById(field);
	if (value == 0 || isNaN(value)) {
		x.disabled = true;
		x.checked = false;
	} else {
		x.disabled = false;
	}
}
function disableCheckboxes() {
	document.getElementById("chg1").disabled = true;
	document.getElementById("chg2").disabled = true;
}
function verif() {
	$("a").each(function (i, obj) {
		if (/^errAnch\d*$/.test($(obj).attr("name"))){
			$(obj).remove();
		}
	});

	var cpt = 0;
	var reussi = true;
	
	$(".check").each(function (i, obj) {
		var list = $(obj).contents("input");
		switch ($(obj).attr("value")){
		case "strVide" : 
			if(/^\s*$/.test(list[0].value) || list[0].value.length === 0){
				if (reussi){
					reussi = false;
				}
				$(obj).prepend("".anchor("errAnch"+(cpt++)));
				$(obj).css("background-color", "#FF3300");
			}else{
				$(obj).css("background-color", "transparent");
			}
			break;
		case "nbrIncoherence0" : 
			if ((isNaN(list[0].value) || isNaN(list[1].value) || (parseInt(list[0].value, 10) === 0) ^ (parseInt(list[1].value, 10) === 0))){
				if (reussi){
					reussi = false;
				}
				$(obj).prepend("".anchor("errAnch"+(cpt++)));
				$(obj).css("background-color", "#FF3300");
			}else{
				$(obj).css("background-color", "transparent");
			}
			break;
		}
	});
	if (!reussi){
		window.location.hash = "errAnch0"; 
		document.getElementById("navErr").hidden = false;
		document.getElementById("navErrCurr").value = 0;
		document.getElementById("navErrMax").value = cpt-1;
		document.getElementById("navErrMsg").innerHTML = "Erreur n°1";
		document.getElementById("navErrPrecBt").disable = true;
		if (cpt > 1){
			document.getElementById("navErrSuivBt").disabled = false;
		}
	}else{
		document.getElementById("navErr").hidden = true;
		document.getElementById("navErrCurr").value = -1;
		document.getElementById("navErrMax").value = -1;
		document.getElementById("navErrMsg").innerHTML = "Aucune erreur";
		document.getElementById("navErrSuivBt").disabled = true;
	}
	return reussi;
}
function errMoveTo(errNo){
	//TODO CODE
}
function errGoSuiv(){
	if (parseInt(document.getElementById("navErrCurr").value, 10) < parseInt(document.getElementById("navErrMax").value, 10)){
		if (parseInt(document.getElementById("navErrCurr").value, 10) == parseInt(document.getElementById("navErrMax").value, 10) - 1){
			disableErrBt(false, true);
		}
		if (parseInt(document.getElementById("navErrCurr").value, 10) == 0){
			disableErrBt(true, false);
		}
		document.getElementById("navErrCurr").value ++;
		document.getElementById("navErrMsg").innerHTML = "Erreur n°"+(parseInt(document.getElementById("navErrCurr").value, 10)+1);
		window.location.hash = "errAnch"+document.getElementById("navErrCurr").value; 
	}
}
function errGoPrec(){
	if (parseInt(document.getElementById("navErrCurr").value, 10) > 0){
		if (parseInt(document.getElementById("navErrCurr").value, 10) == 1){
			disableErrBt(true, true);
		}
		if (document.getElementById("navErrCurr").value == document.getElementById("navErrMax").value){
			disableErrBt(false, false);
		}
		document.getElementById("navErrCurr").value --;
		document.getElementById("navErrMsg").innerHTML = "Erreur n°"+(parseInt(document.getElementById("navErrCurr").value, 10)+1);
		window.location.hash = "errAnch"+document.getElementById("navErrCurr").value; 
	}
}
function disableErrBt(prec, disable){
	if (prec){
		document.getElementById("navErrPrecBt").disabled = disable;
	}else{
		document.getElementById("navErrSuivBt").disabled = disable;
	}
}