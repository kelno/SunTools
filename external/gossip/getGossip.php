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
    
    $getMenu        = $handler->prepare('SELECT cg.menu_id as id, ct.name
                                         FROM creature_gossip cg
                                         JOIN creature c            ON cg.npc_guid = c.guid
                                         JOIN creature_template ct  ON ct.entry = c.id
                                         WHERE npc_guid = :guid');
    $getMenu->bindValue(':guid', $guid, PDO::PARAM_INT);
    $getMenu->execute();
    $menu = $getMenu->fetch();
    
     $Infos = [
            "name"      =>  $menu['name'],
              ];
    
    
    $getPrincipal   = $handler->prepare('SELECT cg.menu_id,
                                                gt.text0_0, gt.text0_1,
                                                gmo.id, gmo.option_icon, gmo.option_text, gmo.action_menu_id
                                         FROM creature_gossip cg
                                         JOIN gossip_menu gm            ON gm.entry = cg.menu_id
                                         JOIN gossip_text gt            ON gt.ID = gm.text_id
                                         JOIN gossip_menu_option gmo    ON cg.menu_id = gmo.menu_id
                                         WHERE cg.menu_id = :menu');
    $getPrincipal->bindValue(':menu', $menu['id'], PDO::PARAM_INT);
    $getPrincipal->execute();
    $principal = $getPrincipal->fetchAll();
    
    foreach($principal as $menu) {
        $Infos["menu"] = [
                    "id"        =>  $menu['menu_id'],
                    "gossip"    =>  [
                            "text0"     => $menu['text0_0'],
                            "text1"     => $menu['text0_1'],
                                    ],
                         ];
    }
    
    foreach ($principal as $key => $option) {
        $Infos["menu"]["options"][$key] = [
                    "id"        => $option['id'],
                    "icon"      => $option['option_icon'],
                    "text"      => $option['option_text'],
                    "next"      => $option['action_menu_id'],
                                          ];
    }
    
    // Get submenus
    foreach($principal as $key2 => $subgossip) {
        $getSubs        = $handler->prepare('SELECT gm.entry as menu_id,
                                                    gt.text0_0, gt.text0_1,
                                                    gmo.id, gmo.option_icon, gmo.option_text, gmo.action_menu_id
                                             FROM gossip_menu gm
                                             JOIN gossip_text gt            ON gt.ID = gm.text_id
                                             JOIN gossip_menu_option gmo    ON gm.entry = gmo.menu_id
                                             WHERE gm.entry = :submenu');
        $getSubs->bindValue(':submenu', $subgossip['action_menu_id'], PDO::PARAM_INT);
        $getSubs->execute();
        $subs = $getSubs->fetchAll();

        // Get submenus gossip
        foreach($subs as $menukey => $submenu) {
            $Infos["submenu"][$menukey] = [
                    "id"        =>  $submenu['menu_id'],
                    "gossip"    =>  [
                            "text0"     => $submenu['text0_0'],
                            "text1"     => $submenu['text0_1'],
                                    ],
                                          ];
        }
        
        // Get submenus option
        foreach($subs as $subkey => $suboption) {
        $Infos["submenu"][$subkey]["options"][$subkey] = [
                    "id"        => $suboption['id'],
                    "icon"      => $suboption['option_icon'],
                    "text"      => $suboption['option_text'],
                    "next"      => $suboption['action_menu_id'],
                                                         ];
        }
    }
    
    echo json_encode($Infos);
}