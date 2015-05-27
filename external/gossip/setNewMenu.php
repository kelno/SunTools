<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}               

if(isset($_GET['guid']) && preg_match('/[0-9]+/', $_GET['guid'])
&& isset($_GET['newmenu']) && $_GET['newmenu'] == true ){
   $guid           = htmlspecialchars($_GET['guid']);

    // Get a new menu id
    $select         = $handler->query('SELECT MAX(entry) as maxMenu FROM gossip_menu');
    $select->execute();
    $getSelect = $select->fetch();

    $maxMenu = $getSelect['maxMenu'] + 1;

    $Infos = [ "new"   => $maxMenu ];
    
    echo json_encode($Infos);
}