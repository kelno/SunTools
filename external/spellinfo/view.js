function addAffectMaskPopup(db_id, effectId) {
	let inputMask = document.getElementById("maskInput").value;
	let sql = "UPDATE spell_affect SET SpellFamilyMask = SpellFamilyMask | " + inputMask + " WHERE entry = " + db_id + " AND effectId = " + effectId + ";";
	alert(sql);
}

function convertIfHex(mask) {
	var start = String(mask).substring(0, 2);
	if (start == "0x")
		return parseInt(mask, 16);
	
	return mask;
}

function affectCheckAffected(mask) {
	let inputMask = document.getElementById("maskInput").value;
	inputMask = convertIfHex(inputMask);
	if(mask & inputMask)
		document.getElementById("affectedButton").style.color = "green";
	else
		document.getElementById("affectedButton").style.color = "red";
}