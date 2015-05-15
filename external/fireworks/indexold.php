<!DOCTYPE html>
<html>
	<head>
		<title> Traductions quêtes WM </title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="tq.css" />
<?php
	/*Déclarations & initialisations*/
	$max = 7;
	$cpts = array($max+1);
	$tri = "";
	$filtre = "";
	
	for ($i = 0; $i < $max+1; $i++){
		$cpts[$i] = 0;
	}
	if (isset($_GET["tri"])){
		$tri = $_GET["tri"];
	}
	if (isset($_GET["filtre"])){
		$filtre = $_GET["filtre"];
	}
?>
	</head>
	<body>
		<h1>Traductions quêtes WaluigiMario</h1><br/>
		<div id="presentation">
		<div id="presGauche">
		<div id="presentationTxt">
		Merci d'avoir jeté un coup d'&oelig;il au site.<br/>
		N'oubliez pas de mettre un pouce vert et d'ajouter un commentaire en dessous.<br/>
		Vous pouvez aussi me suivre sur Twitter, Facebook, HKO et dans la rue.
		</div>
		<br/>
		<div id="tris-filtres">
		<form action="." method="GET">
			Tri : 
			<select name="tri">
				<option value = "id" <?php if($tri=="id") echo "selected"; ?>>Identifiant</option>
				<option value = "alphaEn" <?php if($tri=="alphaEn") echo "selected"; ?>>Ordre alphabétique anglais</option>
				<option value = "alphaEnDesc" <?php if($tri=="alphaEnDesc") echo "selected"; ?>>Ordre alphabétique anglais inversé</option>
				<option value = "alphaFr" <?php if($tri=="alphaFr") echo "selected"; ?>>Ordre alphabétique français</option>
				<option value = "alphaFrDesc" <?php if($tri=="alphaFrDesc") echo "selected"; ?>>Ordre alphabétique français inversé</option>
			</select>
			<br/>
			Filtre : 
			<select name="filtre">
				<option value = "noFiltre" <?php if($filtre=="noFiltre") echo "selected"; ?>>Sans filtre</option>
				<option value = "inco" <?php if($filtre=="inco") echo "selected"; ?>>Toutes les incohérences</option>
				<option class = "nbMismatch0" value = "sansInco" <?php if($filtre=="sansInco") echo "selected"; ?>>Sans incohérence</option>
				<?php
				for ($i = 1; $i < $max; $i++){
					echo "<option class = \"nbMismatch".$i."\" value = \"inco".$i."\"";
					if($filtre=="inco".$i) echo " selected";
					echo ">".$i." incohérence".($i<=1?"":"s")."</option>\n\t\t\t\t";
				}
				echo "<option class = \"nbMismatchMax\" value = \"incoMax\"";
				if($filtre=="incoMax" || (preg_match('/(?P<name>\D+)(?P<nbInco>\d+)/', $filtre, $matches) && $matches["nbInco"] >= $max)) echo " selected";
				echo ">Encore plus d'incohérences</option>\n";
				?>
			</select>
			<br/>
			<input type="submit" value="OK"/>
		</form>
		</div>
		</div>
		<div id="presDroite">
		<div id="legende">
		<h3>Légende</h3><br/>
		<?php
		for ($i = 0; $i < $max; $i++){
			echo "<span class='legendeItem nbMismatch".$i."'>".$i." incohérence".($i<=1?"":"s")."</span><br/>\n\t\t";
		}
		echo "<span class='legendeItem nbMismatchMax'>Encore plus d'incohérences</span>";
		?>	
		</div>
		</div>
		</div>
		<?php		
			$mysql = mysql_connect("sql31.free-h.org:3306", "canardwc42", "barbecue42");
			$db = mysql_select_db("canardbd", $mysql);
			if (mysql_errno($mysql)){
				echo mysql_errno($mysql) . ": " . mysql_error($mysql). "\n";
			}
			mysql_query("set names 'utf8'");
			$queryStr = "
			SELECT qt.entry, lq.entry, qt.Title, lq.Title_loc2, qt.Details, lq.Details_loc2, qt.Objectives, lq.Objectives_loc2, qt.OfferRewardText, lq.OfferRewardText_loc2, qt.RequestItemsText, lq.RequestItemsText_loc2, qt.EndText, lq.EndText_loc2, qt.ObjectiveText1, lq.ObjectiveText1_loc2, qt.ObjectiveText2, lq.ObjectiveText2_loc2, qt.ObjectiveText3, lq.ObjectiveText3_loc2, qt.ObjectiveText4, lq.ObjectiveText4_loc2
			FROM quest_template qt 
			LEFT OUTER JOIN locales_quest2 lq ON lq.entry = qt.entry 
			WHERE qt.entry < 13000 
			ORDER BY ";
			switch ($tri){
			case "id" :
				$queryStr.="qt.entry";
				break;
			case "alphaEn" :
				$queryStr.="qt.Title";
				break;
			case "alphaEnDesc" :
				$queryStr.="qt.Title DESC";
				break;
			case "alphaFr" :
				$queryStr.="lq.Title_loc2";
				break;
			case "alphaFrDesc" :
				$queryStr.="lq.Title_loc2 DESC";
				break;
			default :
				$queryStr.="qt.entry";
			}
			$queryStr.=";";
			$query = mysql_query($queryStr);
			while ($data = mysql_fetch_array($query)) {
				$cpt = 0;
				for ($i = 2; $i < sizeof($data); $i += 2){
					if(empty($data[$i])^empty($data[$i+1])){
						$cpt++;
					}
				}
				$cpts[($cpt>=$max?$max:$cpt)]++;
				switch($filtre){
				case "incoherences" :
				case "inco" : 
					if ($cpt > 0){
						printElemList($data, $cpt);
					}
					break;
				case "sansInco" : 
					if ($cpt == 0){
						printElemList($data, $cpt);
					}
					break;
				case (preg_match('/^inco\d+$/', $filtre) ? true : false) :
					preg_match('/(?P<name>\D+)(?P<nbInco>\d+)/', $filtre, $matches);
					if ($matches["nbInco"] < $max){
						if ($cpt == $matches["nbInco"]){
							printElemList($data, $cpt);
						}
						break;
					}
				case "incoMax" : 
					if ($cpt == $max){
						printElemList($data, $cpt);
					}
					break;
				default : 
					printElemList($data, $cpt);
				}
			}
			echo "\n";
			mysql_close();
			
			function printElemList($data, $cpt){
				global $max;
				echo "<span class='listId nbMismatch".($cpt>=$max?"Max":$cpt)."'>".$data[0]."</span><span class='listTitle nbMismatch".($cpt>=$max?"Max":$cpt)."'>&nbsp;<a href='trad.php?id=".$data[0]."' rel='nofollow'>".(empty($data[3])?$data[2]:$data[3])	."</a></span>".($cpt==0?"":"<span class='listInco nbMismatch".($cpt>=$max?"Max":$cpt)."'>Incohérence".($cpt<=1?"":"s")." (".$cpt.")</span>")."<br/>\n\t\t";
			}
		?>
		<div id="navCpts">
			<h3>Compteurs</h3><br/>
			<?php
			$totalCpts = 0;
			for ($i = 0; $i < $max; $i++){
				echo "<span class='navCptsItem nbMismatch".$i."'>".$cpts[$i]."</span><br/>\n\t\t\t";
				$totalCpts += $cpts[$i];
			}
			echo "<span class='navCptsItem nbMismatchMax'>".$cpts[$max-1]."</span>\n\t\t\t";
			$totalCpts += $cpts[$max];
			echo "<hr/>\n\t\t\t<span class='navCptsItem nbMismatchTot'>".$totalCpts."</span>\n";
			?>
		</div>
	</body>
</html>