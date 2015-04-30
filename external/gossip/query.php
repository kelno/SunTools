<?php
try {
    $handler = new PDO('mysql:host=62.210.236.104;dbname=world', 'nastyadmin', 'Z9EuAAtxPtA5gt3F');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(isset($_POST['guid']) && preg_match('/[0-9]+/', $_POST['guid'])) {
    $guid           = htmlentities($_POST['guid']);
    $getNameQuery   = $handler->prepare('SELECT ct.name
                                         FROM creature_template ct
                                         WHERE entry = :guid');
    $getNameQuery->bindValue(':guid', $guid, PDO::PARAM_INT);
    $getNameQuery->execute();
    $getName = $getNameQuery->fetch();
    
    echo $getName['name']; 
}
?>