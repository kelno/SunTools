
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="qg.css" />
		<title>Pimp my Heroic Instance 0.1</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="qg.js"></script>
	</head>
	<body onload="disableCheckboxes();">
		<h1>Veuillez frapper vos orteils sur le clavier : </h1>
		<noscript>
			<div class="warning">
			Vous n'avez pas activé les scripts dans votre navigateur. Aucune vérification ne sera faite. Soyez prudent !
			</div>
		</noscript>
		<br/>
		<form name="input" action="index.php" method="post" onsubmit="return verif();">
			<fieldset class="fs1">
			<legend>Formulaire</legend>
				<div class="check strVide">
				MapId :
				<input type="text" name="map" value="0"/>
				</div>
				Damage rate :
				<input type="number" name="damageRate" value="40" min="1" max="200"/>
				<br/>
				HP Rate :
				<input type="number" name="hpRate" value="25" min="1" max="200"/>
				<br/>
				Armor Rate :
				<input type="number" name="armorRate" value="6" min="1" max="200"/>
				<br/>
				startingId :
				<input type="number" name="startingId" value="100000" min="1" max="500000"/>
				<br/>
				respawnDelay <img class="help" title="En jours" src="question-mark.png" alt="[?]"/>:
				<input type="number" name="respawnDelay" value="1" min="1" max="200" hidden/>
				<br/>
				Custom ID's <img class="help" title="ID supplémentaire de mobs à prendre en compte, séparé par des virgules" src="question-mark.png" alt="[?]"/>:
				<input type="text" name="customID" value=""/>
				<br/>
			</fieldset>
			<input class="submit1" type="submit" value="Valider">
		</form>
		<div id="navErr" hidden>
		<input type="button" id="navErrPrecBt" value="Erreur précédente" disabled onclick="errGoPrec();"/>
		<br/>
		<span id="navErrMsg">Erreur n°1</span>
		<br/>
		<input type="button" id="navErrSuivBt" value="Erreur suivante" disabled onclick="errGoSuiv();"/>
		
		<input type="number" id="navErrCurr" value="-1" hidden />
		<input type="number" id="navErrMax" value="-1" hidden />
		</div>
	</body>
</html>