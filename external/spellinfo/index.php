<!DOCTYPE html>
<html>
	<style type="text/css">
	body
	{
		background-color:#446688;
		color:white;
		font-family:arial,sans-serif
	}
	.overriden
	{
		font-weight: bold;
		color:orange;
	}
	.novalue
	{
		color:gray;
	}
	</style>
	<head>
		<title>Spell Info</title>
		<meta charset="utf-8"/>
	</head>
<body>
<?php
error_reporting(E_ALL); 

require('../../dbconfig.php');

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if (!isset($_GET["id"])) {
	echo "<form>";
	echo "ID <input type=\"text\" name=\"id\" value=\"0\"/></input>";
	echo "</form>";
	die();
}

$id = htmlspecialchars($_GET["id"]);

include_once('Attributes.php');
include_once('Effects.php');
include_once('Auras.php');
include_once('DBC.php');
include_once('view.php');
include_once('DB.php');

$baseSpellInfo = null;
try {
	$baseSpellInfo = new SpellInfo($id);
} catch (Exception $e) {
	//
}

$overrideSpellInfo = null;
try {
	$overrideSpellInfo = new SpellInfo($id, true);
} catch (Exception $e) {
    //no spell override data, continue
}

if(!$baseSpellInfo && !$overrideSpellInfo)
{
	echo "No spell $id in database";
	return;
}

$rankInfo = null;
try {
	$rankInfo = new RankInfo($id);
} catch (Exception $e) {
    //no spell rank data, continue
}

$procInfo = null;
try {
	$id2 = $rankInfo ? $rankInfo->first_spell_id : 0;
	$procInfo = new ProcInfo($id, $id2);
} catch (Exception $e) {
    //no spell rank data, continue
}

$view = new View($baseSpellInfo, $overrideSpellInfo, $rankInfo, $procInfo);

echo "<h2>Spell Info : " . $id . "</h2>";
echo "Name: <a href=\"http://www.wowhead.com/spell=".$id."\">".$baseSpellInfo->spellName."</a> (<a href=\"https://tbc-twinhead.twinstar.cz/?spell=".$id."\">TBC DB</a>)<br/>";
echo "Description: ".$baseSpellInfo->spellDescription . '<br/>';
echo $view->rank() . '<br/>';
echo $view->overriden() . '<br/>';
echo "<hr>";

echo '<ul>';
echo "<li>" . $view->spellFamily() . "</li>";
echo "<li>" . $view->duration() . "</li>";
echo "<li>" . $view->casting_time() . "</li>";
echo "<li>" . $view->range() . "</li>";
echo "<li>" . $view->procFlags() . ' / ' . $view->procFlags_spell_proc() . "</li>";
echo '</ul>';
	
//Print attributes

echo "<hr><h3>Attributes:</h3>";
echo $view->get_attribute_table();

//Print effects
echo "<hr><h3>Effects:</h3><ul>";
for ($i = 0; $i <= 2; $i++)
	echo '<li>' . $view->get_whole_effect($i) . '</li>';

?>
</ul>
</body>
</html>
