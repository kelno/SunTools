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
		<title> Fireworks editor - Not finished </title>
		<meta charset="utf-8"/>
	</head>
<body>
<?php

require('../../dbconfig.php');

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
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

$query = $handler->prepare("SELECT time, spellorgob, size, posX, posY, ori, morphX, morphY
                            FROM game_event_fireworks
                            WHERE groupid = :id ORDER BY time, posX, posY");
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();

function printCell($index, $value)
{
	echo "<td>";
	switch($index)
	{
		case 1:
			echo "<select>
							<option value=\"todo\">Red</option>
							<option value=\"todo\">Blue</option>
							<option value=\"todo\">Green</option>
						</select>";
						break;
		default:
			echo "<input type=\"number\" name=\"".$index ."\" value=\"". $value . "\"/></input>";
			break;
	}
	echo "</td>";
}

echo "<table border=1>";
echo "<tr><td>Time</td><td>Spell</td><td>Size</td><td>PosX</td><td>PosY</td><td>Ori</td><td>MorphX</td><td>MorphY</td></tr>";
while ($data = $query->fetch()) {
	echo "<tr><form>";
	for($i = 0; $i < 8; $i++)
		printCell($i, $data[$i]);

  echo "<td><input type=\"submit\" value=\"create\"/></td>";
	echo "<td><input type=\"submit\" value=\"delete\"/></td></form>";
	echo "</tr>";
}
//empty line
echo "<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";
//new line for new entry
echo "<tr><form>";
for($i = 0; $i < 8; $i++)
  printCell($i, 0);

echo " <td><input type=\"submit\" value=\"create\"/></td></form>";
echo "</tr>";
echo "</table>";

?>
</body>
</html>
