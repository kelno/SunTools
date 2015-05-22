<?php

require('../../dbconfig.php');

try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

$query = $handler->query('SELECT entryorguid FROM smart_scripts WHERE entryorguid BETWEEN 50000 AND 50100 ORDER BY entryorguid DESC LIMIT 1');
$available = $query->fetch();
 
if ($query->rowCount() == null) {
    $entry = "50000";
} else {
    $entry = $available['entryorguid'] + 1;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Entry Availability</title>
		<link rel="stylesheet" href="../../lib/jquery/css/jquery.dataTables.css">
		<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../lib/jquery/jquery-1.11.2.min.js"></script>
		<script src="../../lib/jquery/jquery.dataTables.js"></script>
	</head>
	<body>
        <p>L'entry <strong><?php echo $entry; ?></strong> est disponible !</p>
    </body>
</html>