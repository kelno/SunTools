<?php
require '../../dbconfig.php';
try {
    $handler = new PDO('mysql:host='.$host.'; dbname='.$suntoolsdb, $user, $password);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if(isset($_GET['category']) && preg_match('/talents|spells/', $_GET['category']) 
   && isset($_GET['class']) && preg_match('/[0-9]+/', $_GET['class'])
   && isset($_GET['name']) && preg_match('/(([A-z \'-:])+)+/', $_GET['name'])
   && isset($_GET['field']) && preg_match('/[a-z]+/', $_GET['field'])
   && isset($_GET['value'])) {
    $category           = htmlspecialchars($_GET['category']);
    $class              = htmlspecialchars($_GET['class']);
    $name               = htmlspecialchars($_GET['name']);
    $field              = htmlspecialchars($_GET['field']);
    $value              = htmlspecialchars($_GET['value']);
    
    $query         = $handler->prepare('UPDATE class_test_' . $category . ' SET ' . $field . ' = ' . $value . ' WHERE name = :name AND class = :class');
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':class', $class, PDO::PARAM_INT);
    $query->execute();
}