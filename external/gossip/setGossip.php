<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(	!isset($_GET['entry']) 
	|| !preg_match('/^[0-9]+$/', $_GET['entry'])
	|| !isset($_GET['menu']) 
	|| !preg_match('/^[0-9]+$/', $_GET['menu'])
	|| !isset($_GET['value']) 
	|| $_GET['menu'] == 0
	|| $_GET['entry'] == 0
	) 
{
	http_response_code(400);
	die();
}

$entry           = htmlspecialchars($_GET['entry']);
$menu           = htmlspecialchars($_GET['menu']);
$text           = htmlspecialchars($_GET['value']);

try { 
	//Create text in database
	$insertText          = $handler->prepare('INSERT INTO gossip_text (ID, text0_0)
											 VALUES (:menu, :text)
											 ON DUPLICATE KEY UPDATE text0_0 = :text');
	$insertText->bindValue(':menu', $menu, PDO::PARAM_INT);
	$insertText->bindValue(':text', $text, PDO::PARAM_STR);
	$insertText->execute();

		//create menu in database
	$insertMenu         = $handler->prepare('INSERT INTO gossip_menu (entry, text_id)
											 VALUES (:menu, :menu2)
											 ON DUPLICATE KEY UPDATE entry = :menu');
	$insertMenu->bindValue(':menu', $menu, PDO::PARAM_INT);
	$insertMenu->bindValue(':menu2', $menu, PDO::PARAM_INT);
	$insertMenu->execute();

	//update template
	$updateTemplate = $handler->prepare('UPDATE creature_template SET gossip_menu_id = :menu WHERE entry = :entry');
	$updateTemplate->bindValue(':menu', $menu, PDO::PARAM_INT);
	$updateTemplate->bindValue(':entry', $entry, PDO::PARAM_INT);
	$updateTemplate->execute();
	
} catch (PDOException $e) {
  http_response_code(500);
  echo $e;
  die();
} 