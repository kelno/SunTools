<?php

/**
Table structure service.
Arguments : ? ? ?
*/

ini_set('display_errors', 'on');
error_reporting(E_ALL);

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require("$root/suntools/dbconfig.php");

//TODO : checks args 

$table = "test";

try 
{
    $handler = new PDO('mysql:host='.$host.';dbname='.$worlddb, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) 
{
    //echo $e->getMessage();
    die();
}

$fieldList = array();
foreach ($tables as $table)
{
    $query = $this->handler->prepare("DESCRIBE {$table}");
    $query->execute();
    $fieldList = array_merge($this->fieldList, $query->fetchAll(PDO::FETCH_COLUMN));
}

header('Content-type: application/json');
echo json_encode($fieldList);

?>