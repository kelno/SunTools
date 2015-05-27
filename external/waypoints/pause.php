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
if(isset($_POST['entry']) && preg_match('/[0-9]+/', $_POST['entry'])
&& isset($_POST['pathid']) && preg_match('/[0-9]+/', $_POST['pathid'])
&& isset($_POST['delay']) && preg_match('/[0-9]+/', $_POST['delay']) && $_POST['delay'] < 0) {
    $pathID        = htmlspecialchars($_POST['pathid']);
    $entry         = htmlspecialchars($_POST['entry']);
    $delay         = htmlspecialchars($_POST['delay']);
    
    // Comment
    $update       = $handler->prepare('UPDATE waypoint_data SET delay = :delay WHERE id = :pathID AND point = :point;');
    $update->bindValue(':entry', $entry, PDO::PARAM_INT);
    $update->bindValue(':pathID', $pathID, PDO::PARAM_INT);
    $update->bindValue(':point', $delay, PDO::PARAM_INT);
    $update->execute();
    
    header('Location: ./');
}