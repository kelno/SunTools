<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SunCreatureText - Help</title>
		<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.css">
		<script src="../../lib/jquery/jquery-1.11.2.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
        <div class="col-md-4">
                        <h3>Structure</h3>
                        <ul>
                            <li>Group ID 0
                                <ul>
                                    <li>ID 0</li>
                                    <li>ID 1</li>
                                </ul>
                            </li>
                            <li>Group ID 1
                                <ul>
                                    <li>ID 0</li>
                                    <li>ID 1</li>
                                    <li>ID 2</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <h3>Example: Brutallus</h3>
                        <ul>
                            <li>Group ID 0 (In this case, used on Aggro)
                                <ul>
                                    <li>ID 0 : Ahh! More lambs to the slaughter!</li>
                                </ul>
                            </li>
                            <li>Group ID 1 (In this case, used when killing a player)
                                <ul>
                                    <li>ID 0 : Perish, insect!</li>
                                    <li>ID 1 : You are meat!</li>
                                    <li>ID 2 : Too easy!</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <div class="col-md-12">
                    <p>
                        The `Group ID` field identifies a text group and is the identifier used in the smart script action.<br>
                        The `ID` field identifies a phrase within the text group. When a script uses a text group, it will randomly select one ID within this group.
                    </p>
                    <h3>Text</h3>
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
                                <td>Creature</td>
                                <td>%s</td>
                                <td>%s is mad.</td>
                                <td>Hodor is mad.</td>
                            </tr>
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
                                <td>Break line</td>
                                <td>$b</td>
                                <td>Greetings stranger!$bTake this with you!</td>
                                <td>Greetings stranger!<br>Take this with you!</td>
                            </tr>
                        </tbody>
                    </table>
        </div>
    </body>
</html>