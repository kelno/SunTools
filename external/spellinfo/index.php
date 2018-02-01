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
		<title>Spell Info</title>
		<meta charset="utf-8"/>
	</head>
<body>
<?php
error_reporting( E_ALL ); 

require('../../dbconfig.php');

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if (!isset($_GET["id"])) {
	echo "<form>";
	echo "ID <input type=\"text\" name=\"id\" value=\"0\"/></input>";
	echo "</form>";
	die();
}

$id = htmlspecialchars($_GET["id"]);

include ('Attributes.php');
include ('Effects.php');
include ('Auras.php');
include ('DBC.php');

$fields = "`entry`,`category`,`dispel`,`mechanic`,`attributes`,`attributesEx`,`attributesEx2`,`attributesEx3`,`attributesEx4`,`attributesEx5`,`attributesEx6`,`stances`,`stancesNot`,`targets`,`targetCreatureType`,`requiresSpellFocus`,`facingCasterFlags`,`casterAuraState`,`targetAuraState`,`casterAuraStateNot`,`targetAuraStateNot`,`castingTimeIndex`,`recoveryTime`,`categoryRecoveryTime`,`interruptFlags`,`auraInterruptFlags`,`channelInterruptFlags`,`procFlags`,`procChance`,`procCharges`,`maxLevel`,`baseLevel`,`spellLevel`,`durationIndex`,`powerType`,`manaCost`,`manaCostPerlevel`,`manaPerSecond`,`manaPerSecondPerLevel`,`rangeIndex`,`speed`,`stackAmount`,`totem1`,`totem2`,`reagent1`,`reagent2`,`reagent3`,`reagent4`,`reagent5`,`reagent6`,`reagent7`,`reagent8`,`reagentCount1`,`reagentCount2`,`reagentCount3`,`reagentCount4`,`reagentCount5`,`reagentCount6`,`reagentCount7`,`reagentCount8`,`equippedItemClass`,`equippedItemSubClassMask`,`equippedItemInventoryTypeMask`,`effect1`,`effect2`,`effect3`,`effectDieSides1`,`effectDieSides2`,`effectDieSides3`,`effectBaseDice1`,`effectBaseDice2`,`effectBaseDice3`,`effectDicePerLevel1`,`effectDicePerLevel2`,`effectDicePerLevel3`,`effectRealPointsPerLevel1`,`effectRealPointsPerLevel2`,`effectRealPointsPerLevel3`,`effectBasePoints1`,`effectBasePoints2`,`effectBasePoints3`,`effectMechanic1`,`effectMechanic2`,`effectMechanic3`,`effectImplicitTargetA1`,`effectImplicitTargetA2`,`effectImplicitTargetA3`,`effectImplicitTargetB1`,`effectImplicitTargetB2`,`effectImplicitTargetB3`,`effectRadiusIndex1`,`effectRadiusIndex2`,`effectRadiusIndex3`,`effectApplyAuraName1`,`effectApplyAuraName2`,`effectApplyAuraName3`,`effectAmplitude1`,`effectAmplitude2`,`effectAmplitude3`,`effectMultipleValue1`,`effectMultipleValue2`,`effectMultipleValue3`,`effectChainTarget1`,`effectChainTarget2`,`effectChainTarget3`,`effectItemType1`,`effectItemType2`,`effectItemType3`,`effectMiscValue1`,`effectMiscValue2`,`effectMiscValue3`,`effectMiscValueB1`,`effectMiscValueB2`,`effectMiscValueB3`,`effectTriggerSpell1`,`effectTriggerSpell2`,`effectTriggerSpell3`,`effectPointsPerComboPoint1`,`effectPointsPerComboPoint2`,`effectPointsPerComboPoint3`,`spellVisual`,`spellIconID`,`activeIconID`,`spellName1`,`spellName2`,`spellName3`,`spellName4`,`spellName5`,`spellName6`,`spellName7`,`spellName8`,`spellName9`,`spellName10`,`spellName11`,`spellName12`,`spellName13`,`spellName14`,`spellName15`,`spellName16`,`rank1`,`rank2`,`rank3`,`rank4`,`rank5`,`rank6`,`rank7`,`rank8`,`rank9`,`rank10`,`rank11`,`rank12`,`rank13`,`rank14`,`rank15`,`rank16`,`description1`,`manaCostPercentage`,`startRecoveryCategory`,`startRecoveryTime`,`maxTargetLevel`,`spellFamilyName`,`spellFamilyFlags`,`maxAffectedTargets`,`dmgClass`,`preventionType`,`dmgMultiplier1`,`dmgMultiplier2`,`dmgMultiplier3`,`totemCategory1`,`totemCategory2`,`areaId`,`schoolMask`";

$query = $handler->prepare("SELECT ${fields} FROM spell_template where entry = :id");
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();

$query = $handler->prepare("SELECT ${fields}, Comment FROM spell_template_override where entry = :id");
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$data2 = $query->fetch();

class SpellInfo
{
	function Load(&$data)
	{
		$this->castingTimeIndex = $data[21];
		$this->durationIndex = $data[33];
		$this->rangeIndex = $data[39];
		$this->effects[0] = $data[63];
		$this->effects[1] = $data[64];
		$this->effects[2] = $data[65];
		$this->effectDieSides[0] = $data[66];
		$this->effectDieSides[1] = $data[67];
		$this->effectDieSides[2] = $data[68];
		$this->effectBaseDice[0] = $data[69];
		$this->effectBaseDice[0] = $data[70];
		$this->effectBaseDice[0] = $data[71];
		$this->effectBasePoints[0] = $data[78];
		$this->effectBasePoints[1] = $data[79];
		$this->effectBasePoints[2] = $data[80];
		$this->effectImplicitTargetA[0] = $data[84];
		$this->effectImplicitTargetA[1] = $data[85];
		$this->effectImplicitTargetA[2] = $data[86];
		$this->effectImplicitTargetB[0] = $data[87];
		$this->effectImplicitTargetB[1] = $data[88];
		$this->effectImplicitTargetB[2] = $data[89];
		$this->effectRadiusIndex[0] = $data[90];
		$this->effectRadiusIndex[1] = $data[91];
		$this->effectRadiusIndex[2] = $data[92];
		$this->applyAuraNames[0] = $data[93];
		$this->applyAuraNames[1] = $data[94];
		$this->applyAuraNames[2] = $data[95];
		$this->effectAmplitude[0] = $data[96];
		$this->effectAmplitude[1] = $data[97];
		$this->effectAmplitude[2] = $data[98];
		$this->effectItemType[0] = $data[105];
		$this->effectItemType[1] = $data[106];
		$this->effectItemType[2] = $data[107];
		$this->effectMiscValue[0] = $data[108];
		$this->effectMiscValue[1] = $data[109];
		$this->effectMiscValue[2] = $data[110];
		$this->effectMiscValueB[0] = $data[111];
		$this->effectMiscValueB[1] = $data[112];
		$this->effectMiscValueB[2] = $data[113];
		$this->effectTriggerSpell[0] = $data[114];
		$this->effectTriggerSpell[1] = $data[115];
		$this->effectTriggerSpell[2] = $data[116];
		$this->spellName = $data[123];
		$this->spellDescription = $data[155];
		
		
		$c = 0;
		for ($i = 4; $i < 11; $i += 1)
		{
			$this->spellAttributes[$c] = $data[$i];
			$c++;
		}

	}
	
	public $spellAttributes;
	public $castingTimeIndex;
	public $durationIndex;
	public $rangeIndex;
	public $effects;
	public $effectDieSides;
	public $effectBaseDice;
	public $effectBasePoints;
	public $effectImplicitTargetA;
	public $effectImplicitTargetB;
	public $effectRadiusIndex;
	public $applyAuraNames;
	public $effectAmplitude;
	public $effectItemType;
	public $effectMiscValue;
	public $effectMiscValueB;
	public $effectTriggerSpell;
	public $spellName;
	public $spellDescription;
};

$baseSpellInfo = new SpellInfo();
$baseSpellInfo->Load($data);

echo "<h2>Spell Info : " . $id . "</h2>";
echo "Name: <a href=\"http://www.wowhead.com/spell=".$id."\">".$baseSpellInfo->spellName."</a> (<a href=\"https://tbc-twinhead.twinstar.cz/?spell=".$id."\">Twinstar TBC</a>)<br>";
echo "Description: ".$baseSpellInfo->spellDescription;
echo "<hr>";

echo '<ul>';
echo "<li>Duration : " . getDuration($baseSpellInfo->durationIndex) . "</li>";
echo "<li>Casting time : " . getCastingTime($baseSpellInfo->castingTimeIndex) . "</li>";
echo "<li>Range : " . getRange($baseSpellInfo->rangeIndex) . "</li>";
echo '</ul>';
	
//Print attributes

echo "<hr><h3>Attributes:</h3>";
for ($a = 0; $a < 7; $a += 1)
{
	echo "<b>" . getAttributeCategoryName($a) . " = " . $baseSpellInfo->spellAttributes[$a] . " = 0x" . dechex($baseSpellInfo->spellAttributes[$a]) . " :</b><br>";
	for ($i = 0; $i < 32; $i += 1)
	{
		if ($baseSpellInfo->spellAttributes[$a] & pow(2,$i))
			echo "0x" . dechex(pow(2,$i)) . " - " . getAttributeName($a,$i) . "<br>";
	}
}

//Print effects
echo "<hr><h3>Effects:</h3><ul>";
for ($i = 0; $i < 3; $i += 1)
{
    echo '<li>';
	if($baseSpellInfo->effects[$i] != 0)
	{
		echo $baseSpellInfo->effects[$i] . " - " . getSpellEffectName($baseSpellInfo->effects[$i]) . "<br>";
		if($baseSpellInfo->effectBasePoints[$i] != 0)
		    echo "<div>Base points " . $baseSpellInfo->effectBasePoints[$i] . "</div>";
		if($baseSpellInfo->applyAuraNames[$i] != 0)
			echo "<div>Aura type " . $baseSpellInfo->applyAuraNames[$i] . " - " . getAuraName($baseSpellInfo->applyAuraNames[$i]) . "</div>";
		if($baseSpellInfo->effectAmplitude[$i] != 0)
			echo "<div>Amplitude " . $baseSpellInfo->effectAmplitude[$i] . "</div>";
		if($baseSpellInfo->effectItemType[$i] != 0)
			echo "<div>Item type " . $baseSpellInfo->effectItemType[$i] . "</div>";
		if($baseSpellInfo->effectMiscValue[$i] != 0)
			echo "<div>Misc Value " . $baseSpellInfo->effectMiscValue[$i] . "</div>";
		if($baseSpellInfo->effectTriggerSpell[$i] != 0)
			echo "<div>Trigger Spell " . $baseSpellInfo->effectTriggerSpell[$i] . "</div>";
		if($baseSpellInfo->effectImplicitTargetA[$i] != 0)
			echo "<div>ImplicitTargetA " . getTarget($baseSpellInfo->effectImplicitTargetA[$i]) . "</div>";
		if($baseSpellInfo->effectImplicitTargetB[$i] != 0)
			echo "<div>ImplicitTargetB " . getTarget($baseSpellInfo->effectImplicitTargetB[$i]) . "</div>";
		if($baseSpellInfo->effectRadiusIndex[$i] != 0)
		    echo "<div>Radius : " . getRadius($baseSpellInfo->effectRadiusIndex[$i]) . "</div>";
	}
	echo '</li>';
}

?>
</ul>
</body>
</html>
