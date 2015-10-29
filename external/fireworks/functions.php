<?php


function getFirstFreeGroupID()
{
	require '../../dbconfig.php';

	try {
	    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
	    echo $e->getMessage();
	    die();
	}

	$query = $handler->prepare("SELECT max(groupid) FROM game_event_fireworks");
	$query->execute();
	if($data = $query->fetch())
			return $data[0] + 1;

	return 0;
}

?>
