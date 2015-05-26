<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(isset($_GET['menu']) && preg_match('/[0-9]+/', $_GET['menu']
&& isset($_GET['id']) && preg_match('/[0-9]+/', $_GET['id'])
&& isset($_GET['info']) && preg_match('/[a-z]+/', $_GET['info'])
&& isset($_GET['value'])){
    $menu           = htmlspecialchars($_GET['menu']);
    $id             = htmlspecialchars($_GET['id']);
    $info           = htmlspecialchars($_GET['info']);
    $text           = htmlspecialchars($_GET['value']);
    
    switch($info) {
        case "icon": $field = "option_icon"; break;
        case "text": $field = "option_text"; break;
        case "next": $field = "action_menu_id"; break;
        case "delete": break;
        default: return;
    }
    
    $select     = $handler->prepare('SELECT menu_id, id FROM gossip_menu_option WHERE menu_id = :menu AND id = :id');
    $select->bindValue(':menu', $menu, PDO::PARAM_INT);
    $select->bindValue(':id', $id, PDO::PARAM_INT);
    $select->execute();
    
    if($info == "delete") {
        if($select->rowCount() != null) {
            $delete     = $handler->prepare('DELETE FROM gossip_menu_option WHERE menu_id = :menu AND id = :id');
            $delete->bindValue(':menu', $menu, PDO::PARAM_INT);
            $delete->bindValue(':id', $id, PDO::PARAM_INT);
            $delete->execute();
        }
    } else {
        if($select->rowCount() != null) {
            $update         = $handler->prepare('UPDATE gossip_menu_option SET ' . $field . ' = :value WHERE menu_id = :menu AND id = :id');
            $update->bindValue(':menu', $menu, PDO::PARAM_INT);
            $update->bindValue(':id', $id, PDO::PARAM_INT);
            $update->bindValue(':value', $value, PDO::PARAM_STR);
            $update->execute();
        } else {
            $update         = $handler->prepare('INSERT INTO gossip_menu_option (menu_id, id, option_icon, option_text, OptionBroadcastTextID, option_id, npc_option_npcflag, action_menu_id, action_poi_id, box_coded, box_money, box_text, BoxBroadcastTextID) VALUES
                                                (:menu, :id, 0, "", 0, 1, 1, 0, 0, 0, 0, NULL, 0');
            $update->bindValue(':menu', $menu, PDO::PARAM_INT);
            $update->bindValue(':id', $id, PDO::PARAM_INT);
            $update->execute();
        }
    }
}