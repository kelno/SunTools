<?php
require '../../dbconfig.php';
try {
    $handler = new PDO('mysql:host='.$host.'; dbname='.$worlddb, $user, $password);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

if(isset($_POST['entry']) && preg_match('/[0-9]+/', $_POST['entry'])) {
    $entry          = htmlentities($_POST['entry']);
    $getResultQuery = $handler->prepare('SELECT *
                                         FROM creature_text
                                         WHERE entry = :entry');
    $getResultQuery->bindValue(':entry', $entry, PDO::PARAM_INT);
    $getResultQuery->execute();
    
    if($getResultQuery->rowCount() != null) {
        echo '<table class="table table-striped" style="margin-bottom: 0!important;">
                    <thead>
                        <tr>
                            <th title="Group ID" width="2%">GID</th>
                            <th width="2%">ID</th>
                            <th width="5%">Chance</th>
                            <th width="7%">Sound</th>
                            <th width="5%">Duration</th>
                            <th width="7%">Type</th>
                            <th width="13%">Language</th>
                            <th width="11%">Emote</th>
                            <th width="15%">Text EN</th>
                            <th width="15%">Text FR(optional)</th>
                            <th width="16%">Comment</th>
                            <th width="2%"></th>
                        </tr>
                    </thead>
                    <tbody>';
        while ($getResult = $getResultQuery->fetch()) {
?>
                        <tr>
                            <td><?php echo $getResult["groupid"]; ?></td>
                            <td><?php echo $getResult["id"]; ?></td>
                            <td>
                                <input type="text" class="form-control" value="<?php echo $getResult["probability"]; ?>" onchange="update('8', this.value, <?php echo $getResult["entry"]; ?>,<?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="<?php echo $getResult["sound"]; ?>" onchange="update('11', this.value, <?php echo $getResult["entry"]; ?>, <?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="<?php echo $getResult["duration"]; ?>" onchange="update('10', this.value, <?php echo $getResult["entry"]; ?>, <?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)">
                            </td>
                            <td>
                                <select class="form-control" onchange="update('6', this.value, <?php echo $getResult["entry"]; ?>,<?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)">
                                    <option value="0" <?php if ($getResult["type"] == 0) echo "selected=selected"; ?>>Say</option>
                                    <option value="1" <?php if ($getResult["type"] == 1) echo "selected=selected"; ?>>Yell</option>
                                    <option value="2" <?php if ($getResult["type"] == 2) echo "selected=selected"; ?>>Emote</option>
                                    <option value="3" <?php if ($getResult["type"] == 3) echo "selected=selected"; ?>>Boss Emote</option>
                                    <option value="4" <?php if ($getResult["type"] == 4) echo "selected=selected"; ?>>Whisper</option>
                                    <option value="5" <?php if ($getResult["type"] == 5) echo "selected=selected"; ?>>Boss Whisper</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" onchange="update('7', this.value, <?php echo $getResult["entry"]; ?>,<?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)">
                                    <option value="0" <?php if ($getResult["language"] == 0) echo "selected=selected"; ?>>All understand</option>
                                    <option value="1" <?php if ($getResult["language"] == 1) echo "selected=selected"; ?>>Orcish</option>
                                    <option value="2" <?php if ($getResult["language"] == 2) echo "selected=selected"; ?>>Darnassian</option>
                                    <option value="3" <?php if ($getResult["language"] == 3) echo "selected=selected"; ?>>Taurahe</option>
                                    <option value="6" <?php if ($getResult["language"] == 6) echo "selected=selected"; ?>>Dwarvish</option>
                                    <option value="7" <?php if ($getResult["language"] == 7) echo "selected=selected"; ?>>Common</option>
                                    <option value="8" <?php if ($getResult["language"] == 8) echo "selected=selected"; ?>>Demonic</option>
                                    <option value="9" <?php if ($getResult["language"] == 9) echo "selected=selected"; ?>>Titan</option>
                                    <option value="10" <?php if ($getResult["language"] == 10) echo "selected=selected"; ?>>Thalassian</option>
                                    <option value="11" <?php if ($getResult["language"] == 11) echo "selected=selected"; ?>>Draconic</option>
                                    <option value="12" <?php if ($getResult["language"] == 12) echo "selected=selected"; ?>>Kalimag</option>
                                    <option value="13" <?php if ($getResult["language"] == 13) echo "selected=selected"; ?>>Gnomish</option>
                                    <option value="14" <?php if ($getResult["language"] == 14) echo "selected=selected"; ?>>Troll</option>
                                    <option value="33" <?php if ($getResult["language"] == 33) echo "selected=selected"; ?>>Gutterspeak</option>
                                    <option value="35" <?php if ($getResult["language"] == 35) echo "selected=selected"; ?>>Draenei</option>
                                    <option value="36" <?php if ($getResult["language"] == 36) echo "selected=selected"; ?>>Zombie</option>
                                    <option value="37" <?php if ($getResult["language"] == 37) echo "selected=selected"; ?>>Gnomish Binary</option>
                                    <option value="38" <?php if ($getResult["language"] == 38) echo "selected=selected"; ?>>Goblin Binary</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" onchange="update('9', this.value, <?php echo $getResult["entry"]; ?>,<?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)">
                                    <option value="0" <?php if ($getResult["emote"] == 0) echo "selected=selected"; ?>>None</option>
                                    <option value="1" <?php if ($getResult["emote"] == 1) echo "selected=selected"; ?>>Talk</option>
                                    <option value="2" <?php if ($getResult["emote"] == 2) echo "selected=selected"; ?>>Bow</option>
                                    <option value="3" <?php if ($getResult["emote"] == 3) echo "selected=selected"; ?>>Wave</option>
                                    <option value="4" <?php if ($getResult["emote"] == 4) echo "selected=selected"; ?>>Cheer</option>
                                    <option value="5" <?php if ($getResult["emote"] == 5) echo "selected=selected"; ?>>Exclamation</option>
                                    <option value="6" <?php if ($getResult["emote"] == 6) echo "selected=selected"; ?>>Question</option>
                                    <option value="7" <?php if ($getResult["emote"] == 7) echo "selected=selected"; ?>>Eat</option>
                                    <option value="11" <?php if ($getResult["emote"] == 11) echo "selected=selected"; ?>>Laugh</option>
                                    <option value="14" <?php if ($getResult["emote"] == 14) echo "selected=selected"; ?>>Rude</option>
                                    <option value="15" <?php if ($getResult["emote"] == 15) echo "selected=selected"; ?>>Roar</option>
                                    <option value="16" <?php if ($getResult["emote"] == 16) echo "selected=selected"; ?>>Kneel</option>
                                    <option value="17" <?php if ($getResult["emote"] == 17) echo "selected=selected"; ?>>Kiss</option>
                                    <option value="18" <?php if ($getResult["emote"] == 18) echo "selected=selected"; ?>>Cry</option>
                                    <option value="19" <?php if ($getResult["emote"] == 19) echo "selected=selected"; ?>>Chicken</option>
                                    <option value="20" <?php if ($getResult["emote"] == 20) echo "selected=selected"; ?>>Beg</option>
                                    <option value="21" <?php if ($getResult["emote"] == 21) echo "selected=selected"; ?>>Applaud</option>
                                    <option value="22" <?php if ($getResult["emote"] == 22) echo "selected=selected"; ?>>Shout</option>
                                    <option value="23" <?php if ($getResult["emote"] == 23) echo "selected=selected"; ?>>Flex</option>
                                    <option value="24" <?php if ($getResult["emote"] == 24) echo "selected=selected"; ?>>Shy</option>
                                    <option value="25" <?php if ($getResult["emote"] == 25) echo "selected=selected"; ?>>Point</option>
                                    <option value="66" <?php if ($getResult["emote"] == 66) echo "selected=selected"; ?>>Salute</option>
                                    <option value="94" <?php if ($getResult["emote"] == 94) echo "selected=selected"; ?>>Dance</option>
                                    <option value="273" <?php if ($getResult["emote"] == 273) echo "selected=selected"; ?>>Yes</option>
                                    <option value="274" <?php if ($getResult["emote"] == 274) echo "selected=selected"; ?>>No</option>
                                    <option value="275" <?php if ($getResult["emote"] == 275) echo "selected=selected"; ?>>Train</option>
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control" rows="2" onchange="update('4', this.value, <?php echo $getResult["entry"]; ?>,<?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)"><?php echo $getResult["text_en"]; ?></textarea>
                            </td>
                            <td>
                                <textarea class="form-control" rows="2" onchange="update('5', this.value, <?php echo $getResult["entry"]; ?>,<?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)"><?php echo $getResult["text_fr"]; ?></textarea>
                            </td>
                            <td>
                                <textarea class="form-control" rows="2" onchange="update('12', this.value, <?php echo $getResult["entry"]; ?>,<?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)"><?php echo $getResult["comment"]; ?></textarea>
                            </td>
                            <td><span class="glyphicon glyphicon-remove" onclick="removeLine(<?php echo $getResult["entry"]; ?>, <?php echo $getResult["groupid"]; ?>, <?php echo $getResult["id"]; ?>)"></span></td>
                        </tr>
<?php
        }
?>
                    </tbody>
                </table>
            <script type="text/javascript">
                function update(field, value, entry, groupid, id) {
                    var UrlToPass = 'entry='+entry+'&group_id='+groupid+'&id='+id+'&field='+field+'&value='+value;
                    $.ajax({
                        type : 'POST',
                        data : UrlToPass,
                        url  : 'query.php'
                    });
                }
                
                function removeLine(entry, groupid, id) {
                    var Confirm = confirm("Are you sure you want to delete this line?")
                    if (Confirm == true) {
                        var UrlToPass = 'action=remove&entry='+entry+'&group_id='+groupid+'&id='+id;
                        $.ajax({
                            type : 'POST',
                            data : UrlToPass,
                            url  : 'query.php',
                            success : function(){    
                                location.replace('index.php?entry='+entry);
                                }
                        });
                    }
                }
            </script>
<?php
    }
}
?>