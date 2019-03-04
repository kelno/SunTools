<?php

/* return 
$creatureModifiers  = [
	"expansion"     => $data[0],
	"health"        => $data[1],
	"mana"          => $data[2],
	"armor"         => $data[3],
	"damage"        => $data[4],
	"experience"    => $data[5],
	"class"         => $data[6],
	"basevariance"  => $data[7],
	"rangevariance" => $data[8],
];
*/
function getModifiers($entry)
{
	if(isset($_POST["entry"])
	&& isset($_POST["expansion"])
	&& isset($_POST["health"])
	&& isset($_POST["mana"])
	&& isset($_POST["armor"])
	&& isset($_POST["damage"])
	&& isset($_POST["class"])
	&& isset($_POST["experience"])
	&& isset($_POST["basevariance"])
	&& isset($_POST["rangevariance"])
	&& isset($_POST["attackspeed"])
	&& isset($_POST["rangedattackspeed"])) {
		$creatureModifiers = [
			"expansion"         => $_POST["expansion"],
			"health"            => $_POST["health"],
			"mana"              => $_POST["mana"],
			"armor"             => $_POST["armor"],
			"damage"            => $_POST["damage"],
			"experience"        => $_POST["experience"],
			"class"             => $_POST["class"],
			"basevariance"      => $_POST["basevariance"],
			"rangevariance"     => $_POST["rangevariance"],
			"attackspeed"       => $_POST["attackspeed"],
			"rangedattackspeed" => $_POST["rangedattackspeed"],
		];
		return $creatureModifiers;
	}

    global $handler;
    
	$query = $handler->prepare("SELECT exp, HealthModifier, ManaModifier, ArmorModifier, DamageModifier, ExperienceModifier, unit_class, BaseVariance, RangeVariance, BaseAttackTime, RangeAttackTime FROM creature_template WHERE entry = :entry");
    $query->bindValue(':entry', htmlspecialchars($entry), PDO::PARAM_INT);
    $query->execute();

	$data = $query->fetch();
	if($data == null)
	{
		echo "printModifersForm : Creature template not found.";
	}
	
	$creatureModifiers = [
        "expansion"         => $data[0],
        "health"            => $data[1],
        "mana"              => $data[2],
        "armor"             => $data[3],
        "damage"            => $data[4],
        "experience"        => $data[5],
        "class"             => $data[6],
        "basevariance"      => $data[7],
        "rangevariance"     => $data[8],
        "attackspeed"       => $data[9]/1000,
        "rangedattackspeed" => $data[10]/1000,
	];
	return $creatureModifiers;
}

function printSelectedIfEqual($i, $compare)
{
	if($i == $compare)
		echo "selected=\"selected\"";
}

function printModifersForm($entry, $modifiers)
{
	echo "<form method=\"post\"><fieldset>";
	echo "<legend><h3>Modifiers</h3></legend>";
	echo "<input type=\"text\" name=\"entry\" value=\"". $entry . "\" hidden />";
	
		echo "<label for=\"expansion\">Expansion</label>";
			echo "<select name=\"expansion\" id=\"expansion\" value=\"". $modifiers["expansion"] . "\">";
			echo "<option value=\"0\"";
			printSelectedIfEqual(0, $modifiers["expansion"]);
			echo " >" . getExpansionName(0) . "</option>";
			echo "<option value=\"1\"";
			printSelectedIfEqual(1, $modifiers["expansion"]);
			echo " >" . getExpansionName(1) . "</option>";
			echo "<option value=\"2\"";
			printSelectedIfEqual(2, $modifiers["expansion"]);
			echo " >" . getExpansionName(2) . "</option>";
			echo "</select>";
			
		echo "<img class=\"help\" title=\"The expension type determines the set of Base stats used\" src=\"question-mark.png\" alt=\"[?]\"/>";
		echo "<br/>";
		echo "<label for=\"attackspeed\">AttackRate</label>";
		echo "<input type=\"number\" step=\"any\" id=\"attackspeed\" name=\"attackspeed\" value=\"". $modifiers["attackspeed"] . "\"/>";
		echo "<br/>";
		echo "<label for=\"rangedattackspeed\">Ranged AttackRate</label>";
		echo "<input type=\"number\" step=\"any\" id=\"rangedattackspeed\" name=\"rangedattackspeed\" value=\"". $modifiers["rangedattackspeed"] . "\"/>";
		echo "<br/>";
		echo "<label for=\"health\">HealthModifier</label>";
		echo "<input type=\"number\" step=\"any\" id=\"health\" name=\"health\" value=\"". $modifiers["health"] . "\"/>";
		echo "<br/>";
		echo "<label for=\"mana\">ManaModifier</label>";
		echo "<input type=\"number\" step=\"any\" id=\"mana\" name=\"mana\" value=\"". $modifiers["mana"] . "\"/>";
		echo "<br/>";
		echo "<label for=\"armor\">ArmorModifier</label>";
		echo "<input type=\"number\" step=\"any\" id=\"armor\" name=\"armor\" value=\"". $modifiers["armor"] . "\"/>";
		echo "<br/>";
		echo "<label for=\"damage\">DamageModifier</label>";
		echo "<input type=\"number\" step=\"any\" id=\"damage\" name=\"damage\" value=\"". $modifiers["damage"] . "\"/>";
		echo "<br/>";
		echo "<label for=\"experience\">ExperienceModifier</label>";
		echo "<input type=\"number\" step=\"any\" id=\"experience\" name=\"experience\" value=\"". $modifiers["experience"] . "\"/>"; 
		echo "<br/>";
		echo "<label for=\"basevariance\">Base Variance</label>";
		echo "<input type=\"number\" step=\"any\" id=\"basevariance\" name=\"basevariance\" value=\"". $modifiers["basevariance"] . "\"/>";
		echo "<img class=\"help\" title=\"Multiply max damage by * (1 + variance) (0 means mindmg = maxdmg)\" src=\"question-mark.png\" alt=\"[?]\"/>";
		echo "<br/>";
		echo "<label for=\"rangevariance\">Range Variance</label>";
		echo "<input type=\"number\" step=\"any\" id=\"rangevariance\" name=\"rangevariance\" value=\"". $modifiers["rangevariance"] . "\"/>";
		echo "<img class=\"help\" title=\"Same as Base Variance but with ranged weapon\" src=\"question-mark.png\" alt=\"[?]\"/>";
		echo "<br/>";
		echo "<label for=\"class\">Class</label>";
			echo "<select name=\"class\" id=\"class\" value=\"". $modifiers["class"] . "\">";
			echo "<option value=\"1\"";
			printSelectedIfEqual(1, $modifiers["class"]);
			echo " >" . getClassName(1) . "</option>";
			echo "<option value=\"2\"";
			printSelectedIfEqual(2, $modifiers["class"]);
			echo " >" . getClassName(2) . "</option>";
			echo "<option value=\"4\"";
			printSelectedIfEqual(4, $modifiers["class"]);
			echo " >" . getClassName(4) . "</option>";
			echo "<option value=\"8\"";
			printSelectedIfEqual(8, $modifiers["class"]);
			echo " >" . getClassName(8) . "</option>";
			echo "</select>";
			
		echo "<img class=\"help\" title=\"The class determines the set of Base stats used\" src=\"question-mark.png\" alt=\"[?]\"/>";
		echo "<br/>";
		
	echo "<br/><input type=\"submit\" value=\"preview\" />";
	echo " </fieldset></form>";
	echo "<form action=\"resetentry.php\" method=\"get\">";
	echo "<input type=\"text\" name=\"entry\" value=\"". $entry . "\" hidden />";
	echo "<input type=\"submit\" value=\"reset\" />";
	echo "</form>";
}