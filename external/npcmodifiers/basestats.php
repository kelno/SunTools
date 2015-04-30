<?php

/* return 
$baseStatsInfo = [
	"level" =>     $data[0],
	"class" =>     $data[1],
	"expansion" => $data[2],
];
*/
function getBaseStatsInfo($mysql, $entry)
{
	$queryStr = "SELECT minlevel, unit_class, exp  FROM creature_template WHERE entry = " . $entry;
	$query = mysql_query($queryStr);
	if (mysql_errno($mysql)){
		echo "printBaseStatsForCreatureByEntry : " . mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
		return;
	}

	if ($data = mysql_fetch_array($query)) {
		$baseStatsInfo = [
			"level" =>     $data[0],
			"class" =>     $data[1],
			"expansion" => $data[2],
		];
		return $baseStatsInfo;
	} else {
		echo "Base stats : Creature template not found";
		exit(1);
	}
}

/*return 
$baseStats = [
			"health"        => $data[0],
			"mana"          => $data[1],
			"armor"         => $data[2],
			"ap"            => $data[3],
			"rangedap"      => $data[4],
			"damagebase"    => $data[5],
		];
*/
function getBaseStats($mysql, $level, $class, $exp)
{
	$hpfield = "basehp" . $exp;
	
	if($exp == 0)
		$damagefield = "damage_base";
	else		
		$damagefield = "damage_exp". $exp;
	
	$queryStr = "SELECT " . $hpfield . ", basemana, basearmor, attackpower, rangedattackpower, " . $damagefield . 
	            " FROM creature_classlevelstats " .
                " WHERE level = ".$level." AND class = ".$class;
	$query = mysql_query($queryStr);
	if (mysql_errno($mysql)){
		echo "getBaseStatsForCreature : " . mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
		exit(1);
	}

	if ($data = mysql_fetch_array($query)) {
		$baseStats = [
			"health"        => $data[0],
			"mana"          => $data[1],
			"armor"         => $data[2],
			"ap"            => $data[3],
			"rangedap"      => $data[4],
			"damagebase"    => $data[5]
		];
		return $baseStats;
	} else {
		echo "getBaseStats : could not find base stats for given values.";
		exit(1);
	}
}

function printBaseStats($baseStats)
{		
	echo "<table border=1 class=\"full\">";
	echo "<tr><th>Base health</th><th>Base Mana</th><th>Base Armor</th><th>AP</th><th>Ranged AP</th><th>Damage Base</th></tr>";
	echo "<tr>";
		echo "<td>".$baseStats["health"]."</td>";
		echo "<td>".$baseStats["mana"]."</td>";
		echo "<td>".$baseStats["armor"]."</td>";
		echo "<td>".$baseStats["ap"]."</td>";
		echo "<td>".$baseStats["rangedap"]."</td>";
		echo "<td>".$baseStats["damagebase"]."</td>";
	echo "</tr>";
	echo "</table>";
}

?>