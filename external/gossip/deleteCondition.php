<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if(!isset($_GET['condition']) || !preg_match('/^[0-9]+$/', $_GET['condition']))
{
	http_response_code(400);
	die();
}

$id				= htmlspecialchars($_GET['condition']);

$select     	= $handler->prepare('SELECT id FROM conditions WHERE id = :id');
$select->bindValue(':id', $id, PDO::PARAM_INT);
$select->execute();

if($select->rowCount() != null) {
	$delete = $handler->prepare('DELETE FROM conditions WHERE id = :id');
	$delete->bindValue(':id', $id, PDO::PARAM_INT);
	$delete->execute();
}