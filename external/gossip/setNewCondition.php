<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if(	!isset($_GET['source']) || !preg_match('/^[0-9]+$/', $_GET['source'])
	|| !isset($_GET['menu']) || !preg_match('/^[0-9]+$/', $_GET['menu']) 
	|| !isset($_GET['option']) || !preg_match('/^[0-9]+$/', $_GET['option']) 
	|| ($_GET['menu'] == 0)
	)
{
	http_response_code(400);
	die();
}

$source			= htmlspecialchars($_GET['source']);
$menu			= htmlspecialchars($_GET['menu']);
$option			= htmlspecialchars($_GET['option']);

// Get a new condition id
$select         = $handler->query('SELECT MAX(id) as id FROM conditions');
$select->execute();
$getSelect = $select->fetch();

$new = $getSelect['id'] + 1;

if($source == 14) {
	$insert			= $handler->prepare('INSERT INTO conditions (id, SourceTypeOrReferenceId, SourceGroup, SourceEntry, SourceId, ConditionTypeOrReference, ConditionTarget, ConditionValue1, ConditionValue2, ConditionValue3, NegativeCondition, ErrorType, ErrorTextID, ScriptName)
									 VALUES (:id, :source, :group, :entry, 0, 0, 0, 0, 0, 0, 0, 0, 0, "")');
	$insert->bindValue(':id', $new, PDO::PARAM_INT);
	$insert->bindValue(':source', $source, PDO::PARAM_INT);
	$insert->bindValue(':group', $menu, PDO::PARAM_INT);
	$insert->bindValue(':entry', $menu, PDO::PARAM_INT);
	$insert->execute();
}

if($source == 15) {
	$insert			= $handler->prepare('INSERT INTO conditions (id, SourceTypeOrReferenceId, SourceGroup, SourceEntry, SourceId, ConditionTypeOrReference, ConditionTarget, ConditionValue1, ConditionValue2, ConditionValue3, NegativeCondition, ErrorType, ErrorTextID, ScriptName)
									 VALUES (:id, :source, :group, :entry, 0, 0, 0, 0, 0, 0, 0, 0, 0, "")');
	$insert->bindValue(':id', $new, PDO::PARAM_INT);
	$insert->bindValue(':source', $source, PDO::PARAM_INT);
	$insert->bindValue(':group', $menu, PDO::PARAM_INT);
	$insert->bindValue(':entry', $option, PDO::PARAM_INT);
	$insert->execute();
}

$Infos = [ 
	"id" 		=> $new, 
	"source"	=> $source,
	"menu"		=> $menu,
	"option"	=> $option,
];
	
echo json_encode($Infos);