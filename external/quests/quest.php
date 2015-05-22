<?php
require('../../dbconfig.php');

try {
    $handler = new PDO("mysql:host=".$db['suntools']['host'].";port=".$db['suntools']['port'].";dbname=".$db['suntools']['database']['world'], $db['suntools']['user'], $db['suntools']['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
	http_response_code(500);
    die();
}

/****
** Functions
****/
function updateTestQuest($questID, $column, $status) {
    if($questID < 0)
        return;
    
    if($column > 15)
        return;

    if($status > 4 || $status < 0)
        return;

	global $handler;

	switch ($column) {
        case 1: $columnDB = "startTxt"; break;
        case 2: $columnDB = "progTxt"; break;
        case 3: $columnDB = "endTxt"; break;
        case 4: $columnDB = "txtEvent"; break;
        case 5: $columnDB = "pathEvent"; break;
        case 6: $columnDB = "timeEvent"; break;
        case 7: $columnDB = "Exp"; break;
        case 8: $columnDB = "Stuff"; break;
        case 9: $columnDB = "Gold"; break;
        case 10: $columnDB = "emotNPC"; break;
        case 11: $columnDB = "spellNPC"; break;
        case 12: $columnDB = "placeNPC"; break;
        case 13: $columnDB = "workObj"; break;
        case 14: $columnDB = "baObj"; break;
        default: return;
    }
	// http://dev.mysql.com/doc/refman/5.0/en/insert-on-duplicate.html
	$query = $handler->prepare('INSERT INTO suntools.quest_test (questid, ' . $columnDB . ')
								VALUE (:questID, :value)
								ON DUPLICATE KEY UPDATE '. $columnDB .' = :value');
    $query->bindValue(':questID', $questID, PDO::PARAM_INT);
    $query->bindValue(':value', $status, PDO::PARAM_INT);
    $query->execute();
}



/****
** Logic
****/
if(isset($_GET['questId']) && isset($_GET['column']) && isset($_GET['status'])) {
    $questID = htmlspecialchars($_GET['questId']);
	$column = htmlspecialchars($_GET['column']);
	$status = htmlspecialchars($_GET['status']);
	updateTestQuest($questID, $column, $status);
}

if(isset($_GET['questId']) && isset($_GET['comment'])) {
    $comment = htmlspecialchars($_GET['comment']);
    $questID = htmlspecialchars($_GET['questId']);
    
	$query = $handler->prepare('INSERT INTO quest_test (questid, other)
								VALUE (:questID, :value)
								ON DUPLICATE KEY UPDATE other = :value');
    $query->bindValue(':questID', $questID, PDO::PARAM_INT);
    $query->bindValue(':value', $comment, PDO::PARAM_STR);
    $query->execute();
}

if(isset($_GET['questId']) && isset($_GET['tester'])) {
    $tester = htmlspecialchars($_GET['tester']);
    $questID = htmlspecialchars($_GET['questId']);
    
	$query = $handler->prepare('INSERT INTO quest_test (questid, tester)
								VALUE (:questID, :value)
								ON DUPLICATE KEY UPDATE tester = :value');
    $query->bindValue(':questID', $questID, PDO::PARAM_INT);
    $query->bindValue(':value', $tester, PDO::PARAM_STR);
    $query->execute();
}