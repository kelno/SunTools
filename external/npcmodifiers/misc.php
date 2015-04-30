<?php

function getCreatureName($mysql, $entry)
{
	$queryStr = "SELECT name FROM creature_template WHERE entry = " . $entry;
	$query = mysql_query($queryStr);
	if (mysql_errno($mysql)) 
	{
		echo mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
		exit(1);
	}
	$data = mysql_fetch_array($query);
	if(!isset($data))
	{
		echo "getCreatureName : creature not found";
		exit(1);
	}
	return $data[0];
}

function getClassName($id)
{
	switch ($id) {
		case "1":	return "Warrior";
		case "2":	return "Paladin";
		case "4":	return "Rogue";
		case "8":	return "Mage";
		default:	return "<error>";
	}
}

function getExpansionName($id)
{
	switch($id) {
		case "0":	return "Vanilla";
		case "1":	return "Burning Crusade";
		case "2":	return "Lich King";
		default :	return "<error>";
	}
}

?>