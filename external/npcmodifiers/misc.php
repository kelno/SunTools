<?php

require('../../dbconfig.php');

function getCreatureName($entry)
{
    global $handler;
    
	$query = $handler->prepare("SELECT name FROM creature_template WHERE entry = :entry");
    $query->bindValue(':entry', $entry, PDO::PARAM_INT);
    $query->execute();
	$data = $query->fetch();
    
	if($data == null)
	{
		echo "getCreatureName: creature not found";
		exit(1);
	}
	return $data[0];
}

function getClassName($id)
{
	switch ($id) {
		case "1":	return "Warrior"; break;
		case "2":	return "Paladin"; break;
		case "4":	return "Rogue"; break;
		case "8":	return "Mage"; break;
		default:	return "<error>";
	}
}

function getExpansionName($id)
{
	switch($id) {
		case "0":	return "Vanilla"; break;
		case "1":	return "Burning Crusade"; break;
		case "2":	return "Lich King"; break;
		default :	return "<error>";
	}
}