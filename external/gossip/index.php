<?php
require '../../dbconfig.php';
try {
    $handler = new PDO("mysql:host=".$db['world']['host'].";port=".$db['world']['port'].";dbname=".$db['world']['database']['world'], $db['world']['user'], $db['world']['password']);
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
        <style type="text/css">
            @font-face {
                font-family: Friz Quadrata TT;
                src: url('font/FRIZQT__.TTF');
            }
            .gossip {
                background: url('img/gossip.png') no-repeat;
                width: 354px;
                height: 446px;
                position: relative;
                padding: 21px 0 0 0;
            }
            .guid_name {
                color: #fff;
                text-shadow: 1px 1px 0px #000;
                font-family: 'Friz Quadrata TT', serif;
                padding: 0 0 0 73px;
                text-align: center;
                letter-spacing: 0.2px;
                width: 330px;
                height: 20px;
            }
            .gossip_text {
                color: #231d16;
                font-family: 'Friz Quadrata TT', serif;
                letter-spacing: 0.2px;
                line-height: 1;
                width: 290px;
                margin: auto;
                padding: 50px 0 0 0;
            }
            .options:first-child,
            .options:hover:first-child {
                margin-top: 20px;
            }
            .options {
                padding: 1px 0;
                position: relative;
                margin: 0 0 3px 0;
                cursor: pointer;
            }
            .options img {
                vertical-align: top;
            }
            .options:hover::after {
                display: block;
            }
            .options::after {
                content: "";
                display: none;
                background: url('img/UI-Listbox-Highlight.png') no-repeat;
                opacity: .75;
                background-size: 100% 100%;
                mix-blend-mode: color-dodge;
                width: 100%;
                height: 20px;
                padding: 1px 0;
                position: absolute;
                margin: -20px 0 0 0;
                z-index: 2;
            }
        </style>
	</head>
	<body>
        <div class="gossip">
            <div class="guid_name"></div>
            <div class="gossip_text">
                Even in peace there is still war, and many clans still fight beneath the banner of the Warchief. Are you here to add your clan to those that fight for Orgrimmar?
                <div class="options">
                    <img src="img/GossipGossipIcon.png" alt="Gossip" /> How ma doin'?
                </div>
                <div class="options">
                    <img src="img/GossipGossipIcon.png" alt="Gossip" /> How ya doin'?
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <h2>Add a gossip</h2>
            <div class="row">
                <form class="form-horizontal">
                    <div class="form-group col-md-5">
                        <label for="guid" class="col-sm-3 control-label">Guid</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon" id="guidName"></span>
                            <input type="text" class="form-control" id="guid" name="guid">
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="guid" class="col-sm-3 control-label">Menu</label>
                        <div class="col-sm-5">
                            <select class="form-control">
                                <option value=""></option>
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </div>
                        <button type="button" id="add" class="btn btn-primary col-sm-2">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2">
            <h2>Help</h2>
            <p>See <a href="help.php">documentation</a>.</p>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Text</label>
                        <textarea class="form-control" name="enmale" rows="2"></textarea>
                        <h5>Options</h5>
                        <table class="table table-striped" style="margin-bottom: 0!important;">
                            <tr>
                                <td>ID</td>
                                <td>
                                    <select class="form-control">
                                        <option value=""></option>
                                        <option value=""></option>
                                        <option value=""></option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h3>Hello Gossip</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Text - NPC is a male</label>
                        <textarea class="form-control" name="enmale" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Text - NPC is a female</label>
                        <textarea class="form-control" name="enfemale" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>FR(optional) - Text - NPC is a male</label>
                        <textarea class="form-control" name="frmale" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>FR(optional) - Text - NPC is a female</label>
                        <textarea class="form-control" name="frfemale" rows="3"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
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
                                $('.guid_name').html(responseText);
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