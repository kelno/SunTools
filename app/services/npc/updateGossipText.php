<?php
/**
Update gossip service
Arguments : (column name => value) array
*/

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require("$root/suntools/app/services/GenericUpdater.php");

$tableList = array("gossip_text", "locales_gossip_text");
$updater = new GenericUpdater($tableList, $_POST);
$updater->apply();

echo "all okay";