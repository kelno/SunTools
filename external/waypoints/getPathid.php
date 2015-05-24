<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

// Display the pathid's number of points
if(isset($_GET['pathid']) && preg_match('/[0-9]+/', $_GET['pathid'])) {
    $pathID        = htmlspecialchars($_GET['pathid']);
    $getPointsQuery  = $handler->prepare('SELECT COUNT(point) as count
                                         FROM waypoint_data
                                         WHERE id = :pathID');
    $getPointsQuery->bindValue(':pathID', $pathID, PDO::PARAM_INT);
    $getPointsQuery->execute();
    $getPoints = $getPointsQuery->fetch();
    
    $Points = array(
        "pathid"    => $pathID,
        "points"    => $getPoints['count'],
    );
    
    echo json_encode($Points); 
}