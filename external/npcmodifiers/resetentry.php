<?php

require ('../../dbconfig.php');

function resetEntry($entry)
{
	include ('config.php');
	$query = $handler->prepare(
		    "UPDATE creature_template sct 
            JOIN trinityworld.creature_template 2ct ON 2ct.entry = sct.entry AND sct.entry = :entry
            SET sct.exp                 = 2ct.exp,
                sct.unit_class          = 2ct.unit_class,
                sct.HealthModifier      = 2ct.HealthModifier,
                sct.ManaModifier        = 2ct.ManaModifier,
                sct.ArmorModifier       = 2ct.ArmorModifier,
                sct.DamageModifier      = 2ct.DamageModifier,
                sct.ExperienceModifier  = 2ct.ExperienceModifier,
                sct.BaseVariance        = 2ct.BaseVariance,
                sct.RangeVariance       = 2ct.RangeVariance; ");
    $query->bindValue(':entry', htmlspecialchars($entry), PDO::PARAM_INT);
    $query->execute();
}

if(isset($_GET["entry"]))
{
	resetEntry($_GET["entry"]);
	
}

header('Location: '. "index.php?entry=" . htmlspecialchars($_GET["entry"]));