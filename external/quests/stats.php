<?php
require('../../dbconfig.php');

try {
    $handler = new PDO("mysql:host=".$db['suntools']['host'].";port=".$db['suntools']['port'].";dbname=".$db['suntools']['database']['world'], $db['suntools']['user'], $db['suntools']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
};

//global variable
$zoneID = 0;

function globalCount($status) {
    global $handler;
    
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
                                FROM suntools.quest_test');
    $query->bindValue(':status', $status, PDO::PARAM_INT);
    $query->execute();
    $countStatus = $query->fetch();
	
	return $countStatus['TotalCount'];
}

function globalProgression() {
	global $handler;
	
	$success = globalCount(1);
	$working = globalCount(2);
	$bugged	 = globalCount(3);
	$no		 = globalCount(4);
	
	$query = $handler->query('SELECT COUNT(*) as count FROM suntools.quest_test');
	$query->execute();
	$testedQuest = $query->fetch();
	$testedQuest = $testedQuest['count'];
	
	$query = $handler->query('SELECT COUNT(*) as count FROM world.quest_template WHERE ZoneOrSort IN (3483, 3521, 3519, 3518, 3522, 3523, 3520) AND Title NOT LIKE "%BETA%"');
	$query->execute();
	$totalQuest = $query->fetch();
	$totalQuest = $totalQuest['count'];
	
	$successBar = (($success + $no) / ($totalQuest * 14)) * 100;
    $buggedBar = ($bugged / ($totalQuest * 14)) * 100;
    $workingBar = ($working / ($totalQuest * 14)) * 100;
    
    // Display results
    echo '
        <div class="col-md-4">
            <h2>Global - '. round($successBar + $workingBar, 2) . '%</h2>
            <p class="col-md-12">
                <strong>Total quests:</strong> ' . $totalQuest . '<br />
                <strong>Total tested:</strong> ' . $testedQuest . '
            </p>
            <p class="col-md-4">
                <strong>Success:</strong> ' . ($success + $no) . '
			</p>
            <p class="col-md-4">
                <strong>Bugged:</strong> ' . $bugged . '
			</p>
            <p class="col-md-4">
                <strong>Working:</strong> ' . $working . '
            </p>
            <div class="progress col-md-12" style="padding: 0;">
              <div class="progress-bar progress-bar-success" style="width: ' . $successBar . '%">
              </div>
              <div class="progress-bar progress-bar-warning" style="width: ' . $workingBar . '%">
              </div>
              <div class="progress-bar progress-bar-danger" style="width: ' . $buggedBar . '%">
              </div>
            </div>
        </div>';
}

function testProgression($tested, $total) {
    return round(($tested / $total) * 100, 2). '%';
}

function countFields($status, $zoneID) {
    global $handler;
    
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
    
    // Get zone name
    $zoneNameQuery = $handler->prepare('SELECT name FROM dbc.dbc_areatable WHERE id = :zoneID');
    $zoneNameQuery->bindValue(':zoneID', $zoneID, PDO::PARAM_INT);
    $zoneNameQuery->execute();
    $zoneName = $zoneNameQuery->fetch();
    $zoneName = $zoneName['name'];

    // Count quests in $zoneID
    $totalQuestQuery = $handler->prepare('SELECT count(*) as count FROM world.quest_template WHERE ZoneOrSort = :zoneID AND Title NOT LIKE "%BETA%"');
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
    $success = countFields(1, $zoneID);
    $working = countFields(2, $zoneID);
    $bugged = countFields(3, $zoneID);
    $no = countFields(4, $zoneID);
    
    $successBar = (($success + $no) / ($totalQuest * 14)) * 100;
    $buggedBar = ($bugged / ($totalQuest * 14)) * 100;
    $workingBar = ($working / ($totalQuest * 14)) * 100;
    
    // Display results
    echo '
        <div class="col-md-4">
            <h2><a href="?zoneid=' . $id . '">' . $zoneName . '</a> - '. testProgression($testedQuest, $totalQuest) . '</h2>
            <p class="col-md-12">
                <strong>Total quests:</strong> ' . $totalQuest . '<br />
                <strong>Total tested:</strong> ' . $testedQuest . '
            </p>
            <p class="col-md-4">
                <strong>Success:</strong> ' . ($success + $no) . '
			</p>
            <p class="col-md-4">
                <strong>Bugged:</strong> ' . $bugged . '
			</p>
            <p class="col-md-4">
                <strong>Working:</strong> ' . $working . '
            </p>
            <div class="progress col-md-12" style="padding: 0;">
              <div class="progress-bar progress-bar-success" style="width: ' . $successBar . '%">
              </div>
              <div class="progress-bar progress-bar-warning" style="width: ' . $workingBar . '%">
              </div>
              <div class="progress-bar progress-bar-danger" style="width: ' . $buggedBar . '%">
              </div>
            </div>
        </div>';
}