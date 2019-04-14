<?php

function getStats($baseStats, $creatureModifiers)
{
	//formula from core
	$attackpower       = $baseStats["ap"];
	$rangedattackpower = $baseStats["rangedap"];
	$attackspeed       = $creatureModifiers["attackspeed"];
	$apdamage          = ($attackpower / 14.0) * $attackspeed;
	$rangeapdamage     = ($rangedattackpower / 14.0) * $attackspeed;
	$minDamage         = ($baseStats["damagebase"] + $apdamage) * $creatureModifiers["damage"];
	$maxDamage         = $minDamage * (1 + $creatureModifiers["basevariance"]);
	$minDamageRanged   = ($baseStats["damagebase"] + $rangeapdamage) * $creatureModifiers["damage"];
	$maxDamageRanged   = $minDamageRanged * (1 + $creatureModifiers["rangevariance"]);
	
	$results = [
		"minDamage"       => $minDamage,
		"maxDamage"       => $maxDamage,
		"minDamageRanged" => $minDamageRanged,
		"maxDamageRanged" => $maxDamageRanged,
		"apdamage"        => $apdamage,
		"rangeapdamage"   => $rangeapdamage,
	];
	return $results;
}

function printResultingStats($baseStats, $creatureModifiers)
{	
	$attackpower       = $baseStats["ap"];
	$rangedattackpower = $baseStats["rangedap"];
	
	echo "<table border=1 class=\"full\">";
	echo "<tr><th>Health</th><th>Mana</th><th>Armor</th><th>AP</th><th>Ranged AP</th></tr>";
	echo "<tr>";
		echo "<td>". round($baseStats["health"] * $creatureModifiers["health"])."</td>";
		echo "<td>". round($baseStats["mana"]   * $creatureModifiers["mana"]) ."</td>";
		echo "<td>". round($baseStats["armor"]  * $creatureModifiers["armor"]) ."</td>";
		echo "<td>". round($attackpower) ."</td>";
		echo "<td>". round($rangedattackpower) ."</td>";
        echo "</tr></table>";
	
	echo "<br/>";
	
	$stats = getStats($baseStats, $creatureModifiers);
	$resultMin = $stats["minDamage"];
	$resultMax = $stats["maxDamage"];
	$resultMinRanged = $stats["minDamageRanged"]; 
	$resultMaxRanged = $stats["maxDamageRanged"];
	
	echo "<table border=1 class=\"full\">";
	echo "<tr><th style=\"width: 80px;\"></th><th>DamageBase</th><th>AP Damage</th><th>DamageMin</th><th>DamageMax</th><th>AvgDPS</th></tr>";
	echo "<tr>";
		echo "<td>Melee</td>";
		echo "<td>". round($baseStats["damagebase"] * $creatureModifiers["damage"]) ."</td>";
		echo "<td>". round($stats["apdamage"] * $creatureModifiers["damage"]) ."</td>";
		echo "<td>". round($resultMin) ."</td>";
		echo "<td>". round($resultMax) ."</td>";
		echo "<td>". round( ($resultMin+$resultMax)/2) . "</td>";
	echo "</tr><tr>";
		echo "<td>Ranged</td>";
		echo "<td>". round($baseStats["damagebase"] * $creatureModifiers["damage"]) ."</td>";
		echo "<td>". round($stats["rangeapdamage"] * $creatureModifiers["damage"]) ."</td>";
		echo "<td>". round($resultMinRanged) ."</td>";
		echo "<td>". round($resultMaxRanged) ."</td>";
		echo "<td>". round( ($resultMinRanged+$resultMaxRanged)/2 ) . "</td>";
	echo "</tr></table>";
}