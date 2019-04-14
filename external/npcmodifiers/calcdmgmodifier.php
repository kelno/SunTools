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
include('modifiers.php');
include('basestats.php');
include('results.php');
include('misc.php');

//entry, dmgmin, dmgminheroic
$testMe = [ 
[ 17306, 608, 1882     ], 
[ 17308, 1110, 1939    ], 

[ 17306, 608,  1882    ], 
[ 17308, 1110, 1939    ], 
[ 17307, 1085, 3764    ], 
[ 17536, 904,  3136    ], 

[ 17381, 1255, 4492    ], 
[ 17380, 651, 2846     ], 
[ 17377, 805, 1439     ], 

[ 16807, 1433, 3637    ], 
[ 20923, 6398, 0       ], 
[ 16809, 1610, 3450    ], 
[ 16808, 1387, 2823    ], 

[ 17941, 619, 1745     ], 
[ 17991, 1264, 4705    ], 
[ 17942, 2334, 6398    ], 

[ 17770, 2004, 4705    ], 
[ 18105, 981, 4182     ], 
[ 17826, 1507, 3055    ], 
[ 17827, 400, 1306     ], 
[ 17882, 1822, 2909    ], 

[ 17797, 1576, 2968    ], 
[ 17796, 2091, 4265    ], 
[ 17798, 1699, 4265    ], 

[ 18341, 734,  2823    ], 
[ 18343, 749,  3920    ], 
[ 18344, 1136, 3462    ], 

[ 18371, 1136, 1388    ], 
[ 18373, 2909, 2823    ], 

[ 18472, 1092, 1219    ], 
[ 18473, 1593, 3252    ], 
[ 23035, 4849, 0       ], 

[ 18731, 2330, 4705    ], 
[ 18667, 1889, 3528    ], 
[ 18732, 1413, 1413    ], 
[ 18708, 3256, 3256    ], 

[ 17848, 1911, 7331    ], 
[ 17862, 1636, 4452    ], 
[ 18096, 1536, 5227    ], 

[ 17879, 1454, 3637    ], 
[ 17880, 1829, 4265    ], 
[ 17881, 2399, 5227    ], 
 
[ 19219, 2091, 2091    ], 
[ 19710, 2091, 4182    ], 
[ 19218, 2091, 4182    ], 
[ 19221, 1576, 2909    ], 
[ 19220, 847,  1745    ], 

[ 17976, 1523, 4391    ], 
[ 17975, 1413, 1413    ], 
[ 17978, 2040, 3394    ], 
[ 17980, 1999, 5799    ], 
[ 17977, 1999, 3136    ], 

[ 20870, 1454, 2909    ], 
[ 20885, 1777, 4182    ], 
[ 20886, 2091, 4705    ], 
[ 20912, 2182, 4364    ], 
[ 18879, 2352, 4182    ], 
[ 20905, 1434, 2868    ], 
[ 20909, 1731, 4452    ], 
[ 20908, 1607, 3637    ], 
[ 20910, 2132, 4182    ], 
[ 20911, 2132, 4182    ], 

[ 18728, 14896,21062   ], 
[ 17711, 13940,19710   ], 

[ 15550, 5310, 7508    ], 
[ 16151, 4248, 6007    ], 
[ 15687, 6193, 8172    ], 
[ 16457, 6156, 8618    ], 
[ 17521, 4142, 5856    ], 
[ 17534, 2955, 4147    ], 
[ 17533, 3282, 5631    ], 
[ 17535, 2462, 3478    ], 
[ 17546, 2509, 3548    ], 
[ 17543, 4182, 5194    ], 
[ 18168, 4925, 6956    ], 
[ 17547, 4182, 5194    ], 
[ 15691, 5467, 7722    ], 
[ 15688, 5049, 7140    ], 
[ 16524, 2062, 2992    ], 
[ 15689, 7514, 8186    ], 
[ 15690, 6638, 9385    ], 
[ 17225, 9028, 12764   ], 
[ 18831, 12214, 17270  ], 
[ 18835, 6834, 9652    ], 
[ 18836, 1723, 2434    ], 
[ 18834, 4100, 5791    ], 
[ 18832, 4100, 5791    ], 
[ 19044, 6903, 9761    ], 
[ 17256, 4925, 6956    ], 
[ 17257, 14604, 20649  ], 
[ 21216, 5974, 8447    ], 
[ 21217, 11948, 16894  ], 
[ 21845, 7169, 10136   ], 
[ 21214, 8866, 12522   ], 
[ 21213, 12745, 18021  ], 
[ 21212, 11082, 15653  ], 
[ 19514, 11789, 16669  ], 
[ 19516, 8866, 12522   ], 
[ 18805, 6156, 8696    ], 
[ 19622, 11082, 15653  ], 
[ 17767, 11304, 15966  ], 
[ 17808, 12313, 17392  ], 
[ 17888, 12313, 17392  ], 
[ 17842, 21352, 30158  ], 
[ 17968, 20724, 29271  ], 
[ 22887, 11152, 15768  ], 
[ 22898, 14936, 21118  ], 
[ 22841, 23897, 33789  ], 
[ 22871, 19702, 27827  ], 
[ 22948, 11948, 16894  ], 
[ 23418, 1062, 1501    ], 
[ 23419, 11948, 16894  ], 
[ 23420, 14604, 20649  ], 
[ 22947, 22165, 31306  ], 
[ 22949, 18470, 26088  ], 
[ 22950, 3940, 5565    ], 
[ 22951, 6156, 8696    ], 
[ 22952, 10621, 15017  ], 
[ 22917, 19914, 28157  ], 
];


function printDamageModifier($entry, $mindmg)
{
    $creatureModifiers = getDBModifiers($entry);
    $baseStatsInfo = getBaseStatsInfo($entry);
    $baseStats = getBaseStats($baseStatsInfo["level"], $baseStatsInfo["class"], $baseStatsInfo["expansion"]);
	
	$oldDamageRate = $creatureModifiers["damage"]; 
	$creatureModifiers["attackspeed"] = 2; //always assume 2
	$creatureModifiers["damage"] = 1; //calc for damage rate 1
	$stats = getStats($baseStats, $creatureModifiers);
	
	$resultMin = $stats["minDamage"];
	$modifier = $mindmg / $resultMin;
	$color = $oldDamageRate > $modifier ? "green" : "red";
	echo "<tr>";
	echo "<th>".$entry."</th>";
	echo "<th>".round($modifier, 1)."</th>";
	echo "<th>".getCreatureName($entry)."</th>";
	echo "<th> <span style=\"color:{$color}\">".round($oldDamageRate, 1)."</span></th>";
	echo "</tr>";
}


echo "Assuming attack speed 2 </br></br>";
echo "<table>";
foreach ($testMe as $test)
{
	$entry = $test[0];
	$dmgMin = $test[1];
	$dmgMinHeroic = $test[2];
	printDamageModifier($entry, $dmgMin);
	if($heroic_entry = getHeroicEntry($entry))
		printDamageModifier($heroic_entry, $dmgMinHeroic);
}
echo "</table>";
?>
</body>
</html>
