<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(!isset($_GET['entry']) || !preg_match('/^[0-9]+$/', $_GET['entry']))
{
    http_response_code(400);
    die();
}

// Return a menu in the form [ entry, text0_0, text0_1 ]
function getMenu($id)
{
		if($id == 0)
			return array("entry" => "0", "text_id" => "0", "text0_0" => "", "text0_1" => "");
		
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
function getMenuConditions($id, $textid)
{
    global $handler;
    
    $getMenu = $handler->prepare('SELECT id, SourceTypeOrReferenceId as source, ConditionTypeOrReference as type,
										 ConditionTarget as target, NegativeCondition as reverse,
										 ConditionValue1 as value1, ConditionValue2 as value2, ConditionValue3 as value3
                                  FROM conditions
                                  WHERE SourceTypeOrReferenceId = 14 AND SourceGroup = :menu AND SourceEntry = :textid'); // CONDITION_SOURCE_TYPE_GOSSIP_MENU = 14
    $getMenu->bindValue(':menu', $id, PDO::PARAM_INT);
    $getMenu->bindValue(':textid', $textid, PDO::PARAM_INT);
    $getMenu->execute();
    return $getMenu->fetchAll();
}

// Return the conditions of a menu option in the form of an array of [ id, source, type, target, reverse, value1, value2, value3 ]
function getMenuOptionsConditions($id)
{
    global $handler;
    
    $getMenu = $handler->prepare('SELECT id, SourceTypeOrReferenceId as source, ConditionTypeOrReference as type,
										 ConditionTarget as target, NegativeCondition as reverse,
										 ConditionValue1 as value1, ConditionValue2 as value2, ConditionValue3 as value3
                                  FROM conditions
                                  WHERE SourceTypeOrReferenceId = 15 AND SourceGroup = :menu'); // CONDITION_SOURCE_TYPE_GOSSIP_MENU_OPTION = 15
    $getMenu->bindValue(':menu', $id, PDO::PARAM_INT);
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

	//stop here if no id given
	if($id == 0) {
		array_push($array["menus"], $menu);
		return;
	}
		
	//process conditions
	$menuConditionsDB = getMenuConditions($id, $menuDB["text_id"]);
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
		$menuOptionsConditionsDB = getMenuOptionsConditions($id);
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
$entry = htmlspecialchars($_GET['entry']);

$getRootMenuInfo = $handler->prepare('SELECT gossip_menu_id AS id, name
                                      FROM creature_template
                                      WHERE entry = :entry');
$getRootMenuInfo->bindValue(':entry', $entry, PDO::PARAM_INT);
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
