<!DOCTYPE html>
<html>
	<head>
		<title>Spell Info</title>
		<meta charset="utf-8"/>
		<script type="text/javascript" src="view.js"></script>
		<link rel="stylesheet" type="text/css" href="view.css">
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
    if ($e->getMessage() != "Nospell")
    {
        echo $e . '<br/>';
        exit;
    }
}

$overrideSpellInfo = null;
try {
	$overrideSpellInfo = new SpellInfo($id, true);
} catch (Exception $e) {
    if ($e->getMessage() != "Nospell")
    {
        echo $e . '<br/>';
        exit;
    }
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

$spellLinkInfo = null;
try {
	$spellLinkInfo = new SpellLinkInfo($id);
} catch (Exception $e) {
    //no spell link data, continue
}

$procInfo = null;
try {
	$first_id = $rankInfo ? $rankInfo->first_spell_id : 0;
	$procInfo = new ProcInfo($id, $first_id);
} catch (Exception $e) {
    //no spell rank data, continue
}

$affectInfo = null;
try {
	$first_id = $rankInfo ? $rankInfo->first_spell_id : 0;
	$affectInfo = new AffectInfo($id, $first_id);
} catch (Exception $e) {
    //no spell rank data, continue
}

$serverSide = !$baseSpellInfo;
if ($serverSide) {
    // then it's only in base spell info table, don't show as override
    $baseSpellInfo = $overrideSpellInfo;
    $overrideSpellInfo = null;
}

$view = new View($baseSpellInfo, $overrideSpellInfo, $rankInfo, $procInfo, $affectInfo, $spellLinkInfo);

$idText = $id . ($serverSide ? " (SERVERSIDE)" : '');
echo "<h2>Spell Info : ${idText} </h2>";
$name = $baseSpellInfo ? $baseSpellInfo->spellName : $overrideSpellInfo->spellName;
echo "Name: <a href=\"http://www.wowhead.com/spell=".$id."\">${name}</a> (<a href=\"http://db.endless.gg/?spell=".$id."\">TBC DB</a>)<br/>";
$desc = $baseSpellInfo ? $baseSpellInfo->spellDescription : $overrideSpellInfo->spellDescription;
echo "Description: ${desc} <br/>";
echo $view->rank() . '<br/>';
echo $view->overriden() . '<br/>';
echo $view->spellLinked() . '<br/>';
echo "<hr>";

echo '<ul>';
echo "<li>" . $view->spellFamily() . "</li>";
echo "<li>" . $view->duration() . "</li>";
echo "<li>" . $view->casting_time() . "</li>";
echo "<li>" . $view->range() . "</li>";
echo '</ul>';
	
//Print attributes

echo "<hr>";
echo '<div id="bloc1" class="bloc">';
	echo '<div class="leftbloc">';
		echo "<h3>Attributes:</h3>";
		echo $view->get_attribute_table();
	echo '</div>';

	echo '<div class="rightbloc">';
		echo "<h3>Effects:</h3>";
		echo "<ul>";
		for ($i = 0; $i <= 2; $i++)
			echo '<li>' . $view->get_whole_effect($i) . '</li>';
		echo "</ul>";
	echo '</div>';
echo "</div>";

echo "<hr>";


echo '<div id="bloc1" class="bloc">';
	echo '<div class="leftbloc">';
		echo "<h3>Proc data:</h3>";
		echo $view->procFlags();
		echo '<p/>';
		echo $view->procEntry();
	echo '</div>';
	
	echo '<div class="rightbloc">';
		echo "<h3>Affect data:</h3>";
		echo $view->affectEntry();
	echo '</div>';
echo "</div>";

echo "<hr>";
?>
</body>
</html>
