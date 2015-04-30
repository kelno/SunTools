<!DOCTYPE html>

<?php
require('../config.php');

$mysql = mysql_connect($host, $user, $password);
$db = mysql_select_db($worlddb, $mysql); 
if (mysql_errno($mysql)) 
{
	echo mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
	exit(1);
}
?>

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
            a {
                color: #00b1ff;
            }
            h3 {
                margin: 0;
            }
            #wrap {
                margin: 0 auto;
                width: 1020px;
            }
            #content {
                width: 800px;
                float: left;
            }
            label, legend {
                display: block;
                margin-left: 3px;
                font-family: 'Open Sans', Arial, sans-serif;
                font-size:.9em;
            }
            label {
                padding: 5px 0 0 0;
            }
            .inline {
              display:inline-block;
            }
            fieldset {
                border: 1px solid rgba(255,255,255,.5);
            }
            table {
                border: 1px solid rgba(255,255,255,.25);
                border-collapse: collapse;
            }
            th {
                text-transform: uppercase;
            }
            th, td {
                padding: 4px;
            }
            .results, .full {
                width: 100%;
            }
            .results td {
                width: 20%;
            }
			.full td {
                width: 16.66%;
            }
        </style>
	</head>
<body>

<?php

echo "<div id=\"wrap\">";

error_reporting(E_ALL);

include ('modifiers.php');
include ('basestats.php');
include ('results.php');
include ('modifymodifiers.php');
include ('misc.php');

if (!isset($_GET["entry"]))
{
	echo "<form>";
	echo "Creature entry <input type=\"text\" name=\"entry\" value=\"15548\"/></input>";
	echo "</form>";
	echo "<br>";
	exit(1);
}

$entry = $_GET["entry"];

if(
   isset($_GET["entry"])
&& isset($_GET["expansion"])
&& isset($_GET["health"])
&& isset($_GET["mana"])
&& isset($_GET["armor"])
&& isset($_GET["damage"])
&& isset($_GET["experience"])
&& isset($_GET["basevariance"])
&& isset($_GET["rangevariance"])
&& isset($_GET["attackspeed"])
&& isset($_GET["rangedattackspeed"])
)
{
	udpateModifiers($mysql, $_GET);
	exit(0);
}

echo "<h1>" . getCreatureName($mysql, $entry) . " (<a href=\"http://www.wowhead.com/npc=" . $entry . "\">" . $entry . "</a>)</h1>"; 
echo "<div style=\"float: left; width: 220px\">";
$creatureModifiers = getModifiers($mysql, $entry);
printModifersForm($entry, $creatureModifiers);
echo "</div><div id=\"content\">";
$baseStatsInfo = getBaseStatsInfo($mysql, $entry);
$baseStats = getBaseStats($mysql, $baseStatsInfo["level"], $baseStatsInfo["class"], $baseStatsInfo["expansion"]);

$n_exp = getExpansionName($baseStatsInfo["expansion"]);
$n_class = getClassName($baseStatsInfo["class"]);

$title = "<h3>Base stats for level " . $baseStatsInfo["level"] . " - Class " . $n_class . " - Expansion " . $n_exp . "</h3>";

echo "<fieldset><legend>" . $title . "</legend>";
printBaseStats($baseStats);
echo "</fieldset><br/>";
/*
$creatureInfo = getCreatureInfo($mysql, $entry);
$title = "<h3>Creature info :</h3>";
echo "<fieldset><legend>" . $title . "</legend>";
printCreatureInfo($creatureInfo);
echo "</fieldset><br/>";*/

$title = "<h3>Results :</h3>";
echo "<fieldset><legend>" . $title . "</legend>";
printResultingStats($mysql, $baseStats, $creatureModifiers);
echo "</fieldset></div>";

echo "</div>";

?>

</body>
</html>
