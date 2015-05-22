<?php
include ('Durations.php');
include ('Radius.php');

function getRadius($i)
{
	global $SpellRadius;

   if($i < 50)
       return $SpellRadius[$i] . " (index " . $i . ")";
	else
		return "unknown". " (index " . $i . ")";
}

function getRange($i)
{
	return $i;
}
function getCastingTime($i)
{
	return $i;
}
function getDuration($i)
{
	global $SpellDurations;

   if($i < 105)
       return $SpellDurations[$i] . " (index " . $i . ")";
	else
		return "unknown". " (index " . $i . ")";
}