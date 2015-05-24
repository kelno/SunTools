<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

// Display the entry's name
if(isset($_GET['entry']) && preg_match('/[0-9]+/', $_GET['entry'])) {
    $entry          = htmlspecialchars($_GET['entry']);
    $getNameQuery  = $handler->prepare('SELECT name
                                         FROM creature_template
                                         WHERE entry = :entry');
    $getNameQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getNameQuery->execute();
    $getName = $getNameQuery->fetch();
    
    $getFreeQuery  = $handler->prepare('SELECT entry
                                         FROM waypoints
                                         WHERE entry = :entry');
    $getFreeQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getFreeQuery->execute();
    
    $free = $getFreeQuery->rowCount() > 0 ? false : true;
    
    $Infos = array(
        "name"  => $getName['name'],
        "free"  => $free,
    );
    
    echo json_encode($Infos); 
}