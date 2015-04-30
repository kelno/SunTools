<?php
require('../../../dbconfig.php');
try 
{
    $handler = new PDO('mysql:host='.$host.';dbname='.$worlddb, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) 
{
    //echo $e->getMessage();
    die();
}

if(isset($_GET['id']) && preg_match('/[0-9]+/', $_GET['id'])) 
{
    $id             = htmlspecialchars($_GET['id']);
    $query          = $handler->prepare('SELECT *
                                         FROM gossip_text gt
                                         LEFT JOIN locales_gossip_text lgt ON lgt.id = gt.ID
                                         WHERE gt.ID = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    
    header('Content-type: application/json');
	echo json_encode($result);
}