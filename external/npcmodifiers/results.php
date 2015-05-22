<?php

function printResultingStats($baseStats, $creatureModifiers)
{	
	//formula from core
	$attackpower       = $baseStats["ap"];
	$rangedattackpower = $baseStats["rangedap"];
	$apdamage          = ($attackpower / 14.0) * $creatureModifiers["attackspeed"];
	$rangeapdamage     = ($rangedattackpower / 14.0) * $creatureModifiers["rangedattackspeed"];
	$minDamage         = ($baseStats["damagebase"] + $apdamage) * $creatureModifiers["damage"];
	$maxDamage         = $minDamage * (1 + $creatureModifiers["basevariance"]);
	$minDamageRanged   = ($baseStats["damagebase"] + $rangeapdamage) * $creatureModifiers["damage"];
	$maxDamageRanged   = $minDamageRanged * (1 + $creatureModifiers["rangevariance"]);
	
	echo "<table border=1 class=\"full\">";
	echo "<tr><th>Health</th><th>Mana</th><th>Armor</th><th>AP</th><th>Ranged AP</th></tr>";
	echo "<tr>";
		echo "<td>". round($baseStats["health"] * $creatureModifiers["health"])."</td>";
		echo "<td>". round($baseStats["mana"] * $creatureModifiers["mana"]) ."</td>";
		echo "<td>". round($baseStats["armor"] * $creatureModifiers["armor"]) ."</td>";
		echo "<td>". round($attackpower) ."</td>";
		echo "<td>". round($rangedattackpower) ."</td>";
        echo "</tr></table>";
	
	echo "<br/>";
	
	echo "<table border=1 class=\"full\">";
	echo "<tr><th style=\"width: 80px;\"></th><th>DamageBase</th><th>AP Damage</th><th>DamageMin</th><th>DamageMax</th><th>AvgDPS</th></tr>";
	echo "<tr>";
		echo "<td>Melee</td>";
		echo "<td>". round($baseStats["damagebase"] * $creatureModifiers["damage"]) ."</td>";
		echo "<td>". round($apdamage * $creatureModifiers["damage"]) ."</td>";
		echo "<td>". round($minDamage) ."</td>";
		echo "<td>". round($maxDamage) ."</td>";
		echo "<td>". round( ($minDamage+$maxDamage)/2 / $creatureModifiers["attackspeed"]) . "</td>";
	echo "</tr><tr>";
		echo "<td>Ranged</td>";
		echo "<td>". round($baseStats["damagebase"] * $creatureModifiers["damage"]) ."</td>";
		echo "<td>". round($rangeapdamage * $creatureModifiers["damage"]) ."</td>";
		echo "<td>". round($minDamageRanged) ."</td>";
		echo "<td>". round($maxDamageRanged) ."</td>";
		echo "<td>". round( ($minDamageRanged+$maxDamageRanged)/2 / $creatureModifiers["rangedattackspeed"]) . "</td>";
	echo "</tr></table>";
}