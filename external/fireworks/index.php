<!DOCTYPE html>
<html>
	<style type="text/css">
	body{
	background-color:#446688;
	color:white;
	font-family:arial,sans-serif
	}
	</style>
	<head>
		<title> Fireworks editor </title>
		<meta charset="utf-8"/>
	</head>
<body>
<?php

$mysql = mysql_connect('localhost:3306', 'root', 'canard');
$db = mysql_select_db("sunworld", $mysql); 

if (mysql_errno($mysql)){
	echo mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
	exit(1);
}

include ('functions.php');

if (isset($_GET["id"])) {
	$id = $_GET["id"];
	echo "Event id : " . $id . "<br>";
} else {
	$firstFree = getFirstFreeGroupID();
	echo "<form>";
	echo "Event ID <input type=\"text\" name=\"id\" value=\"". $firstFree . "\"/></input>";
	echo " <input type=\"submit\" value=\"Submit\"/>";
	echo "</form>";
	exit(1);
}

//delete

$queryStr = "SELECT time, spellorgob, size, posX, posY, ori, morphX, morphY FROM game_event_fireworks WHERE groupid = " . $id . " ORDER BY time, posX, posY";
$query = mysql_query($queryStr);

echo "<table border=1>";
echo "<tr><td>Time</td><td>Spell</td><td>Size</td><td>PosX</td><td>PosY</td><td>Ori</td><td>MorphX</td><td>MorphY</td></tr>";
while ($data = mysql_fetch_array($query)) {
	echo "<tr><form>";
	for($i = 0; $i < 8; $i++)
		echo "<td><input type=\"text\" name=\"".$i ."\" value=\"". $data[$i] . "\"/></input></td>";
    echo "<td><input type=\"submit\" value=\"create\"/></td>";
	echo "<td><input type=\"submit\" value=\"delete\"/></td></form>";
	echo "</tr>";
}
//empty line
echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>"; 
//new line for new entry
echo "<tr><form>";
for($i = 0; $i < 7; $i++)
	echo "<td><input type=\"text\" name=\"id\" value=\"0\"/></input></td>";
echo " <td><input type=\"submit\" value=\"create\"/></td></form>";
echo "</tr>";
echo "</table>";

?>
</body>
</html>