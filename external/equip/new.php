<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

// Add a new equipment_id
if(   (isset($_GET['entry'])          && preg_match('/[0-9]+/', $_GET['entry']))
   && (isset($_GET['newequipmentid']) && preg_match('/(true)/', $_GET['newequipmentid'])) ) {
    $entry          = htmlspecialchars($_GET['entry']);
    
    // Get a new equipment_id
    $select         = $handler->query('SELECT MAX(entry) as maxEntry FROM creature_equip_template');
    $select->execute();
    $getSelect = $select->fetch();
    
    $maxEntry = $getSelect['maxEntry'] + 1;
    
    // Get the creature name
    $query         = $handler->prepare('SELECT name FROM creature_template WHERE entry = :entry');
    $query->bindValue(':entry', $entry, PDO::PARAM_INT);
    $query->execute();
    $getName = $query->fetch();
    
    // Create a new entry in creature_equip_template with the new equipment_id
    $insert         = $handler->prepare('INSERT INTO creature_equip_template (entry) VALUES (:maxEntry)');
    $insert->bindValue(':maxEntry', $maxEntry, PDO::PARAM_INT);
    $insert->execute();
    
    // Update creature_template with the new equipment_id
    $update         = $handler->prepare('UPDATE creature_template
                                         SET equipment_id = :maxEntry
                                         WHERE entry = :entry');
    $update->bindValue(':maxEntry', $maxEntry, PDO::PARAM_INT);
    $update->bindValue(':entry', $entry, PDO::PARAM_INT);
    $update->execute();
    
    $itemInfos = array(
        "name"          => $getName['name'],
        "equipmentID"   => $maxEntry,
        "id"    => [
                                
                        "mainhand"     => [
                                                "displayid"     => "",
                                                "skill"         => null,
                                                "slot"          => "0"
                                          ],
                        "offhand"     => [
                                                "displayid"     => "",
                                                "skill"         => null,
                                                "slot"          => "0"
                                          ],
                        "ranged"     => [
                                                "displayid"     => "",
                                                "skill"         => null,
                                                "slot"          => "0"
                                          ]
                    ],
    );
    
    echo json_encode($itemInfos);
}