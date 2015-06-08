<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(!isset($_GET['guid']) || !preg_match('/[0-9]+/', $_GET['guid']))
{
    http_response_code(400);
    die();
}

// Return a menu in the form [ entry, text0_0, text0_1 ]
function getMenu($id)
{
    global $handler;
    
    $getMenu = $handler->prepare('SELECT entry, text_id, text0_0, text0_1
                                  FROM gossip_menu gm 
                                  JOIN gossip_text gt ON gt.ID = gm.text_id
                                  WHERE gm.entry = :menu');
    $getMenu->bindValue(':menu', $id, PDO::PARAM_INT);
    $getMenu->execute();
    
    return $getMenu->fetch();
}

// Return the options of a menu in the form of an array of [ menu_id, id, option_icon, option_text, action_menu_id ]
function getMenuOptions($id)
{
    global $handler;
    
    $getMenu = $handler->prepare('SELECT menu_id, id, option_icon, option_text, action_menu_id
                                  FROM gossip_menu_option
                                  WHERE menu_id = :menu');
    $getMenu->bindValue(':menu', $id, PDO::PARAM_INT);
    $getMenu->execute();
    return $getMenu->fetchAll();
}

// Return the conditions of a menu in the form of an array of [ id, source, type, target, reverse, value1, value2, value3 ]
function getConditions($id, $textid)
{
    global $handler;
    
    $getMenu = $handler->prepare('SELECT id, SourceTypeOrReferenceId as source, ConditionTypeOrReference as type,
										 ConditionTarget as target, NegativeCondition as reverse,
										 ConditionValue1 as value1, ConditionValue2 as value2, ConditionValue3 as value3
                                  FROM conditions
                                  WHERE SourceGroup = :menu AND SourceEntry = :textid');
    $getMenu->bindValue(':menu', $id, PDO::PARAM_INT);
    $getMenu->bindValue(':textid', $textid, PDO::PARAM_INT);
    $getMenu->execute();
    return $getMenu->fetchAll();
}

function hasMenu($array, $id)
{
    foreach($array["menus"] as $key => $menu)
    {
        if($menu["id"] == $id)
            return true;
    }
    return false;
}

// Add a menu and all its children (referenced in its options) to $array
function addMenuAndChildren($id, & $array)
{
    $menuDB = getMenu($id);
    $menu = [
        "id"      		=> $id,
        "text0"   		=> $menuDB["text0_0"],
        "text1"   		=> $menuDB["text0_1"],
        "options" 		=> [ ],
		"conditions" 	=> [ ],
    ];
    
    //process conditions
    $menuConditionsDB = getConditions($id, $menuDB["text_id"]);
    foreach($menuConditionsDB as $key => $condition)
    {
        $menu["conditions"][$key] = [
			"id"		=> $condition['id'],
           	"source"  	=> $condition['source'],
           	"type"  	=> $condition['type'],
           	"target"  	=> $condition['target'],
           	"value1"  	=> $condition['value1'],
           	"value2"  	=> $condition['value2'],
           	"value3"  	=> $condition['value3'],
           	"reverse"  	=> $condition['reverse'],
        ];
    }
    
    //process options
    $menuOptionsDB = getMenuOptions($id);
    foreach($menuOptionsDB as $key => $option)
    {
        $menu["options"][$key] = [
           	"id"    		=> $option['id'],
           	"icon"  		=> $option['option_icon'],
           	"text"  		=> $option['option_text'],
           	"next"  		=> $option['action_menu_id'],
			"conditions"	=> [ ],
        ];
		
		//process options conditions
		$menuOptionsConditionsDB = getConditions($id, $key);
		foreach($menuOptionsConditionsDB as $keyCondition => $condition)
		{
			$menu["options"][$key]["conditions"][$keyCondition] = [
				"id"		=> $condition['id'],
			   	"source"  	=> $condition['source'],
			   	"type"  	=> $condition['type'],
			   	"target"  	=> $condition['target'],
			   	"value1"  	=> $condition['value1'],
			   	"value2"  	=> $condition['value2'],
			   	"value3"  	=> $condition['value3'],
			   	"reverse"  	=> $condition['reverse'],
			];
		}
    }
    
    array_push($array["menus"], $menu);
    
    //if any option points to a menu, process it too
    foreach($menuOptionsDB as $key => $option)
    {
        $next = $menu["options"][$key]["next"];
        if($next != 0 && !hasMenu($array, $next))
            addMenuAndChildren($next, $array);
    }
}

// Get the creature name and the root menu id in database
$guid = htmlspecialchars($_GET['guid']);

$getRootMenuInfo = $handler->prepare('SELECT cg.menu_id as id, ct.name
                                      FROM creature c
                                      LEFT JOIN creature_gossip cg ON cg.npc_guid = c.guid
                                      JOIN creature_template ct ON ct.entry = c.id
                                      WHERE c.guid = :guid');
$getRootMenuInfo->bindValue(':guid', $guid, PDO::PARAM_INT);
$getRootMenuInfo->execute();
$rootMenuInfo = $getRootMenuInfo->fetch();

// Create the base json object
$json = [ 
    "name"       => $rootMenuInfo["name"],
    "menus"      => [ ],
];

// Fill it
addMenuAndChildren($rootMenuInfo['id'], $json);

echo json_encode($json);
