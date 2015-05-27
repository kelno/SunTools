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
&& isset($_GET['value'])){
    $guid           = htmlspecialchars($_GET['guid']);
    $menu           = htmlspecialchars($_GET['menu']);
    $text           = htmlspecialchars($_GET['value']);

    $insert         = $handler->prepare('INSERT INTO gossip_text (ID, text0_0)
                                         VALUES (:menu, :text)
                                         ON DUPLICATE KEY UPDATE text0_0 = :text');
    $insert->bindValue(':menu', $menu, PDO::PARAM_INT);
    $insert->bindValue(':text', $text, PDO::PARAM_STR);
    $insert->execute();
    
    $insert         = $handler->prepare('INSERT INTO gossip_menu (entry, text_id)
                                         VALUES (:menu, :menu)');
    $insert->bindValue(':menu', $menu, PDO::PARAM_INT);
    $insert->execute();
}