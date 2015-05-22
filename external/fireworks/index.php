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

try {
    $handler = new PDO("mysql:host=".$db['suntools']['host'].";port=".$db['suntools']['port'].";dbname=".$db['suntools']['database']['suntools'], $db['suntools']['user'], $db['suntools']['password']);
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

//delete

$query = $handler->prepare("SELECT time, spellorgob, size, posX, posY, ori, morphX, morphY
                            FROM game_event_fireworks 
                            WHERE groupid = :id ORDER BY time, posX, posY");
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();

echo "<table border=1>";
echo "<tr><td>Time</td><td>Spell</td><td>Size</td><td>PosX</td><td>PosY</td><td>Ori</td><td>MorphX</td><td>MorphY</td></tr>";
while ($data = $query->fetch()) {
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