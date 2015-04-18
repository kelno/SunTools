<?php
require('../config.php');
try {
    $handler = new PDO('mysql:host=62.210.236.104;dbname=world', 'nastyadmin', 'Z9EuAAtxPtA5gt3F');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

//global variable
$zoneID = 0;

function testProgression($tested, $total) {
    return round(($tested / $total) * 100, 2). '%';
}

function countFields($status) {
    global $handler, $zoneID;
    
    $query = $handler->prepare('SELECT (SUM(CASE WHEN startTxt = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN progTxt = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN endTxt = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN txtEvent = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN pathEvent = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN timeEvent = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN Exp = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN Stuff = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN Gold = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN emotNPC = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN spellNPC = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN placeNPC = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN workObj = :status THEN 1 ELSE 0 END) +
                                       SUM(CASE WHEN baObj = :status THEN 1 ELSE 0 END)
                                       ) AS TotalCount
                                FROM suntools.quest_test qtest
                                JOIN world.quest_template qt ON qtest.questid = qt.entry
                                WHERE ZoneOrSort = :zoneID');
    $query->bindValue(':status', $status, PDO::PARAM_INT);
    $query->bindValue(':zoneID', $zoneID, PDO::PARAM_INT);
    $query->execute();
    $countStatus = $query->fetch();
    
	return $countStatus['TotalCount'];
}

function zoneProgression($id) {
    global $handler, $zoneID;
	
	$zoneID = $id;
    
    // Count quests in $zoneID
    $totalQuestQuery = $handler->prepare('SELECT count(*) as count FROM quest_template WHERE ZoneOrSort = :zoneID AND Title NOT LIKE "%BETA%"');
    $totalQuestQuery->bindValue(':zoneID', $zoneID, PDO::PARAM_INT);
    $totalQuestQuery->execute();
    $totalQuest = $totalQuestQuery->fetch();
    $totalQuest = $totalQuest['count'];
    
    // Count tested quests in $zoneID
    $testedQuestQuery = $handler->prepare('SELECT count(*) as count 
                                         FROM suntools.quest_test qtest
                                         JOIN world.quest_template qt ON qtest.questid = qt.entry
                                         WHERE ZoneOrSort = :zoneID AND qt.Title NOT LIKE "%BETA%"
                                               AND questid != 0 AND startTxt != 0 AND progTxt != 0 AND endTxt != 0 AND pathEvent != 0 
                                               AND timeEvent != 0 AND Exp != 0 AND Stuff != 0 AND Gold != 0 
                                               AND emotNPC != 0 AND spellNPC != 0 AND placeNPC != 0 AND workObj != 0 AND baObj != 0');
    $testedQuestQuery->bindValue(':zoneID', $zoneID, PDO::PARAM_INT);
    $testedQuestQuery->execute();
    $testedQuest = $testedQuestQuery->fetch();
    $testedQuest = $testedQuest['count'];
    
    // Count success (status = 1) fields
    $success = countFields(1);
    $working = countFields(2);
    $bugged = countFields(3);
    $no = countFields(4);
    
    $successBar = (($success + $no) / ($totalQuest * 14)) * 100;
    $buggedBar = ($bugged / ($totalQuest * 14)) * 100;
    $workingBar = ($working / ($totalQuest * 14)) * 100;
    
    // Display results
    echo '
        <div class="col-md-6">
            <h2>Hellfire Peninsula - '. testProgression($testedQuest, $totalQuest) . '</h2>
            <p>
                <strong>Total quests:</strong> ' . $totalQuest . '<br />
                <strong>Total tested:</strong> ' . $testedQuest . '
            </p>
            <p>
                <strong>Success:</strong> ' . ($success + $no) . '<br />
                <strong>Bugged:</strong> ' . $bugged . '<br />
                <strong>Working:</strong> ' . $working . '<br />
            </p>
            <div class="progress">
              <div class="progress-bar progress-bar-success" style="width: ' . $successBar . '%">
              </div>
              <div class="progress-bar progress-bar-warning" style="width: ' . $workingBar . '%">
              </div>
              <div class="progress-bar progress-bar-danger" style="width: ' . $buggedBar . '%">
              </div>
            </div>
        </div>';
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SunQuest :: Statistics</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body style="width: 75%; margin: 0 auto;">
        <?php zoneProgression(3483); ?>
    </body>
</html>