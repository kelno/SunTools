<?php

include ('config.php');

function resetEntry($mysql, $entry)
{
	include ('config.php');
	$queryStr = 
		    "UPDATE " . $worlddb . ".creature_template sct " .
			"JOIN " . $backupworld . ".creature_template 2ct ON 2ct.entry = sct.entry AND sct.entry = " . $entry . " " .
			"SET sct.exp = 2ct.exp, " .
			"sct.unit_class = 2ct.unit_class," .
			"sct.HealthModifier = 2ct.HealthModifier, " .
			"sct.ManaModifier = 2ct.ManaModifier, " .
			"sct.ArmorModifier = 2ct.ArmorModifier, " .
			"sct.DamageModifier = 2ct.DamageModifier, " .
			"sct.ExperienceModifier = 2ct.ExperienceModifier, " .
			"sct.BaseVariance = 2ct.BaseVariance, " .
			"sct.RangeVariance = 2ct.RangeVariance; ";
		   
	$query = mysql_query($queryStr);
	if (mysql_errno($mysql)){
		echo "resetEntry : " . mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
		exit(1);
	}
}

if(isset($_GET["entry"]))
{
	$mysql = mysql_connect($host, $user, $password);
	$db = mysql_select_db($worlddb, $mysql); 
	if (mysql_errno($mysql)) 
	{
		echo "resetentry.php : " . mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
		exit(1);
	}

	resetEntry($mysql, $_GET["entry"]);
	
}

header('Location: '. "index.php?entry=" . $_GET["entry"]);
	
	
?>