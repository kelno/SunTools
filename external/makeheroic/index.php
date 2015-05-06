<!DOCTYPE html>
<?php

// TODO
function isCivilian($mysql,$entry)
{
   return 0;
}

/*$mysql = mysql_connect('sql31.free-h.org:3306', 'canardwc42', 'barbecue42');
$db = mysql_select_db("canardbd", $mysql);*/
	$mysql = mysql_connect('localhost:3306', 'root', 'canard');
	$db = mysql_select_db("wrworld", $mysql);
if (mysql_errno($mysql)){
	if (mysql_errno($mysql)){
		echo mysql_errno($mysql) . ": " . mysql_error($mysql). "<br>";
		return(1);
	}
}

mysql_query("set names 'utf8'");

$map = (int)($_POST['map']);

if($map) {
	$damageRate = (int)($_POST['damageRate']);
	$hpRate = (int)($_POST['hpRate']);
	$startingId = (int)($_POST['startingId']);
	$respawnDelay = (int)($_POST['respawnDelay']);
	$armorRate = (int)($_POST['armorRate']);
	$customID = (int)($_POST['customID']);
}

if (!$map) {
	//formulaire
	include ('qg.php');
} else {
$currentId = $startingId;
//get npc's present in map
$customIDStr = "";
if ($customID){
	$customIDStr = " OR id IN (" . $customID . ")";
}
$queryStr = "SELECT DISTINCT id FROM creature WHERE map = $map" . $customIDStr . " ORDER BY id";
$query = mysql_query($queryStr);
if (mysql_errno($mysql)){
	echo mysql_errno($mysql) . ": " . mysql_error($mysql). "<br>";
	return(1);
}
while ($data = mysql_fetch_array($query)) {
	$creatureEntry = $data[0];
	if(isCivilian($mysql,$creatureEntry))
		continue;
		
	if($creatureEntry) {
	echo "/* -- Create new creature $currentId from base $creatureEntry -- */<br>";
	echo "
	REPLACE INTO creature_template
	SELECT '$currentId',`heroic_entry`,`modelid_A`,`modelid_A2`,`modelid_H`,`modelid_H2`,CONCAT(`name`,' (heroic)'),`subname`,`IconName`,'70','70',`minhealth`*$hpRate,`maxhealth`*$hpRate,`minmana`*$hpRate,`maxmana`*$hpRate,`armor`*$armorRate,`faction_A`,`faction_H`,`npcflag`,`speed`,`scale`,`rank`,`mindmg`*$damageRate,`maxdmg`*$damageRate,`dmgschool`,`attackpower`*$damageRate,`baseattacktime`,`rangeattacktime`,`unit_flags`,`dynamicflags`,`family`,`trainer_type`,`trainer_spell`,`class`,`race`,`minrangedmg`*$damageRate,`maxrangedmg`*$damageRate,`rangedattackpower`*$damageRate,`type`,`type_flags`,`lootid`,`pickpocketloot`,`skinloot`,`resistance1`,`resistance2`,`resistance3`,`resistance4`,`resistance5`,`resistance6`,`spell1`,`spell2`,`spell3`,`spell4`,`spell5`,`spell6`,`spell7`,`spell8`,`PetSpellDataId`,`mingold`,`maxgold`,`AIName`,`MovementType`,`InhabitType`,`RacialLeader`,`RegenHealth`,`equipment_id`,`mechanic_immune_mask`,`flags_extra`,`ScriptName`,`pool_id` FROM creature_template WHERE entry = $creatureEntry;<br>";
	
	echo "/* Copy creature_template_addon */<br>";
	echo "
	REPLACE INTO creature_template_addon
	SELECT '$currentId', `path_id`, `mount`, `bytes0`, `bytes1`, `bytes2`, `emote`, `moveflags`, `auras` FROM creature_template_addon WHERE entry = $creatureEntry;<br>";
	
	echo "/* Replace heroicEntry */<br>";
	echo "UPDATE creature_template set heroic_entry = $currentId where entry = $creatureEntry;<br>";
	
	echo "/* Update eventAI scripts */<br>";
	$queryStr = "SELECT id,event_flags FROM eventai_scripts WHERE creature_id = $creatureEntry ORDER BY id;";
	$queryEAI = mysql_query($queryStr);
	if (mysql_errno($mysql)){
		echo mysql_errno($mysql) . ": " . mysql_error($mysql). "<br>";
		return(1);
	}
	while ($dataEAI = mysql_fetch_array($queryEAI)) {
		$EAI_Id = $dataEAI[0];
		$EAI_Flags = $dataEAI[1];
		if($EAI_Id && !($EAI_Flags&4) ) {
			//event_flags`&0x4 c'est pour EFLAG_HEROIC
			echo "UPDATE eventai_scripts
			SET event_flags = (event_flags + 0x04)
			WHERE id = $EAI_Id;<br>";
		}
	}
	
	echo "/* -- Creature $currentId end -- */<br><br>";
	}
	$currentId = $currentId + 1;	
}

echo "/* Replace spawnMask's */<br>";
echo "UPDATE creature SET spawnMask = 3 WHERE map = $map;<br>";
echo "UPDATE gameobject SET spawnMask = 3 WHERE map = $map;<br>";
echo "/* Set reset delay */<br>";
echo "UPDATE instance_template SET customHeroicReset = $respawnDelay WHERE map = $map;<br><br><br>";

echo "<h1> CLEANING </h1>";
echo "UPDATE creature_template SET heroic_entry = 0 WHERE IN (SELECT DISTINCT id FROM creature WHERE map = $map);<br>";
echo "DELETE FROM creature_template where entry <= $currentId && entry >= $startingId;<br>";
echo "DELETE FROM creature_template_addon where entry <= $currentId && entry >= $startingId;<br>";
echo "UPDATE eventai_scripts SET event_flags = (event_flags - 0x04) WHERE creature_id IN (SELECT DISTINCT id FROM creature WHERE map = $map) AND event_flags&4;<br>";
}
?>