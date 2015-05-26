<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(isset($_GET['guid']) && preg_match('/[0-9]+/', $_GET['guid'])) {
    $guid           = htmlspecialchars($_GET['guid']);
    
    // Get creature name
    $getNameQuery   = $handler->prepare('SELECT ct.name
                                         FROM creature_template ct
                                         JOIN creature c ON c.id = ct.entry
                                         WHERE c.guid = :guid');
    $getNameQuery->bindValue(':guid', $guid, PDO::PARAM_INT);
    $getNameQuery->execute();
    $getName = $getNameQuery->fetch();
    
    $Infos = [
        "name"  => $getName['name'],
        ];
    
    // Get guid menu(s)
    $getMenusQuery   = $handler->prepare('SELECT cg.menu_id as id
                                           FROM creature_gossip cg
                                           WHERE npc_guid = :guid');
    $getMenusQuery->bindValue(':guid', $guid, PDO::PARAM_INT);
    $getMenusQuery->execute();
    $getMenus = $getMenusQuery->fetchAll();
    
    foreach($getMenus as $key => $menu) {
        // Get gossip(s)
        $getMenusInfosQuery = $handler->prepare('SELECT text0_0 as text0,
                                                        text0_1 as text1
                                                FROM gossip_text
                                                WHERE ID = :id');
        $getMenusInfosQuery->bindValue(':id', $menu['id'], PDO::PARAM_INT);
        $getMenusInfosQuery->execute();
        
        while($getMenusInfos = $getMenusInfosQuery->fetch()) {
            // Get gossip option(s)
            $getOptionsQuery = $handler->prepare('SELECT id as option_id,
                                                         option_icon,
                                                         option_text,
                                                         action_menu_id as next_menu
                                                FROM gossip_menu_option
                                                WHERE menu_id = :id');
            $getOptionsQuery->bindValue(':id', $menu['id'], PDO::PARAM_INT);
            $getOptionsQuery->execute();
            $getOptions = $getOptionsQuery->fetchAll();
            
            $Infos["menus"][$key] = 
                [ 
                    "id"        => $menu['id'],
                    "gossip"    => [
                                        "text0" => $getMenusInfos['text0'],
                                        "text1" => $getMenusInfos['text1'],
                                    ],
                ];
            
            foreach($getOptions as $keyOpt => $option) {
                $Infos["menus"][$key]["options"][$keyOpt] = 
                    [
                        "id"    => $option['option_id'],
                        "icon"  => $option['option_icon'],
                        "text"  => $option['option_text'],
                        "next"  => $option['next_menu'],
                    ];
            }
        }
               
    }
    
    
    echo json_encode($Infos); 
}