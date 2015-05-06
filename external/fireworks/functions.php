<?php

function getFirstFreeGroupID()
{	
	$queryStr = "SELECT max(groupid) FROM game_event_fireworks;";
	$query = mysql_query($queryStr);
	if ($data = mysql_fetch_array($query)) {
		return $data[0] + 1;
	} else {
		return 0;
	}
}

?>