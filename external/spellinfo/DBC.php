<?php
include ('Durations.php');
include ('Radius.php');
include ('Ranges.php');

function getRadius($i)
{
	global $SpellRadius;
	if(array_key_exists($i, $SpellRadius))
		return $SpellRadius[$i].'y (index ' . $i . ')';
	else 
		return "unknown". " (index " . $i . ")";
}

function getRange($i)
{
	global $SpellRanges;
	if(array_key_exists($i, $SpellRanges))
		return $SpellRanges[$i][0].'-'.$SpellRanges[$i][1].'y "'.$SpellRanges[$i][2].'" (index ' . $i . ")";
	else 
		return "unknown". " (index " . $i . ")";
}

function getCastingTime($i)
{
	return 'index ' . $i;
}

function getDuration($i)
{
	global $SpellDurations;
	if(array_key_exists($i, $SpellDurations))
		return $SpellDurations[$i].'ms (index ' . $i . ')';
	else 
		return "unknown". " (index " . $i . ")";
}