<?php
require '../../dbconfig.php';
try {
    $handler = new PDO('mysql:host='.$host.'; dbname='.$worlddb, $user, $password);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SunCreatureText</title>
		<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.css">
		<script src="../../lib/jquery/jquery-1.11.2.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            #result > .table > tbody > tr > td {
                vertical-align: middle;
                text-align: center;
            }
            #result > .table > tbody > tr > td > span.glyphicon {
                cursor: pointer;
            }
            .has-feedback .form-control-feedback {
                top: 0px!important;
                z-index: 5;
            }
        </style>
	</head
	<body>
        <div class="col-md-10">
            <h2>Add a creature text</h2>
            <div class="row">
                <div class="col-md-4">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="guid" class="col-sm-2 control-label">Entry</label>
                            <div class="input-group col-sm-10">
                                <span class="input-group-addon" id="guidName">
<?php
if(isset($_GET['entry']) && preg_match('/[0-9]+/', $_GET['entry'])) {
    $entry          = htmlspecialchars($_GET['entry']);
    $getNameQuery   = $handler->prepare('SELECT ct.name
                                         FROM creature_template ct
                                         WHERE entry = :entry');
    $getNameQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getNameQuery->execute();
    $getName = $getNameQuery->fetch();
    
    echo $getName['name']; 
}
?>
                                </span>
                                <input type="text" class="form-control" value="<?php if(isset($_GET['entry'])) echo $_GET['entry']; ?>" id="guid" name="guid">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <h2>Help</h2>
            <p>See <a href="help.php">documentation</a>.</p>
        </div>
        <div id="result" class="col-md-12">
<?php 
if(isset($_GET['entry'])) {
    $_POST['entry'] = $_GET['entry'];
    include('fetch.php');
}
?>
        </div>
        <div class="col-md-2">
            <div class="form-group has-feedback">
                <div class="input-group">
                    <span class="input-group-addon">Group ID</span>
                    <input type="text" class="form-control" id="groupid">
                </div>
                <span class="glyphicon form-control-feedback" id="groupidspan" aria-hidden="true"></span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group has-feedback">
                <div class="input-group">
                    <span class="input-group-addon">ID</span>
                    <input type="text" class="form-control" id="id">
                </div>
                <span class="glyphicon form-control-feedback" id="idspan" aria-hidden="true"></span>
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" id="add" class="btn btn-primary">Add</button>
        </div>
        <script type="text/javascript">
            $('#add').click(function() {
                var Entry = $('#guid').val();
                var GID = $('#groupid').val();
                var ID = $('#id').val();
                $.ajax({
                    type : 'POST',
                    data : 'action=new&entry='+Entry+'&group_id='+GID+'&id='+ID,
                    url  : 'query.php',
                    success : function(){    
                        location.replace('index.php?entry='+Entry);
                        }
                    });
            });
            
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
                                $('#comment').attr('value', responseText+' - ');
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
            
            $('#groupid').keyup(function(){
                var Entry = $('#guid').val();
                var GroupID = $(this).val();
                var Success = $('#groupidspan');
                    $.ajax({
                    type : 'POST',
                    data : 'entry='+Entry+'&groupid='+GroupID,
                    url  : 'query.php',
                    success: 
                        function(responseText) {
                            if(responseText == 0){
                                Success.css('color', '#3EAE19').addClass('glyphicon-ok').removeClass('glyphicon-remove');
                            }
                            else {
                                Success.css('color', '#ff2f2f').addClass('glyphicon-remove').removeClass('glyphicon-ok');
                            }
                        }
                    });
            });
            
            $('#id').keyup(function(){
                var Entry = $('#guid').val();
                var GroupID = $('#groupid').val();
                var ID = $(this).val();
                var Success = $('#idspan');
                    $.ajax({
                    type : 'POST',
                    data : 'entry='+Entry+'&gid='+GroupID+'&id='+ID,
                    url  : 'query.php',
                    success: 
                        function(responseText) {
                            if(responseText == 0){
                                Success.css('color', '#3EAE19').addClass('glyphicon-ok').removeClass('glyphicon-remove');
                            }
                            else {
                                Success.css('color', '#ff2f2f').addClass('glyphicon-remove').removeClass('glyphicon-ok');
                            }
                        }
                    });
            });
            
            $('#guid').keyup(function(){
                var Entry = $(this).val();
                var Result = $('#result');
                
                var UrlToPass = 'entry='+Entry;
                    $.ajax({
                    type : 'POST',
                    data : UrlToPass,
                    url  : 'fetch.php',
                    success: 
                        function(responseText) {
                            if(responseText != null){
                                Result.html(responseText);
                            }
                        }
                    });
            });
        </script>
    </body>
</html>