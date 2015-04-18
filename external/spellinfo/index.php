<!DOCTYPE html>
<html>
	<style type="text/css">
	body{
	background-color:#446688;
	color:white;
	font-family:arial,sans-serif
	}
	</style>
	<head>
		<title> Spell Info</title>
		<meta charset="utf-8"/>
	</head>
<body>
<?php
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	echo "Spell Info : " . $id . "<br>";
} else {
	echo "<form>";
	echo "ID <input type=\"text\" name=\"id\" value=\"0\"/></input>";
	echo "</form>";
	exit(1);
}
	
 $mysql = mysql_connect('sql31.free-h.org:3306', 'canardwc42', 'barbecue42');
$db = mysql_select_db("canardbd", $mysql); 
/*
$mysql = mysql_connect('localhost:3306', 'root', 'canard');
$db = mysql_select_db("wrworld", $mysql); 
*/
if (mysql_errno($mysql)){
	echo mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
	exit(1);
}

include ('Attributes.php');
include ('Effects.php');
include ('Auras.php');
include ('Targets.php');
include ('DBC.php');

$queryStr = "SELECT * FROM spell_template where id = " . $id;
$query = mysql_query($queryStr);

if ($data = mysql_fetch_array($query)) {
	$c = 0;
	for ($i = 4; $i < 11; $i += 1)
	{
		$spellAttributes[$c] = $data[$i];
		$c++;
	}
	
	$castingTimeIndex = $data[21];
	$durationIndex = $data[33];
	$rangeIndex = $data[39];
	$effects[0] = $data[63];
	$effects[1] = $data[64];
	$effects[2] = $data[65];
	$effectDieSides[0] = $data[66];
	$effectDieSides[1] = $data[67];
	$effectDieSides[2] = $data[68];
	$effectBaseDice[0] = $data[69];
	$effectBaseDice[0] = $data[70];
	$effectBaseDice[0] = $data[71];
	$effectBasePoints[0] = $data[78];
	$effectBasePoints[1] = $data[79];
	$effectBasePoints[2] = $data[80];
	$EffectImplicitTargetA[0] = $data[84];
	$EffectImplicitTargetA[1] = $data[85];
	$EffectImplicitTargetA[2] = $data[86];
	$EffectImplicitTargetB[0] = $data[87];
	$EffectImplicitTargetB[1] = $data[88];
	$EffectImplicitTargetB[2] = $data[89];
	$EffectRadiusIndex[0] = $data[90];
	$EffectRadiusIndex[1] = $data[91];
	$EffectRadiusIndex[2] = $data[92];
	$applyAuraNames[0] = $data[93];
	$applyAuraNames[1] = $data[94];
	$applyAuraNames[2] = $data[95];
	$effectAmplitude[0] = $data[96];
	$effectAmplitude[1] = $data[97];
	$effectAmplitude[2] = $data[98];
	$effectItemType[0] = $data[105];
	$effectItemType[1] = $data[106];
	$effectItemType[2] = $data[107];
	$effectMiscValue[0] = $data[108];
	$effectMiscValue[1] = $data[109];
	$effectMiscValue[2] = $data[110];
	$effectMiscValueB[0] = $data[111];
	$effectMiscValueB[1] = $data[112];
	$effectMiscValueB[2] = $data[113];
	$effectTriggerSpell[0] = $data[114];
	$effectTriggerSpell[1] = $data[115];
	$effectTriggerSpell[2] = $data[116];
	$spellName = $data[123];
} else {
	echo "Erreur lors de la requete<br>";
	echo mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
	exit(1);
}

echo "\"" . $spellName . "\"<br><br>";
echo "Duration : " . getDuration($durationIndex) . "<br>";
echo "Casting time : " . getCastingTime($castingTimeIndex) . "<br>";
echo "Range : " . getRange($rangeIndex) . "<br>";
	
//Print attributes

echo "<h3>Attributes List :</h3>";
for ($a = 0; $a < 7; $a += 1)
{
	echo "<b>" . getAttributeCategoryName($a) . " = " . $spellAttributes[$a] . " = 0x" . dechex($spellAttributes[$a]) . " :</b><br>";
	for ($i = 0; $i < 32; $i += 1)
	{
		if ($spellAttributes[$a] & pow(2,$i))
			echo "0x" . dechex(pow(2,$i)) . " - " . getAttributeName($a,$i) . "<br>";
	}
}

//Print effects
echo "<br><h3>Effects List :</h3>";
for ($i = 0; $i < 3; $i += 1)
{
	if($effects[$i] != 0)
	{
		echo $effects[$i] . " - " . getSpellEffectName($effects[$i]) . "<br>";
		if($effectBasePoints[$i] != 0)
		    echo "<div>Base points " . $effectBasePoints[$i] . "</div>";
		if($applyAuraNames[$i] != 0)
			echo "<div>Aura type " . $applyAuraNames[$i] . " - " . getAuraName($applyAuraNames[$i]) . "</div>";
		if($effectAmplitude[$i] != 0)
			echo "<div>Amplitude " . $effectAmplitude[$i] . "</div>";
		if($effectItemType[$i] != 0)
			echo "<div>Item type " . $effectItemType[$i] . "</div>";
		if($effectMiscValue[$i] != 0)
			echo "<div>Misc Value " . $effectMiscValue[$i] . "</div>";
		if($effectTriggerSpell[$i] != 0)
			echo "<div>Trigger Spell " . $effectTriggerSpell[$i] . "</div>";
		if($EffectImplicitTargetA[$i] != 0)
			echo "<div>ImplicitTargetA " . $EffectImplicitTargetA[$i] . " - " . $Targets[$EffectImplicitTargetA[$i]] . "</div>";
		if($EffectImplicitTargetB[$i] != 0)
			echo "<div>ImplicitTargetB " . $EffectImplicitTargetB[$i] . " - " . $Targets[$EffectImplicitTargetB[$i]] . "</div>";
		if($EffectRadiusIndex[$i] != 0)
		    echo "<div>Radius : " . getRadius($EffectRadiusIndex[$i]) . "</div>";
	}
}

?>
</body>
</html>