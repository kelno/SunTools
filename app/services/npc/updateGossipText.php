<?php
require('../../../dbconfig.php');
require('../GenericUpdater.php');

$tableList = array("gossip_text", "locales_gossip_text");
$updater = new GenericUpdater($tableList, $_POST);
$updater->apply();

echo "all okay";