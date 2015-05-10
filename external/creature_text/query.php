<?php
try {
    $handler = new PDO('mysql:host=62.210.236.104;dbname=world', 'nastyadmin', 'Z9EuAAtxPtA5gt3F');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if(isset($_POST['guid']) && preg_match('/[0-9]+/', $_POST['guid'])) {
    $guid           = htmlspecialchars($_POST['guid']);
    $getNameQuery   = $handler->prepare('SELECT ct.name
                                         FROM creature_template ct
                                         WHERE entry = :guid');
    $getNameQuery->bindValue(':guid', $guid, PDO::PARAM_INT);
    $getNameQuery->execute();
    $getName = $getNameQuery->fetch();
    
    echo $getName['name']; 
}

if(isset($_POST['entry']) && preg_match('/[0-9]+/', $_POST['entry']) 
   && isset($_POST['groupid']) && preg_match('/[0-9]+/', $_POST['groupid'])) {
    $entry              = htmlspecialchars($_POST['entry']);
    $groupID            = htmlspecialchars($_POST['groupid']);
    $getGroupIDQuery    = $handler->prepare('SELECT groupid
                                             FROM creature_text
                                             WHERE entry = :entry AND groupid = :groupID');
    $getGroupIDQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getGroupIDQuery->bindValue(':groupID', $groupID, PDO::PARAM_INT);
    $getGroupIDQuery->execute();
    $getGroupID = $getGroupIDQuery->fetch();
    
    
    echo $getGroupIDQuery->rowCount();
}

if(isset($_POST['entry']) && preg_match('/[0-9]+/', $_POST['entry']) 
   && isset($_POST['gid']) && preg_match('/[0-9]+/', $_POST['gid'])
   && isset($_POST['id']) && preg_match('/[0-9]+/', $_POST['id'])) {
    $entry              = htmlspecialchars($_POST['entry']);
    $groupID            = htmlspecialchars($_POST['gid']);
    $ID                 = htmlspecialchars($_POST['id']);
    $getIDQuery    = $handler->prepare('SELECT id
                                        FROM creature_text
                                        WHERE entry = :entry AND groupid = :groupID AND id = :ID');
    $getIDQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getIDQuery->bindValue(':groupID', $groupID, PDO::PARAM_INT);
    $getIDQuery->bindValue(':ID', $ID, PDO::PARAM_INT);
    $getIDQuery->execute();
    $getID = $getIDQuery->fetch();
    
    
    echo $getIDQuery->rowCount();
}

if(isset($_POST['entry']) && preg_match('/[0-9]+/', $_POST['entry']) 
   && isset($_POST['group_id']) && preg_match('/[0-9]+/', $_POST['group_id'])
   && isset($_POST['id']) && preg_match('/[0-9]+/', $_POST['id'])
   && isset($_POST['field']) && preg_match('/[0-9]+/', $_POST['field'])
   && isset($_POST['value'])) {
    $entry              = htmlspecialchars($_POST['entry']);
    $groupID            = htmlspecialchars($_POST['group_id']);
    $ID                 = htmlspecialchars($_POST['id']);
    $field              = htmlspecialchars($_POST['field']);
    $value              = htmlspecialchars($_POST['value']);
    
    switch($field) {
        case 2: $column  = "groupid"; break;
        case 3: $column  = "id"; break;
        case 4: $column  = "text"; break;
        case 5: $column  = "type"; break;
        case 6: $column  = "language"; break;
        case 7: $column  = "probability"; break;
        case 8: $column  = "emote"; break;
        case 9: $column = "duration"; break;
        case 10: $column = "sound"; break;
        case 11: $column = "comment"; break;
        default: return;
    }
    
    $getIDQuery    = $handler->prepare('INSERT INTO creature_text (entry, groupid, id, ' . $column . ')
									    VALUE (:entry, :groupid, :id , :value)
									    ON DUPLICATE KEY UPDATE ' . $column . ' = :value');
    $getIDQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getIDQuery->bindValue(':groupid', $groupID, PDO::PARAM_INT);
    $getIDQuery->bindValue(':id', $ID, PDO::PARAM_INT);
    $getIDQuery->bindValue(':value', $value, PDO::PARAM_INT);
    $getIDQuery->execute();
}

if(isset($_POST['action']) && $_POST['action'] == "remove"
   && isset($_POST['entry']) && preg_match('/[0-9]+/', $_POST['entry']) 
   && isset($_POST['group_id']) && preg_match('/[0-9]+/', $_POST['group_id'])
   && isset($_POST['id']) && preg_match('/[0-9]+/', $_POST['id'])) {
    $entry              = htmlspecialchars($_POST['entry']);
    $groupID            = htmlspecialchars($_POST['group_id']);
    $ID                 = htmlspecialchars($_POST['id']);
    
    $getIDQuery         = $handler->prepare('DELETE FROM creature_text WHERE entry = :entry AND groupid = :groupid AND id = :id');
    $getIDQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getIDQuery->bindValue(':groupid', $groupID, PDO::PARAM_INT);
    $getIDQuery->bindValue(':id', $ID, PDO::PARAM_INT);
    $getIDQuery->execute();
}

if(isset($_POST['action']) && $_POST['action'] == "new"
   && isset($_POST['entry']) && preg_match('/[0-9]+/', $_POST['entry']) 
   && isset($_POST['group_id']) && preg_match('/[0-9]+/', $_POST['group_id'])
   && isset($_POST['id']) && preg_match('/[0-9]+/', $_POST['id'])) {
    $entry              = htmlspecialchars($_POST['entry']);
    $groupID            = htmlspecialchars($_POST['group_id']);
    $ID                 = htmlspecialchars($_POST['id']);
    
    $getNameQuery       = $handler->prepare('SELECT name FROM creature_template WHERE entry = :entry');
    $getNameQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getNameQuery->execute();
    $getName = $getNameQuery->fetch();
    $name               = $getName['name'] . ' - ';
    
    $getIDQuery         = $handler->prepare('INSERT INTO creature_text (entry, groupid, id, probability, comment) VALUE (:entry, :groupid, :id, 100, :name)');
    $getIDQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getIDQuery->bindValue(':groupid', $groupID, PDO::PARAM_INT);
    $getIDQuery->bindValue(':id', $ID, PDO::PARAM_INT);
    $getIDQuery->bindValue(':name', $name, PDO::PARAM_STR);
    $getIDQuery->execute();
}