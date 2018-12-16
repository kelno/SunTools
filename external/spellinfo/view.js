function addAffectMaskPopup(db_id, effectId) {
	let inputMask = document.getElementById("maskInput"+effectId).value;
	let sql = "UPDATE spell_affect SET SpellFamilyMask = SpellFamilyMask | " + inputMask + " WHERE entry = " + db_id + " AND effectId = " + effectId + ";";
	alert(sql);
}

function convertIfHex(mask) {
	var start = String(mask).substring(0, 2);
	if (start == "0x")
		return parseInt(mask, 16);
	
	return mask;
}

// Javascript does not handle bitwise and for 64 bits integer
function BitwiseAndLarge(val1, val2) {
    var shift = 0, result = 0;
    var mask = ~((~0) << 30); // Gives us a bit mask like 01111..1 (30 ones)
    var divisor = 1 << 30; // To work with the bit mask, we need to clear bits at a time
    while( (val1 != 0) && (val2 != 0) ) {
        var rs = (mask & val1) & (mask & val2);
        val1 = Math.floor(val1 / divisor); // val1 >>> 30
        val2 = Math.floor(val2 / divisor); // val2 >>> 30
        for(var i = shift++; i--;) {
            rs *= divisor; // rs << 30
        }
        result += rs;
    }
    return result;
}

function affectCheckAffected(effectId, mask) {
	let inputMask = document.getElementById("maskInput"+effectId).value;
	inputMask = convertIfHex(inputMask);
	
	if(BitwiseAndLarge(mask, inputMask))
		document.getElementById("affectedButton"+effectId).style.color = "green";
	else
		document.getElementById("affectedButton"+effectId).style.color = "red";
}