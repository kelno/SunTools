<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               
	
try { 
	// Get a new menu id
	$select         = $handler->query('SELECT MAX(entry) as maxMenu FROM gossip_menu');
	$select->execute();
	$getSelect = $select->fetch();

	$maxMenu = $getSelect['maxMenu'] + 1;
	$Infos = [ "new"   => $maxMenu ];

	echo json_encode($Infos);
	
} catch (PDOException $e) {
  http_response_code(500);
  echo $e;
  die();
} 