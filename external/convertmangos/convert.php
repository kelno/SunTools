<?php
require('../../dbconfig.php');

// WriteObjects

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=convert", $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

$query = $handler->prepare("SELECT guid, charges, enchantments  FROM item_instance");
$query->bindValue(':entry', htmlspecialchars($entry), PDO::PARAM_INT);
$query->execute();

$fileHandle = fopen("convert.sql", "w+");

while ($data = $query->fetch()) {
	$guid             = $data[0];
	$chargesBlob      = $data[1];
	$enchantmentsBlob = $data[2];
	
	$fields = "";
	$enchantments = explode(" ", $enchantmentsBlob);
	$chargesArray = explode(" ", $chargesBlob);
	for ($i = 0; $i < 7; $i++)
	{
		if ($i <= 1) // TEMP_ENCHANTMENT_SLOT
			$new = $i+1;
		else if ($i == 2)
			$new = $i+1; //ok?
		else //PROP_ENCHANTMENT_SLOT_0  3 -> 7
			$new = $i + 4 + 1;
		
		if($id = $enchantments[$i * 3 + 0])
		{
			$fieldName1 = "enchant" . $new . "_id";
			$fields .= $fieldName1 . " = " . $id . ', ';
		}
		if($duration = $enchantments[$i * 3 + 1])
		{
			$fieldName2 = "enchant" . $new. "_duration";
			$fields .= $fieldName2 . " = " . $duration . ', ';
		}
		if($charges = $enchantments[$i * 3 + 2])
		{
			$fieldName3 = "enchant" . $new . "_charges";
			$fields .= $fieldName3 . " = " . $charges . ', ';
		}
	}
	for ($i = 0; $i < 5; $i++)
	{
		if ($charges = $chargesArray[$i])
		{
			$fieldName1 = "spell" . strval ($i +1) . "_charges";
			$fields .= $fieldName1 . " = " . $charges . ', ';
		}
	}
	
	if ($fields != "")
	{
		$fields = substr_replace($fields, "", -2); //remove last space+comma
		
		$sql = "UPDATE item_instance SET $fields WHERE guid = " . $guid . ';' . PHP_EOL;
		fwrite($fileHandle, $sql);
	}
}