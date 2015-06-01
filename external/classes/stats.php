<?php
require('../../dbconfig.php');
try {
    $handler = new PDO("mysql:host=".$db['suntools']['host'].";port=".$db['suntools']['port'].";dbname=".$db['suntools']['database']['suntools'], $db['suntools']['user'], $db['suntools']['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

function testProgression($tested, $total) {
    return round(($tested / $total) * 100, 2). '%';
}

function globalCount($category, $status) {
    global $handler;
    
    $query = $handler->prepare('SELECT (SUM(CASE WHEN tested = :status THEN 1 ELSE 0 END)) AS TotalCount
                                FROM class_test_' . $category);
    $query->bindValue(':status', $status, PDO::PARAM_INT);
    $query->execute();
    $countStatus = $query->fetch();
    
	return $countStatus['TotalCount'];
}

function globalProgression() {
	global $handler;
	
	$query = $handler->query('SELECT tested FROM class_test_spells');
    $query->execute();
    $totalSpells = $query->rowCount();
    
    $query = $handler->query('SELECT tested FROM class_test_talents');
    $query->execute();
    $totalTalents = $query->rowCount();
    
    $totalNo            = globalCount("talents", 0) + globalCount("spells", 0);
    $totalAssigned      = globalCount("talents", 1) + globalCount("spells", 1);
    $totalSuccess       = globalCount("talents", 2) + globalCount("spells", 2);
    $totalBugged        = globalCount("talents", 3) + globalCount("spells", 3);
    
    $testedSpells       = globalCount("spells", 2) + globalCount("spells", 3);
    $testedTalents      = globalCount("talents", 2) + globalCount("talents", 3);
    
    $totalTested        = $testedSpells + $testedTalents;
    
    $total = $totalTalents + $totalSpells;
    
    $successBar = ($totalSuccess / ($totalSpells + $totalTalents)) * 100;
    $buggedBar = ($totalBugged / ($totalSpells + $totalTalents)) * 100;
    
    // Display results
    echo '
        <div class="col-md-3">
            <h2>Global - '. round($successBar, 2) . '%</h2>
            <p class="col-md-6">
                <strong>Total spells:</strong> ' . $totalSpells . '<br />
                <strong>Total tested:</strong> ' . $testedSpells . '
            </p>
            <p class="col-md-6">
                <strong>Total talents:</strong> ' . $totalTalents . '<br />
                <strong>Total tested:</strong> ' . $testedTalents . '
            </p>
            <p class="col-md-6">
                <strong>Success:</strong> ' . ($totalSuccess) . '
            </p>
            <p class="col-md-6">
                <strong>Bugged:</strong> ' . $totalBugged . '
            </p>
            <div class="progress">
              <div class="progress-bar progress-bar-success" style="width: ' . $successBar . '%"></div>
              <div class="progress-bar progress-bar-danger" style="width: ' . $buggedBar . '%">
              </div>
            </div>
        </div>';
}

function countFields($class, $category, $status) {
    global $handler;
    
    $query = $handler->prepare('SELECT (SUM(CASE WHEN tested = :status THEN 1 ELSE 0 END)) AS TotalCount
                                FROM class_test_' . $category . ' 
                                WHERE class = :class');
    $query->bindValue(':status', $status, PDO::PARAM_INT);
    $query->bindValue(':class', $class, PDO::PARAM_INT);
    $query->execute();
    $countStatus = $query->fetch();
    
	return $countStatus['TotalCount'];
}

function classProgression($class) {
    global $handler;
    
    switch($class) {
        case 1:     $className = "Warrior"; break;
        case 2:     $className = "Paladin"; break;
        case 3:     $className = "Hunter"; break;
        case 4:     $className = "Rogue"; break;
        case 5:     $className = "Priest"; break;
        case 7:     $className = "Shaman"; break;
        case 8:     $className = "Mage"; break;
        case 9:     $className = "Warlock"; break;
        case 11:    $className = "Druid"; break;
        default:    header('Location: ./');
    }
    
    $query = $handler->prepare('SELECT tested FROM class_test_spells WHERE class = :class');
    $query->bindValue(':class', $class, PDO::PARAM_INT);
    $query->execute();
    $totalSpells = $query->rowCount();
    
    $query = $handler->prepare('SELECT tested FROM class_test_talents WHERE class = :class');
    $query->bindValue(':class', $class, PDO::PARAM_INT);
    $query->execute();
    $totalTalents = $query->rowCount();
    
    $totalNo            = countFields($class, "talents", 0) + countFields($class, "spells", 0);
    $totalAssigned      = countFields($class, "talents", 1) + countFields($class, "spells", 1);
    $totalSuccess       = countFields($class, "talents", 2) + countFields($class, "spells", 2);
    $totalBugged        = countFields($class, "talents", 3) + countFields($class, "spells", 3);
    
    $testedSpells       = countFields($class, "spells", 2) + countFields($class, "spells", 3);
    $testedTalents      = countFields($class, "talents", 2) + countFields($class, "talents", 3);
    
    $totalTested        = $testedSpells + $testedTalents;
    
    $total = $totalTalents + $totalSpells;
    
    $successBar = ($totalSuccess / ($totalSpells + $totalTalents)) * 100;
    $buggedBar = ($totalBugged / ($totalSpells + $totalTalents)) * 100;
    
    // Display results
    echo '
        <div class="col-md-3">
            <h2><a href="?class=' . strtolower($className) . '">' . $className . '</a> - '. testProgression($totalTested, $total) . '</h2>
            <p class="col-md-6">
                <strong>Total spells:</strong> ' . $totalSpells . '<br />
                <strong>Total tested:</strong> ' . $testedSpells . '
            </p>
            <p class="col-md-6">
                <strong>Total talents:</strong> ' . $totalTalents . '<br />
                <strong>Total tested:</strong> ' . $testedTalents . '
            </p>
            <p class="col-md-6">
                <strong>Success:</strong> ' . ($totalSuccess) . '
            </p>
            <p class="col-md-6">
                <strong>Bugged:</strong> ' . $totalBugged . '
            </p>
            <div class="progress">
              <div class="progress-bar progress-bar-success" style="width: ' . $successBar . '%"></div>
              <div class="progress-bar progress-bar-danger" style="width: ' . $buggedBar . '%">
              </div>
            </div>
        </div>';
}