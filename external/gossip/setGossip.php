<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(isset($_GET['guid']) && preg_match('/[0-9]+/', $_GET['guid'])
&& isset($_GET['menu']) && preg_match('/[0-9]+/', $_GET['menu'])
&& isset($_GET['value'])) {
    $guid           = htmlspecialchars($_GET['guid']);
    $menu           = htmlspecialchars($_GET['menu']);
    $text           = htmlspecialchars($_GET['value']);

    $insertText         = $handler->prepare('INSERT INTO gossip_text (ID, text0_0)
                                             VALUES (:menu, :text)
                                             ON DUPLICATE KEY UPDATE text0_0 = :text');
    $insertText->bindValue(':menu', $menu, PDO::PARAM_INT);
    $insertText->bindValue(':text', $text, PDO::PARAM_STR);
    $insertText->execute();
    
    $insertMenu         = $handler->prepare('INSERT INTO gossip_menu (entry, text_id)
                                             VALUES (:menu, :menu2)
                                             ON DUPLICATE KEY UPDATE entry = :menu');
    $insertMenu->bindValue(':menu', $menu, PDO::PARAM_INT);
    $insertMenu->bindValue(':menu2', $menu, PDO::PARAM_INT);
    $insertMenu->execute();
    
    $check          = $handler->prepare('SELECT * FROM creature_gossip WHERE npc_guid = :guid');
    $check->bindValue(':guid', $guid, PDO::PARAM_INT);
    $check->execute();
    
    if($check->rowCount() == null) {
        $insert         = $handler->prepare('INSERT INTO creature_gossip (menu_id, npc_guid)
                                             VALUES (:menu, :guid)');
        $insert->bindValue(':menu', $menu, PDO::PARAM_INT);
        $insert->bindValue(':guid', $guid, PDO::PARAM_INT);
        $insert->execute();
    }
        
}