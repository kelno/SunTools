<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

// Display the item infos
if(isset($_GET['item']) && preg_match('/[0-9]+/', $_GET['item'])) {
    $item           = htmlspecialchars($_GET['item']);
    $getInfosQuery  = $handler->prepare('SELECT name, displayid
                                         FROM item_template
                                         WHERE entry = :item');
    $getInfosQuery->bindValue(':item', $item, PDO::PARAM_INT);
    $getInfosQuery->execute();
    $getInfos = $getInfosQuery->fetch();
    
    $itemInfos = array(
        "name"      => $getInfos['name'],
        "display"   => $getInfos['displayid'],
    );
    
    echo json_encode($itemInfos); 
}