<!DOCTYPE html>
<html>
<head>
    <title>Traductions</title>
    <style type="text/css">
    .modpos {
        position: relative;
        top: 55px;
    }
    .modposarea {
        position: relative;
        left: 200px;
    }
    .modpossubmit {
	
    }
    </style>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php
    if (isset($_POST['entry']))
	echo '<meta http-equiv="refresh" content="3; URL=index.php">';
?>
</head>
<body>
<h1>Traduction de quêtes pour WoW Mania</h1>
<br/><br/>
<?php
 /* + gerer les cas comme <Emberstrife hisses.> voir http://canardwc.free-h.net/alphabravocharlie/tradquests/trad.php?id=6582 */
	$locales_table = "locales_quest";
	$quest_template_table = "quest_template";
    $mysql = mysql_connect("sql31.free-h.org:3306", "canardwc42", "barbecue42");
    $db = mysql_select_db("canardbd", $mysql);
	mysql_query("set names 'utf8'");
	if(isset($_POST['delete_title'])) {
		mysql_query("UPDATE " . $locales_table . " SET title_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET title_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['title']) && $_POST['title'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET title_loc2 = \"" . mysql_real_escape_string($_POST['title']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET title_loc2 = "' . $_POST['title'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }
	if(isset($_POST['delete_details'])) {
		mysql_query("UPDATE " . $locales_table . " SET details_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET details_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['details']) && $_POST['details'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET details_loc2 = \"" . mysql_real_escape_string($_POST['details']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET details_loc2 = "' . $_POST['details'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }
    if(isset($_POST['delete_objectives'])) {
		mysql_query("UPDATE " . $locales_table . " SET objectives_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET objectives_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['objectives']) && $_POST['objectives'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET objectives_loc2 = \"" . mysql_real_escape_string($_POST['objectives']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET objectives_loc2 = "' . $_POST['objectives'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }
    if(isset($_POST['delete_offerrewardtext'])) {
		mysql_query("UPDATE " . $locales_table . " SET offerrewardtext_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET offerrewardtext_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['offerrewardtext']) && $_POST['offerrewardtext'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET offerrewardtext_loc2 = \"" . mysql_real_escape_string($_POST['offerrewardtext']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET offerrewardtext_loc2 = "' . $_POST['offerrewardtext'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }
    if(isset($_POST['delete_requesttext'])) {
		mysql_query("UPDATE " . $locales_table . " SET requestitemstext_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET requestitemstext_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['requestitemstext']) && $_POST['requestitemstext'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET requestitemstext_loc2 = \"" . mysql_real_escape_string($_POST['requestitemstext']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET requestitemstext_loc2 = "' . $_POST['requestitemstext'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }
	 if(isset($_POST['delete_endtext'])) {
		mysql_query("UPDATE " . $locales_table . " SET endtext_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET endtext_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['endtext']) && $_POST['endtext'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET endtext_loc2 = \"" . mysql_real_escape_string($_POST['endtext']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET endtext_loc2 = "' . $_POST['endtext'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }
     if(isset($_POST['delete_objective1'])) {
		mysql_query("UPDATE " . $locales_table . " SET objectivetext1_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET objectivetext1_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['objectivetext1']) && $_POST['objectivetext1'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET objectivetext1_loc2 = \"" . mysql_real_escape_string($_POST['objectivetext1']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET objectivetext1_loc2 = "' . $_POST['objectivetext1'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';    
    }
    if(isset($_POST['delete_objective2'])) {
		mysql_query("UPDATE " . $locales_table . " SET objectivetext2_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET objectivetext2_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['objectivetext2']) && $_POST['objectivetext2'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET objectivetext2_loc2 = \"" . mysql_real_escape_string($_POST['objectivetext2']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET objectivetext2_loc2 = "' . $_POST['objectivetext2'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }
    if(isset($_POST['delete_objective3'])) {
		mysql_query("UPDATE " . $locales_table . " SET objectivetext3_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET objectivetext3_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['objectivetext3']) && $_POST['objectivetext3'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET objectivetext3_loc2 = \"" . mysql_real_escape_string($_POST['objectivetext3']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET objectivetext3_loc2 = "' . $_POST['objectivetext3'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }
    if(isset($_POST['delete_objective4'])) {
		mysql_query("UPDATE " . $locales_table . " SET objectivetext4_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
		echo("UPDATE " . $locales_table . " SET objectivetext4_loc2 = NULL WHERE entry = " . mysql_real_escape_string($_POST['entry']));
	} elseif (isset($_POST['objectivetext4']) && $_POST['objectivetext4'] != "") {
        mysql_query("UPDATE " . $locales_table . " SET objectivetext4_loc2 = \"" . mysql_real_escape_string($_POST['objectivetext4']) . "\" WHERE entry = " . mysql_real_escape_string($_POST['entry']));
        echo 'UPDATE " . $locales_table . " SET objectivetext4_loc2 = "' . $_POST['objectivetext4'] . '" WHERE entry = ' . mysql_real_escape_string($_POST['entry']) . ';<br />';
    }

    if (!isset($_POST['entry'])) {
        $query = mysql_query("SELECT ".$quest_template_table.".entry, title, details, objectives, offerrewardtext, requestitemstext, endtext, objectivetext1, objectivetext2, objectivetext3, objectivetext4, title_loc2, details_loc2, objectives_loc2, offerrewardtext_loc2, requestitemstext_loc2, endtext_loc2, objectivetext1_loc2, objectivetext2_loc2, objectivetext3_loc2, objectivetext4_loc2 FROM ".$quest_template_table." JOIN ".$locales_table." ON ".$locales_table.".entry = ".$quest_template_table.".entry WHERE ".$quest_template_table.".entry = " . $_GET['id']);
        while ($data = mysql_fetch_array($query)) {
			echo '<b><a href=\'index.php\' >Retour</a></b><br/>';
            echo '<b>ID: </b><a href=\'http://fr.wowhead.com/?quest=' . $data[0] . '\'>' . $data[0] . '</a><br/>';
            echo '<table border=1><tr><th>Colonne</th><th>Anglais</th><th>Français</th></tr>';
            echo '<tr><td>Title</td><td>' . $data[1] . '</td><td>' . $data[11] . '</td></tr>';
            echo '<tr><td>Details</td><td>' . $data[2] . '</td><td>' . $data[12] . '</td></tr>';
            echo '<tr><td>Objectives</td><td>' . $data[3] . '</td><td>' . $data[13] . '</td></tr>';
            echo '<tr><td>OfferRewardText</td><td>' . $data[4] . '</td><td>' . $data[14] . '</td></tr>';
            echo '<tr><td>RequestItemsText</td><td>' . $data[5] . '</td><td>' . $data[15] . '</td></tr>';
            echo '<tr><td>EndText</td><td>' . $data[6] . '</td><td>' . $data[16] . '</td></tr>';
            echo '<tr><td>ObjectiveText1</td><td>' . $data[7] . '</td><td>' . $data[17] . '</td></tr>';
            echo '<tr><td>ObjectiveText2</td><td>' . $data[8] . '</td><td>' . $data[18] . '</td></tr>';
            echo '<tr><td>ObjectiveText3</td><td>' . $data[9] . '</td><td>' . $data[19] . '</td></tr>';
            echo '<tr><td>ObjectiveText4</td><td>' . $data[10] . '</td><td>' . $data[20] . '</td></tr>';
            echo '</table>';
?>
    <form name="traduction" method="post" action="trad.php?id=<?php echo $_GET['id']; ?>">
        <div class="modpos"><b>Title:</b></div> <div class="modposarea"><textarea name="title" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_title" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>Details:</b></div> <div class="modposarea"><textarea name="details" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_details" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>Objectives:</b></div> <div class="modposarea"><textarea name="objectives" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_objectives" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>OfferRewardText:</b></div> <div class="modposarea"><textarea name="offerrewardtext" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_offerrewardtext" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>RequestItemsText:</b></div> <div class="modposarea"><textarea name="requestitemstext" cols=80 rows=3></textarea><input type="checkbox" name="delete_requesttext" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>EndText:</b></div> <div class="modposarea"><textarea name="endtext" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_endtext" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>ObjectiveText1:</b></div> <div class="modposarea"><textarea name="objectivetext1" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_objective1" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>ObjectiveText2:</b></div> <div class="modposarea"><textarea name="objectivetext2" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_objective2" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>ObjectiveText3:</b></div> <div class="modposarea"><textarea name="objectivetext3" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_objective3" value="1"/>Supprimer<br/></div>
        <div class="modpos"><b>ObjectiveText4:</b></div> <div class="modposarea"><textarea name="objectivetext4" cols=80 rows=3></textarea>
		<input type="checkbox" name="delete_objective4" value="1"/>Supprimer<br/></div>
        <input type="hidden" name="entry" value="<?php echo $data[0]; ?>"/>
        <div class="modpossubmit"><input type="submit" value="Valider"/></div>
    </form>
<?php
		}
	}
    mysql_close();
?>
</body>
</html>
