<?php
include_once('Durations.php');
include_once('Radius.php');
include_once('Ranges.php');
include_once('Targets.php');
include_once('SpellFamily.php');

function getRadius($i)
{
	global $SpellRadius;
	if(array_key_exists($i, $SpellRadius))
		return $SpellRadius[$i].'y (' . $i . ')';
	else 
		return "unknown". " (index " . $i . ")";
}

function getRange($i)
{
	global $SpellRanges;
	if(array_key_exists($i, $SpellRanges))
		return $SpellRanges[$i][0].'-'.$SpellRanges[$i][1].'y "'.$SpellRanges[$i][2].'" (' . $i . ")";
	else 
		return "unknown". " (" . $i . ")";
}

function getCastingTime($i)
{
	return '? (' . $i . ')';
}

function getDuration($i)
{
	global $SpellDurations;
	if(array_key_exists($i, $SpellDurations))
		return $SpellDurations[$i].'ms (' . $i . ')';
	else 
		return "unknown". " (" . $i . ")";
}

function getTarget($i)
{
	global $Targets;
	if(array_key_exists($i, $Targets))
		return $Targets[$i].' (' . $i . ')';
	else 
		return "unknown". " (" . $i . ")";
}

function getAura($i)
{
	if($i != 0)
		return $i . " - " . getAuraName($i);
	else
		return '';
}

function getFamilyName($i)
{
	global $SpellFamilyName;
		if(array_key_exists($i, $SpellFamilyName))
		return $SpellFamilyName[$i].' (' . $i . ')';
	else 
		return "unknown". " (" . $i . ")";
}