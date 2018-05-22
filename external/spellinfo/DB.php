<?php

class AffectInfo
{
	private function FetchData($spell_id)
	{
		global $handler;
		
		$query = $handler->prepare("SELECT `entry`, `effectId`, `SpellFamilyMask` FROM spell_affect where entry = :id");
		$query->bindValue(':id', $spell_id, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll();
	}
	
	private function Load($id, $first_id)
	{
		global $handler;
		
		$data = $this->FetchData($id);
		if(!$data)
			$data = $this->FetchData($first_id);
		
		if(!$data)
			throw new Exception("No affect for spell $id in database");
		
		foreach($data as $value) {
			$this->db_id = $value["entry"];
			$effectId = $value["effectId"];
			$mask = $value["SpellFamilyMask"];
			$this->masks[$effectId] = $mask;	
		}
	}
	
	function __construct($id, $first_id)
	{
		$this->Load($id, $first_id);
	}
	
	public $db_id;
	public $masks = array(); //one mask for each effect
}

class ProcInfo
{
	private function Load($id, $first_id)
	{
		global $handler;
		
		$query = $handler->prepare("SELECT `SpellId`, `SchoolMask`, `SpellFamilyName`, `SpellFamilyMask`, `ProcFlags`, `SpellTypeMask`, `SpellPhaseMask`, `HitMask`, `AttributesMask`, `ProcsPerMinute`, `Chance`, `Cooldown`, `Charges` FROM spell_proc where SpellId = :id OR -SpellId = :id OR SpellId = :first_id OR -SpellId = :first_id");
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->bindValue(':first_id', $first_id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();

		if(!$data)
			throw new Exception("No proc for spell $id in database");
		
		$this->SpellId = $data[0];
		$this->SchoolMask = $data[1];
		$this->SpellFamilyName = $data[2];
		$this->SpellFamilyMask = $data[3];
		$this->ProcFlags = $data[4];
		$this->SpellTypeMask = $data[5];
		$this->SpellPhaseMask = $data[6];
		$this->HitMask = $data[7];
		$this->AttributesMask = $data[8];
		$this->ProcsPerMinute = $data[9];
		$this->Chance = $data[10];
		$this->Cooldown = $data[11];
		$this->Charges = $data[12];
	}
	
	function __construct($id, $id2)
	{
		$this->Load($id, $id2);
	}
	
	public $SpellId;
	public $SchoolMask;
	public $SpellFamilyName;
	public $SpellFamilyMask;
	public $ProcFlags;
	public $SpellTypeMask;
	public $SpellPhaseMask;
	public $HitMask;
	public $AttributesMask;
	public $ProcsPerMinute;
	public $Chance;
	public $Cooldown;
	public $Charges;
}

class RankInfo
{
	private function Load($id)
	{
		global $handler;
		
		$query = $handler->prepare("SELECT first_spell_id, spell_id, rank FROM spell_ranks where spell_id = :id");
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();

		if(!$data)
			throw new Exception("No rank for spell $id in database");
		
		$this->rank = $data[2];
		$this->first_spell_id = $data[0];
	}
	
	function __construct($id)
	{
		$this->Load($id);
	}
	
	public $rank;
	public $first_spell_id;
}

class SpellInfo
{
	private function Load($id, $override)
	{
		global $handler;
		$fields = "`entry`,`category`,`dispel`,`mechanic`,`attributes`,`attributesEx`,`attributesEx2`,`attributesEx3`,`attributesEx4`,`attributesEx5`,`attributesEx6`,`stances`,`stancesNot`,`targets`,`targetCreatureType`,`requiresSpellFocus`,`facingCasterFlags`,`casterAuraState`,`targetAuraState`,`casterAuraStateNot`,`targetAuraStateNot`,`castingTimeIndex`,`recoveryTime`,`categoryRecoveryTime`,`interruptFlags`,`auraInterruptFlags`,`channelInterruptFlags`,`procFlags`,`procChance`,`procCharges`,`maxLevel`,`baseLevel`,`spellLevel`,`durationIndex`,`powerType`,`manaCost`,`manaCostPerlevel`,`manaPerSecond`,`manaPerSecondPerLevel`,`rangeIndex`,`speed`,`stackAmount`,`totem1`,`totem2`,`reagent1`,`reagent2`,`reagent3`,`reagent4`,`reagent5`,`reagent6`,`reagent7`,`reagent8`,`reagentCount1`,`reagentCount2`,`reagentCount3`,`reagentCount4`,`reagentCount5`,`reagentCount6`,`reagentCount7`,`reagentCount8`,`equippedItemClass`,`equippedItemSubClassMask`,`equippedItemInventoryTypeMask`,`effect1`,`effect2`,`effect3`,`effectDieSides1`,`effectDieSides2`,`effectDieSides3`,`effectBaseDice1`,`effectBaseDice2`,`effectBaseDice3`,`effectDicePerLevel1`,`effectDicePerLevel2`,`effectDicePerLevel3`,`effectRealPointsPerLevel1`,`effectRealPointsPerLevel2`,`effectRealPointsPerLevel3`,`effectBasePoints1`,`effectBasePoints2`,`effectBasePoints3`,`effectMechanic1`,`effectMechanic2`,`effectMechanic3`,`effectImplicitTargetA1`,`effectImplicitTargetA2`,`effectImplicitTargetA3`,`effectImplicitTargetB1`,`effectImplicitTargetB2`,`effectImplicitTargetB3`,`effectRadiusIndex1`,`effectRadiusIndex2`,`effectRadiusIndex3`,`effectApplyAuraName1`,`effectApplyAuraName2`,`effectApplyAuraName3`,`effectAmplitude1`,`effectAmplitude2`,`effectAmplitude3`,`effectMultipleValue1`,`effectMultipleValue2`,`effectMultipleValue3`,`effectChainTarget1`,`effectChainTarget2`,`effectChainTarget3`,`effectItemType1`,`effectItemType2`,`effectItemType3`,`effectMiscValue1`,`effectMiscValue2`,`effectMiscValue3`,`effectMiscValueB1`,`effectMiscValueB2`,`effectMiscValueB3`,`effectTriggerSpell1`,`effectTriggerSpell2`,`effectTriggerSpell3`,`effectPointsPerComboPoint1`,`effectPointsPerComboPoint2`,`effectPointsPerComboPoint3`,`spellVisual`,`spellIconID`,`activeIconID`,`spellName1`,`spellName2`,`spellName3`,`spellName4`,`spellName5`,`spellName6`,`spellName7`,`spellName8`,`spellName9`,`spellName10`,`spellName11`,`spellName12`,`spellName13`,`spellName14`,`spellName15`,`spellName16`,`rank1`,`rank2`,`rank3`,`rank4`,`rank5`,`rank6`,`rank7`,`rank8`,`rank9`,`rank10`,`rank11`,`rank12`,`rank13`,`rank14`,`rank15`,`rank16`,`description1`,`manaCostPercentage`,`startRecoveryCategory`,`startRecoveryTime`,`maxTargetLevel`,`spellFamilyName`,`spellFamilyFlags`,`maxAffectedTargets`,`dmgClass`,`preventionType`,`dmgMultiplier1`,`dmgMultiplier2`,`dmgMultiplier3`,`totemCategory1`,`totemCategory2`,`areaId`,`schoolMask`";
		if($override)
			$fields .= ", `customAttributesFlags`, `Comment`";
		
		$table = ($override ? "spell_template_override" : "spell_template");
		
		$sql = "SELECT ${fields} FROM ${table} WHERE entry = :id";
		$query = $handler->prepare($sql);
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		
		if(!$data)
			throw new Exception("No spell $id in database");
		
		$this->castingTimeIndex = $data[21];
		$this->procFlags = $data[27];
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
		$this->spellFamilyName = $data[160];
		$this->spellFamilyFlags = $data[161];
		
		$c = 0;
		for ($i = 4; $i < 11; $i += 1)
		{
			$this->spellAttributes[$c] = $data[$i];
			$c++;
		}
	}
	
	function __construct($id, $override = false)
	{
		$this->Load($id, $override);
	}
	
	public $spellAttributes;
	public $castingTimeIndex;
	public $procFlags;
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
	public $spellFamilyName;
	public $spellFamilyFlags;
};
