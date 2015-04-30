<?php
try {
    $handler = new PDO('mysql:host=62.210.236.104;dbname=world', 'nastyadmin', 'Z9EuAAtxPtA5gt3F');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if (!isset($_POST['guid']) && !isset($_POST['enmale']) && !isset($_POST['enfemale']) && !isset($_POST['frmale']) && !isset($_POST['frfemale'])) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SunGossip</title>
		<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.css">
		<script src="../../lib/jquery/jquery-1.11.2.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
        <div class="col-md-6">
            <h2>Add a gossip</h2>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="guid">Guid</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="guidName"></span>
                        <input type="text" class="form-control" id="guid" name="guid">
                    </div>
                </div>
                <div class="form-group">
                    <label>Text - NPC is a male</label>
                    <textarea class="form-control" name="enmale" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Text - NPC is a female</label>
                    <textarea class="form-control" name="enfemale" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>FR(optional) - Text - NPC is a male</label>
                    <textarea class="form-control" name="frmale" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>FR(optional) - Text - NPC is a female</label>
                    <textarea class="form-control" name="frfemale" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <div class="col-md-6">
            <h2>Add a gossip menu</h2>
            <h2>Help</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="15%">Variable</th>
                        <th width="20%">Syntax</th>
                        <th widht="32.5%">Usage</th>
                        <th width="32.5%">Example</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>$n</td>
                        <td>Greetings $n!</td>
                        <td>Greetings Karabor!</td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td>$c</td>
                        <td>Thank you, $c.</td>
                        <td>Thank you, shaman.</td>
                    </tr>
                    <tr>
                        <td>Race</td>
                        <td>$r</td>
                        <td>Welcome $r!</td>
                        <td>Welcome orc!</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>$g<em>male</em>:<em>female</em></td>
                        <td>I'm a $gboy:girl.</td>
                        <td>Male: I'm a boy.<br>Female : I'm a girl.</td>
                    </tr>
                    <tr>
                        <td>Break line</td>
                        <td>$b</td>
                        <td>Greetings stranger!$b$bTake this with you!$bGoodbye.</td>
                        <td>Greetings stranger!<br><br>Take this with you!<br>Goodbye.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">  
            $('#guid').keyup(function(){
                var Guid = $(this).val();
                var GuidName = $('#guidName');
                    var UrlToPass = 'guid='+Guid;
                    $.ajax({
                    type : 'POST',
                    data : UrlToPass,
                    url  : 'query.php',
                    success: 
                        function(responseText) {
                            if(responseText != null){
                                GuidName.html(responseText);
                            }
                            else{
                                alert('Problem with sql query');
                            }
                        }
                    });
                
                if(Guid.length == 0) {
                    GuidName.html('');
                }
            });
        </script>
    </body>
</html>
<?php
} else {
    $guid =     htmlspecialchars(preg_match('/[0-9]+/', $_POST['guid']));
    $enMale =   htmlspecialchars($_POST['enmale']);
    $enFemale = htmlspecialchars($_POST['enfemale']);
    $frMale =   htmlspecialchars($_POST['frmale']);
    $frFemale = htmlspecialchars($_POST['frfemale']);
}