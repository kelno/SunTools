<?php
require '../../dbconfig.php';

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if(      isset($_GET['entry'])       && preg_match('/[0-9]+/', $_GET['entry']) 
   && isset($_GET['equipmentid'])   && preg_match('/[0-9]+/', $_GET['equipmentid'])
   && isset($_GET['id'])            && preg_match('/[0-9]+/', $_GET['id'])
   && isset($_GET['weapon'])        && preg_match('/^(mh|oh|ranged)$/', $_GET['weapon'])
   && isset($_GET['info'])          && preg_match('/^(display|skill|slot)$/', $_GET['info'])
   && isset($_GET['value'])         && preg_match('/[0-9]+/', $_GET['value']) ) {
    $entry              = htmlspecialchars($_GET['entry']);
    $equipmentID        = htmlspecialchars($_GET['equipmentid']);
    $ID                 = htmlspecialchars($_GET['id']);
    $weapon             = htmlspecialchars($_GET['weapon']);
    $info               = htmlspecialchars($_GET['info']);
    $value              = htmlspecialchars($_GET['value']);
	
    switch($weapon) {
        case "mh":     switch($info) { case "display":  $column = "equipmodel1"; break;
                                       case "skill":    $column = "equipinfo1"; break;
                                       case "slot":     $column = "equipslot1"; break;
                                       default: return;
                                     }
                       break;
        case "oh":     switch($info) { case "display":  $column = "equipmodel2"; break;
                                       case "skill":    $column = "equipinfo2"; break;
                                       case "slot":     $column = "equipslot2"; break;
                                       default: return;
                                     }
                       break;
        case "ranged": switch($info) { case "display":  $column = "equipmodel3"; break;
                                       case "skill":    $column = "equipinfo3"; break;
                                       case "slot":     $column = "equipslot3"; break;
                                       default: return;
                                     }
                       break;
        default:       return;
    }
    
    $insert   = $handler->prepare('INSERT INTO creature_equip_template (entry, id, ' . $column . ')
				                   VALUE (:equipment_id, :id , :value)
								   ON DUPLICATE KEY UPDATE ' . $column . ' = :value');
    $insert->bindValue(':equipment_id', $equipmentID, PDO::PARAM_INT);
    $insert->bindValue(':id', $ID, PDO::PARAM_INT);
    $insert->bindValue(':value', $value, PDO::PARAM_INT);
    $insert->execute();
    
    $update   = $handler->prepare('UPDATE creature_template 
                                   SET equipment_id = :equipment_id
				                   WHERE entry = (CASE WHEN @entry = 0 THEN :entry ELSE @entry END)');
    $update->bindValue(':entry', $entry, PDO::PARAM_INT);
    $update->bindValue(':equipment_id', $equipmentID, PDO::PARAM_INT);
    $update->execute();
}

if(isset($_GET['item']) && preg_match('/[0-9]+/', $_GET['item'])) {
    $item           = htmlspecialchars($_GET['item']);
    $getInfosQuery  = $handler->prepare('SELECT name, displayid, class, subclass, InventoryType
                                         FROM item_template
                                         WHERE entry = :item');
    $getInfosQuery->bindValue(':item', $item, PDO::PARAM_INT);
    $getInfosQuery->execute();
    $getInfos = $getInfosQuery->fetch();
    
    $equipInfo = $getInfos['class'] + $getInfos['subclass'] * 256;
    
    $itemInfos = array(
        "name"      => $getInfos['name'],
        "display"   => $getInfos['displayid'],
        "skill"     => $equipInfo,
        "slot"      => $getInfos['InventoryType']
    );
    
    echo json_encode($itemInfos); 
}

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