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
&& isset($_POST['pathid']) && preg_match('/[0-9]+/', $_POST['pathid'])) {
    $pathID        = htmlspecialchars($_POST['pathid']);
    $entry         = htmlspecialchars($_POST['entry']);
    
    $getPointsQuery  = $handler->prepare('SELECT point, position_x, position_y, position_z
                                          FROM waypoint_data
                                          WHERE id = :pathID');
    $getPointsQuery->bindValue(':pathID', $pathID, PDO::PARAM_INT);
    $getPointsQuery->execute();
    
    while($getPoints = $getPointsQuery->fetch()) {
        $transferQuery = $handler ->prepare('INSERT INTO waypoints (entry, pointid, position_x, position_y, position_z)
                                             VALUES (:entry, :pointid, :position_x, :position_y, :position_z)');
        $transferQuery->bindValue(':entry',      $entry, PDO::PARAM_INT);
        $transferQuery->bindValue(':pointid',    $getPoints["point"], PDO::PARAM_INT);
        $transferQuery->bindValue(':position_x', $getPoints["position_x"], PDO::PARAM_INT);
        $transferQuery->bindValue(':position_y', $getPoints["position_y"], PDO::PARAM_INT);
        $transferQuery->bindValue(':position_z', $getPoints["position_z"], PDO::PARAM_INT);
        $transferQuery->execute();
    }
    header('Location: ./');
}