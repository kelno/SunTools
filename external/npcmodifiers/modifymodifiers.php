<?php

/* return 
$baseStatsInfo = [
	"level" =>     $data[0],
	"class" =>     $data[1],
	"expansion" => $data[2],
];
*/
function udpateModifiers($mysql, $GET)
{
	$queryStr = 
		     "UPDATE creature_template SET "
		   . "exp = "                . $GET["expansion"]         . ","
		   . "HealthModifier = "     . $GET["health"]            . ","
		   . "ManaModifier = "       . $GET["mana"]              . ","
		   . "ArmorModifier = "      . $GET["armor"]             . ","
		   . "DamageModifier = "     . $GET["damage"]            . ","
		   . "ExperienceModifier = " . $GET["experience"]        . ","
		   . "BaseVariance = "       . $GET["basevariance"]      . ","
		   . "RangeVariance = "      . $GET["rangevariance"]     . ","
		   . "unit_class = "         . $GET["class"]             . ","
		   . "BaseAttackTime = "     . $GET["attackspeed"]*1000       . ","
		   . "RangeAttackTime = "    . $GET["rangedattackspeed"]*1000 . " "
		   . "WHERE entry = " . $GET["entry"];
		   
	$query = mysql_query($queryStr);
	if (mysql_errno($mysql)){
		echo "udpateModifiers : " . mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
		exit(1);
	}
	
	header('Location: '. "index.php?entry=" . $GET["entry"]);
}

?>