<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

// Remove an equipment_id
if(   (isset($_GET['equipmentid'])    && preg_match('/[0-9]+/', $_GET['equipmentid']))
   && (isset($_GET['id'])             && preg_match('/[0-9]+/', $_GET['id'])) ) {
    $equipmentid    = htmlspecialchars($_GET['equipmentid']);
    $id             = htmlspecialchars($_GET['id']);
    
    $delete         = $handler->query('DELETE FROM creature_equip_template WHERE entry = :entry AND id = :id');
    $delete->bindValue(':entry', $equipmentid, PDO::PARAM_INT);
    $delete->bindValue(':id', $id, PDO::PARAM_INT);
    $delete->execute();
}