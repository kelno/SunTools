<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Commands</title>
		<link rel="stylesheet" href="../quests/css/jquery.dataTables.css">
		<link rel="stylesheet" href="../quests/css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../quests/js/jquery-1.11.2.min.js"></script>
		<script src="../quests/js/jquery.dataTables.js"></script>
	</head>
	<body>
<?php
require('../config.php');
try {
    $handler = new PDO('mysql:host=62.210.236.104;dbname=world', 'nastyadmin', 'Z9EuAAtxPtA5gt3F', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

$getCommands = $handler->query('SELECT name, help FROM command');
?>
			<div class="fluid-container">
				<table id="table" class="table table-hover">
					<thead>
						<tr class="top">
							<td width="15%"><strong>Command</strong></td>
							<td><strong>Help</strong></td>
						</tr>
					</thead>
					<tbody>
	<?php 
		while ($commands = $getCommands->fetch()) {
	?>
						<tr>
							<td><strong>.<?php echo $commands['name']; ?></strong></td>
							<td><?php echo nl2br($commands['help']); ?></td>
						</tr>
	<?php
										  }
	?>
					</tbody>
				</table>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#table').dataTable( {
						"scrollY":        "calc(100vh - 68px)",
						"scrollCollapse": false,
						"paging":         false,
						"order": [[ 0, "asc" ]]
					} );
				} );
			</script>
		</body>
	</html>