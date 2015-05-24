<?php

require ('../../dbconfig.php');

/* return 
$baseStatsInfo = [
	"level" =>     $data[0],
	"class" =>     $data[1],
	"expansion" => $data[2],
];
*/
function udpateModifiers($GET)
{
    global $handler;
	$query = $handler->prepare(
		     "UPDATE creature_template
             SET exp                    = :expansion,
                 HealthModifier         = :health,
                 ManaModifier           = :mana,
                 ArmorModifier          = :armor,
                 DamageModifier         = :damage,
                 ExperienceModifier     = :experience,
                 BaseVariance           = :basevariance,
                 RangeVariance          = :rangevariance,
                 unit_class             = :class,
                 BaseAttackTime         = :attackspeed * 1000,
                 RangeAttackTime        = :rangedattackspeed * 1000
             WHERE entry            = :entry");
    $query->bindValue(':expansion',         htmlspecialchars($GET["expansion"]), PDO::PARAM_INT);
    $query->bindValue(':health',            htmlspecialchars($GET["health"]), PDO::PARAM_INT);
    $query->bindValue(':mana',              htmlspecialchars($GET["mana"]), PDO::PARAM_INT);
    $query->bindValue(':armor',             htmlspecialchars($GET["armor"]), PDO::PARAM_INT);
    $query->bindValue(':damage',            htmlspecialchars($GET["damage"]), PDO::PARAM_INT);
    $query->bindValue(':experience',        htmlspecialchars($GET["experience"]), PDO::PARAM_INT);
    $query->bindValue(':basevariance',      htmlspecialchars($GET["basevariance"]), PDO::PARAM_INT);
    $query->bindValue(':rangevariance',     htmlspecialchars($GET["rangevariance"]), PDO::PARAM_INT);
    $query->bindValue(':class',             htmlspecialchars($GET["class"]), PDO::PARAM_INT);
    $query->bindValue(':attackspeed',       htmlspecialchars($GET["attackspeed"]), PDO::PARAM_INT);
    $query->bindValue(':rangedattackspeed', htmlspecialchars($GET["rangedattackspeed"]), PDO::PARAM_INT);
    $query->bindValue(':entry', htmlspecialchars($GET["entry"]), PDO::PARAM_INT);
	$query->execute();
	
	header('Location: '. "index.php?entry=" . htmlspecialchars($GET["entry"]));
}