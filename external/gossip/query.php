<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(isset($_POST['guid']) && preg_match('/[0-9]+/', $_POST['guid'])) {
    $guid           = htmlentities($_POST['guid']);
    $getNameQuery   = $handler->prepare('SELECT ct.name
                                         FROM creature_template ct
                                         JOIN creature c ON c.id = ct.entry
                                         WHERE c.guid = :guid');
    $getNameQuery->bindValue(':guid', $guid, PDO::PARAM_INT);
    $getNameQuery->execute();
    $getName = $getNameQuery->fetch();
    
    echo $getName['name']; 
}