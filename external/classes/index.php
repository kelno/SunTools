<?php
require('../../dbconfig.php');
require('stats.php');
try {
    $handler = new PDO("mysql:host=".$db['suntools']['host'].";port=".$db['suntools']['port'].";dbname=".$db['suntools']['database']['suntools'], $db['suntools']['user'], $db['suntools']['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

function selected($value, $id) {
    if ($value == $id) {
        return "selected=selected";
    }
}

function getClass($category, $spe) {
    global $handler, $class;
    
    $category = strtolower($category);
    
    $query = $handler->prepare('SELECT * FROM class_test_' . $category .' WHERE class = :class AND spe = :spe');
    $query->bindValue(':class', $class, PDO::PARAM_INT);
    $query->bindValue(':spe', $spe, PDO::PARAM_INT);
    $query->execute();
    
    echo
        '<table id="' . $category . '-' . $spe . '" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tested</th>
                                <th>Name</th>
                                <th>Tester</th>
                                <th>Issue</th>
                            </tr>
                        </thead>
                        <tbody>';
    
    while ($getClassTalents = $query->fetch()) {
        $check = "";
        if ($getClassTalents['tested'] == 1) {
            $check = "yes";
        } else {
            $check = "no";
        }
        
        if ($getClassTalents['issue'] == 0) {
            $getClassTalents['issue'] = null;
            
            $link = '#';
        } else {
            $link = '<a href="https://github.com/Nqsty/Sunstrider-Classes-Issues/issues/' . $getClassTalents['issue'] .'">#</a>';
        }
        
        $name = str_replace("'", "\'", $getClassTalents['name']);
    
        echo
            
                            '<tr>
                                <td>
                                    <select class="form-control" onchange="update(\'' . $category .'\', \'' . $name . '\', \'tested\', this.value)">
                                        <option value="0">Choose</option>
                                        <option value="1" ' . selected($getClassTalents['tested'], 1) . '>Assigned</option>
                                        <option value="2" ' . selected($getClassTalents['tested'], 2) . '>OK</option>
                                        <option value="3" ' . selected($getClassTalents['tested'], 3) . '>BUG</option>
                                    </select>
                                </td>
                                <td>' . $getClassTalents['name'] . '</td>
                                <td>
                                    <select class="form-control" onchange="update(\'' . $category .'\', \'' . $name . '\', \'tester\', this.value)">
                                        <option value="0">Choose</option>
                                        <option value="1" ' . selected($getClassTalents['tester'], 1) . '>Athene</option>
                                        <option value="2" ' . selected($getClassTalents['tester'], 2) . '>Beldin</option>
                                        <option value="3" ' . selected($getClassTalents['tester'], 3) . '>Brainjuice</option>
                                        <option value="4" ' . selected($getClassTalents['tester'], 4) . '>Gadianna</option>
                                        <option value="5" ' . selected($getClassTalents['tester'], 5) . '>Horius</option>
                                        <option value="6" ' . selected($getClassTalents['tester'], 6) . '>Kadaver</option>
                                        <option value="7" ' . selected($getClassTalents['tester'], 7) . '>Krimi</option>
                                        <option value="8" ' . selected($getClassTalents['tester'], 8) . '>Laws</option>
                                        <option value="9" ' . selected($getClassTalents['tester'], 9) . '>Leekie</option>
                                        <option value="10" ' . selected($getClassTalents['tester'], 10) . '>Mikelus</option>
                                        <option value="11" ' . selected($getClassTalents['tester'], 11) . '>Muranounet</option>
                                        <option value="12" ' . selected($getClassTalents['tester'], 12) . '>Potestas</option>
                                        <option value="13" ' . selected($getClassTalents['tester'], 13) . '>Vanquish</option>
                                        <option value="14" ' . selected($getClassTalents['tester'], 14) . '>Yukka</option>
                                    </select>
                                </td>
                                <td>' . $link .' <input class="form-control" type="text" onchange="update(\'' . $category .'\', \'' . $name . '\', \'issue\', this.value)" value="' . $getClassTalents['issue'] . '" /></td>
                            </tr>';
    }
    echo 
                        '</tbody>
                    </table>';
        
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SunClasses</title>
		<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../lib/jquery/jquery-1.11.2.min.js"></script>
        <style type="text/css">
            .table > tbody > tr > td {
                vertical-align: middle;
            }
            .table > thead > tr > th,
            .table > tbody > tr > td {
                text-align: center;
            }
            .table > tbody > tr > td:nth-child(2) {
                text-align: left;
            }
            .table > tbody > tr > td > input {
                width: 50px;
                text-align: center;
                display: inline;
            }
            .table > tbody > tr > td > select {
                width: 128px;
                text-align: center;
                display: inline;
            }
            ul {
                padding: 0;
            }
            ul > li {
                display: inline-block;
                margin: 0 20px;
            }
            ul > li:first-child {
                display: inline-block;
                margin: 0 40px 10px 0;
            }
            .progress {
                clear: both;
            }
        </style>
	</head>
	<body>
<?php
if(!isset($_GET['class'])) {
	echo '<div class="col-md-12">
                <h2>SunClasses</h2>
                <p>
                    <a href="https://github.com/Nqsty/Sunstrider-Classes-Issues/issues">Issue Tracker</a> - <a href="https://github.com/Nqsty/Sunstrider-Classes-Issues/wiki">Wiki</a>
                </p>
            </div>';
    echo globalProgression();
    echo classProgression(11);
    echo classProgression(3);
    echo classProgression(8);
    echo classProgression(2);
    echo classProgression(5);
    echo classProgression(4);
    echo classProgression(7);
    echo classProgression(9);
    echo classProgression(1);

} else {
    $class = htmlspecialchars($_GET['class']);
    
    switch($class) {
        case "warrior": $class = 1;     $spe1 = "Arms";             $spe2 = "Fury";         $spe3 = "Protection";   break;
        case "paladin": $class = 2;     $spe1 = "Holy";             $spe2 = "Protection";   $spe3 = "Retribution";  break;
        case "hunter":  $class = 3;     $spe1 = "Beast Mastery";    $spe2 = "Marksmanship"; $spe3 = "Survival";     break;
        case "rogue":   $class = 4;     $spe1 = "Assassination";    $spe2 = "Combat";       $spe3 = "Subtlety";     break;
        case "priest":  $class = 5;     $spe1 = "Discipline";       $spe2 = "Holy";         $spe3 = "Shadow";       break;
        case "shaman":  $class = 7;     $spe1 = "Elemental";        $spe2 = "Enhancement";  $spe3 = "Restoration";  break;
        case "mage":    $class = 8;     $spe1 = "Arcane";           $spe2 = "Fire";         $spe3 = "Frost";        break;
        case "warlock": $class = 9;     $spe1 = "Affliction";       $spe2 = "Demonology";   $spe3 = "Destruction";  break;
        case "druid":   $class = 11;    $spe1 = "Balance";          $spe2 = "Feral";        $spe3 = "Restoration";  break;
        default:        header('Location: ./');
    }
    
    echo
			'<div class="fluid-container">
                <div class="col-md-12">
                    <h1>' . ucfirst($_GET['class']) . '</h1>
                </div>
                <div class="col-md-6">
                    <h3>Talents</h3>
                    <button id="talents1" onclick="display(\'talents\', 1)" type="button" class="btn btn-primary">' . $spe1 . '</button>
                    <button id="talents2" onclick="display(\'talents\', 2)" type="button" class="btn btn-default">' . $spe2 . '</button>
                    <button id="talents3" onclick="display(\'talents\', 3)" type="button" class="btn btn-default">' . $spe3 . '</button>';
    
    getClass("talents", 1);
    getClass("talents", 2);
    getClass("talents", 3);
    
    echo
                '</div>
                <div class="col-md-6">
                    <h3>Spells</h3>
                    <button id="spells1" onclick="display(\'spells\', 1)" type="button" class="btn btn-primary">' . $spe1 . '</button>
                    <button id="spells2" onclick="display(\'spells\', 2)" type="button" class="btn btn-default">' . $spe2 . '</button>
                    <button id="spells3" onclick="display(\'spells\', 3)" type="button" class="btn btn-default">' . $spe3 . '</button>';
    
    getClass("spells", 1);
    getClass("spells", 2);
    getClass("spells", 3);
    
?>
			</div>
			<script type="text/javascript">                
                $('#spells-2').hide();
                $('#spells-3').hide();
                $('#talents-2').hide();
                $('#talents-3').hide();
                
                $('.btn').click(function() {
                    $(this).addClass('btn-primary').removeClass('btn-default').siblings('.btn').removeClass('btn-primary').addClass('btn-default');
                });
                
                function display(category, spe) {
                    var element = $('#'+category+spe);
                    
                    $(element).click(function(){
                        $('#'+category+'-'+spe).show().siblings('table').hide();
                    });
                }
                
                function update(category, name, field, value) {
                    var Class = <?php echo $class; ?>;
                    
                    if (value == "") {
                        value = 0;
                    }
                    
                    var UrlToPass = 'category='+category+'&class='+Class+'&name='+name+'&field='+field+'&value='+value;
                    $.ajax({
                        type : 'GET',
                        data : UrlToPass,
                        url  : 'query.php'
                    });
                }
			</script>
		</body>
	</html>
<?php
}
?>
