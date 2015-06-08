<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if(isset($_GET['condition']) && preg_match('/[0-9]+/', $_GET['condition'])
&& isset($_GET['type']) && preg_match('/[0-9]+/', $_GET['type']) 
&& isset($_GET['reverse']) && preg_match('/[0-9]+/', $_GET['reverse']) 
&& isset($_GET['1']) && preg_match('/[0-9]+/', $_GET['1']) 
&& isset($_GET['2']) && preg_match('/[0-9]+/', $_GET['2']) 
&& isset($_GET['3']) && preg_match('/[0-9]+/', $_GET['3']) ){
	$id				= htmlspecialchars($_GET['condition']);
	$type			= htmlspecialchars($_GET['type']);
	$reverse		= htmlspecialchars($_GET['reverse']);
	$value1			= htmlspecialchars($_GET['1']);
	$value2			= htmlspecialchars($_GET['2']);
	$value3			= htmlspecialchars($_GET['3']);
	
	$update     = $handler->prepare('UPDATE conditions 
									 SET ConditionTypeOrReference = :type,
									 	 ConditionValue1 = :value1,
									 	 ConditionValue2 = :value2,
									 	 ConditionValue3 = :value3,
									 	 NegativeCondition = :reverse
									 WHERE id = :id');
	$update->bindValue(':id', $id, PDO::PARAM_INT);
	$update->bindValue(':type', $type, PDO::PARAM_INT);
	$update->bindValue(':reverse', $reverse, PDO::PARAM_INT);
	$update->bindValue(':value1', $value1, PDO::PARAM_INT);
	$update->bindValue(':value2', $value2, PDO::PARAM_INT);
	$update->bindValue(':value3', $value3, PDO::PARAM_INT);
	$update->execute();
}