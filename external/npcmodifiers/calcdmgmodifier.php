<?php
require('../../dbconfig.php');

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>NPC Stats</title>
		<meta charset="utf-8"/>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js" language="javascript"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js" language="javascript"></script>
		 <style type="text/css">
            body {
                background-color: #225599;
                color: white;
                font-family: 'Open Sans', Arial, sans-serif;
                margin: 0 auto;
                font-size: 14px;
            }
		</style>
		
	</head>
<body>
<?php
include ('modifiers.php');
include ('basestats.php');
include ('results.php');
include ('misc.php');

//entry, dmgmin, dmgminheroic
$testMe = [ 
[ 17306, 608, 1882  ], 
[ 17308, 1110, 1939 ] 
];


function printDamageModifier($entry, $mindmg)
{
    $dbModifiers = getDBModifiers($entry);
    $baseStatsInfo = getBaseStatsInfo($entry);
    $baseStats = getBaseStats($baseStatsInfo["level"], $baseStatsInfo["class"], $baseStatsInfo["expansion"]);
	
	$apdamage          = ($baseStats["ap"] / 14.0) * $dbModifiers["attackspeed"]/1000;
	$resultMin = ($baseStats["damagebase"] + $apdamage) * $dbModifiers["damage"] * $dbModifiers["attackspeed"]/1000;
	$modifier = $mindmg / ($dbModifiers["attackspeed"]/1000) / ($baseStats["damagebase"] + $apdamage);
	echo $entry . " | " . round($modifier) . " | " . getCreatureName($entry) .  "</br>";
}


foreach ($testMe as $test)
{
	$entry = $test[0];
	$dmgMin = $test[1];
	$dmgMinHeroic = $test[2];
	printDamageModifier($entry, $dmgMin);
	if($heroic_entry = getHeroicEntry($entry))
		printDamageModifier($heroic_entry, $dmgMinHeroic);
}
?>
</body>
</html>
