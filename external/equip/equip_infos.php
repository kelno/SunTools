<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

// Display the entry's equipment_id infos
if(isset($_GET['entry']) && preg_match('/[0-9]+/', $_GET['entry'])) {
    $entry          = htmlspecialchars($_GET['entry']);
    $getInfosQuery  = $handler->prepare('SELECT name, equipment_id
                                         FROM creature_template
                                         WHERE entry = :entry');
    $getInfosQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getInfosQuery->execute();
    
    $itemInfos = array();
    
    $getInfos = $getInfosQuery->fetch();
    $itemInfos = array(
        "name"          => $getInfos['name'],
        "equipmentID"   => $getInfos['equipment_id']
    );
    
    
    $getEquipmentQuery  = $handler->prepare('SELECT id, equipmodel1, equipmodel2, equipmodel3,
                                                    equipinfo1, equipinfo2, equipinfo3,
                                                    equipslot1, equipslot2, equipslot3
                                            FROM creature_equip_template
                                            WHERE entry = :equipment_id');
    $getEquipmentQuery->bindValue(':equipment_id', $getInfos['equipment_id'], PDO::PARAM_INT);
    $getEquipmentQuery->execute();
    while($getEquipment = $getEquipmentQuery->fetch()) {
        $itemInfos['id'][$getEquipment['id']] = [
                                
                                    "mainhand"     => [
                                                            "displayid"     => $getEquipment['equipmodel1'],
                                                            "skill"         => $getEquipment['equipinfo1'],
                                                            "slot"          => $getEquipment['equipslot1']
                                                      ],
                                    "offhand"     => [
                                                            "displayid"     => $getEquipment['equipmodel2'],
                                                            "skill"         => $getEquipment['equipinfo2'],
                                                            "slot"          => $getEquipment['equipslot2']
                                                      ],
                                    "ranged"     => [
                                                            "displayid"     => $getEquipment['equipmodel3'],
                                                            "skill"         => $getEquipment['equipinfo3'],
                                                            "slot"          => $getEquipment['equipslot3']
                                                      ]
                                                ];
    }
    
    echo json_encode($itemInfos); 
}