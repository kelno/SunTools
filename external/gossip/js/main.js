"use strict";

var GuidName        = $('#guidName'); 
var GossipUI        = $('.gossip');
var GossipName      = $('.guid_name');
var GossipText      = $('#gossip_text');
var GossipTextUI    = $('.gossip_text');
var GossipOptions   = $('#gossip_options tbody');
var GossipOptionsUI = $('.gossip_options');
var Menus           = $('#menus');
var MenusSelect     = $('#menusselect');
var AddMenu         = $('#add');
var AddOption       = $('#addoption');
var newConditionID;
var getNewCondition = -1;
var i;
var x;
var Data;
var GossipIcon;
var OptionsCount;
var NewOptionsCount;
var Condition;

AddMenu.hide();
Menus.hide();
MenusSelect.hide();

$('#guid').keyup(function(){
    var Guid    = $(this).val();
    $.ajax({
    type : 'GET',
    data : 'guid=' + Guid,
    url  : 'getGossip.php',
    //url  : 'getInfos.php',
    dataType: 'json',
    success: 
        function(data) {
            $('#result').html('');
            Menus.hide();
            AddMenu.hide();
            MenusSelect.html('').hide();
            GossipText.html('');
            GossipTextUI.html('');
            GossipOptionsUI.html('');
            GossipOptions.html('');
            Data = data;
            OptionsCount = "";
            NewOptionsCount = "";
            
            if(data.name != null) {
                console.log(data);
                GuidName.html(data.name);
                
                if(data.options) {
                    OptionsCount    = data.options.length;
                    NewOptionsCount = data.options.length;
                } else {
                    OptionsCount    = 0;
                    NewOptionsCount = 0;
                }
                
                if(data.menus != null) {
                    // Display first menu found
                    Menus.show();
                    displayGossip("new", data, null);                    
                }       
            }

            if(data != null && data.name != null) {
                AddMenu.show();
            }
            
            if(Guid.length == 0 || data.name == null) {
                GuidName.html('Guid');
                GossipName.html('');
                $('#result').html('');
                Menus.hide();
                AddMenu.hide();
                MenusSelect.html('').hide();
            }
        }//end data
    });//end ajax
});

MenusSelect.change(function() {
    $('#result').html('');
    displayGossip("display", Data, null);
    OptionsCount = Data.menus[$(this).val()].options.length - 1;
    NewOptionsCount = Data.menus[$(this).val()].options.length - 1;
	getNewCondition = -1;
});

$('#add').click(function() {
    $('#result').html('');
    var Guid    = $('#guid').val();
    $.ajax({
    type : 'GET',
    data : 'guid=' + Guid + '&newmenu=true',
    url  : 'setNewMenu.php',
    dataType: 'json',
    success: 
        function(response) {
            console.log(response);
            
            
            if(!Data.menus) {
                var MenuCount = -1;
                var NewMenuCount = -1;
            } else {
                var NewMenuCount = Data.menus.length;
                var MenuCount = Data.menus.length;
            }

            if(!Data.menus || Data.menus > 0) {
                MenuCount = -1;
                NewMenuCount = -1;
            }

            if(MenuCount > NewMenuCount) {
                MenuCount = NewMenuCount;
            }

            for(i = MenuCount; i == NewMenuCount++; i++) {
                if (!Data.menus) {
                    Data.menus = [{}];
                    var newMenu = { id: response.new, text0: "", text1: "",};
                    Data.menus[i] = newMenu;
                } else {
                    var newMenu = { id: response.new, text0: "", text1: "", };
                    Data.menus[i] = newMenu;
                }
                Menus.show();
                MenusSelect.show();
                MenusSelect.append('<option value="' + i +'">' + response.new +'</option>').show();
                MenusSelect.val(i);
                NewMenuCount = MenuCount++;
            }
            
            displayGossip("display", Data, null);
        }
    });
});

function Option(mode, data, i) {
    if(mode === "new") {
        if (!data.options) {
            data.options = [{}];
            var i = {id: "0", icon: "0", text: "", next: ""};
            data.options[i] = i;
        } else {
            var i = {id: NewOptionsCount, icon: "0", text: "", next: ""};
            data.options[i] = i;
        }
    }
    if (mode === "display" || mode === "new") {
        GossipIcon = getIcon(data.options[i].icon);
        $('<div class="options" id="option_' + data.options[i].id + '" onclick="next(' + data.options[i].next + ')" title="Next menu: ' + data.options[i].next + '">').appendTo('.gossip_options');
		$('<img src="img/icons/' + GossipIcon + '.png" alt="" />').appendTo('#option_' + data.options[i].id);
		$(' <span>' + data.options[i].text + '</span></div>').appendTo('#option_' + data.options[i].id);
		
        $('#gossip_options tbody').append('' +
            '<tr>' + 
            '   <td>' + data.options[i].id + '</td>' +
            '   <td>' +
            '       <select class="form-control" id="icon_' + data.options[i].id + '" onchange="updateOption(' + data.id + ', ' + data.options[i].id + ', \'icon\', this.value)">' +
            '           <option value="0">Chat</option>' +
            '           <option value="1">Vendor</option>' +
            '           <option value="2">Taxi</option>' +
            '           <option value="3">Trainer</option>' +
            '           <option value="4">Interact 1</option>' +
            '           <option value="5">Interact 2</option>' +
            '           <option value="6">Banker</option>' +
            '           <option value="7">Talk</option>' +
            '           <option value="8">Tabard</option>' +
            '           <option value="9">Battle</option>' +
            '           <option value="10">Quest</option>' +
            '       </select>' +
            '   </td>' +
            '   <td><textarea class="form-control" rows="1" onchange="updateOption(' + data.id + ', ' + data.options[i].id + ', \'text\', this.value)">' + data.options[i].text + '</textarea></td>' +
            '   <td><input type="text" class="form-control" onchange="updateOption(' + data.id + ', ' + data.options[i].id + ', \'next\', this.value)" value="' + data.options[i].next + '" /></td>' +
            '   <td><span class="glyphicon glyphicon-remove" onclick="updateOption(' + data.id + ', ' + data.options[i].id + ', \'delete\', 0)"></span></td>' +
            '</tr>');

        $('#newcondition').append('<option value="' + data.options[i].id + '">Option ' + data.options[i].id + '</option>');

		$('#icon_' + data.options[i].id).val(data.options[i].icon);
        NewOptionsCount = OptionsCount++;
    }
}


function displayGossip(mode, data, menu) {
    if(mode === "new") {
        // Add the menus
        for (i = 0; i < data.menus.length ; i++) {
            MenusSelect.append('<option value="' + i +'">' + data.menus[i].id +'</option>').show();
        }
    }
    
    if(mode === "new" && data.menus.length > 1) {
        var Menu = 0 ;
        $('#menusselectdiv option[value="' + Menu + '"]').html(data.menus[Menu].id + ' (Principal)');
        MenusSelect.val(Menu);
    } else {
        var Menu = MenusSelect.val();
    }
	
	if(menu !== null) {
		var Menu = menu;
		MenusSelect.val(Menu);
	}
    
    if(mode === "new" || mode === "display") {
        // Adds the GossipUI
        $('#result').append('' +
        '<div class="col-md-4">' +
        '    <div class="gossip">' +
        '       <div class="guid_name">' + data.name + '</div>' +
        '        <div class="gossip_text"></div>' +
        '        <div class="gossip_options"></div>' +
        '    </div>' +
        '</div>' +
        '<div class="col-md-8 form-group" id="infos">' +
        '   <label>Text</label>' +
        '   <textarea class="form-control" rows="4" onchange="updateGossip(' + data.menus[Menu].id + ', this.value)" id="gossip_text"></textarea>' +
        '   <br />' +
		'</div>' +
		'<div class="col-md-12" id="conditions">' +
		'</div>');

        // Adds the gossips
        if(data.menus[Menu].text0 != null) {
            $('#gossip_text').html(data.menus[Menu].text0);
            $('.gossip_text').html(data.menus[Menu].text0);
        }
        if(data.menus[Menu].text1 != null) {
            $('#gossip_text').html(data.menus[Menu].text1);
            $('.gossip_text').html(data.menus[Menu].text1);
        }
        if(data.menus[Menu].text0 != null && data.menus[Menu].text1 != null) {
            $('#gossip_text').html(data.menus[Menu].text0);
            $('.gossip_text').html(data.menus[Menu].text0);
        }

        // Adds the OptionUI
        $('#infos').append('' +
        '<label>Options</label>' +
        '   <table class="table table-striped" id="gossip_options" style="margin-bottom: 0!important;">' +
        '       <thead>' +
        '           <tr>' +
        '               <th width="5%">ID</th>' +
        '               <th width="12%">Icon</th>' +
        '               <th width="45%">Text</th>' +
        '               <th width="13%">Follow up</th>' +
        '               <th width="5%"></th>' +
        '           </tr>' +
        '       </thead>' +
        '       <tbody>' +
        '       </tbody>' +
        '   </table>' +
        '   <br />');
        $('<button type="button" id="addoption" class="btn btn-primary col-sm-2" style="display: block">Add new option</button>').appendTo('#infos');

        // Adds the ConditionUI
        $('#conditions').append('' +
        '<label>Conditions</label>' +
        '   <table class="table table-striped" id="gossip_conditions" style="margin-bottom: 0!important;">' +
        '       <thead>' +
        '           <tr>' +
        '               <th>Element</th>' +
        '               <th>Condition</th>' +
        '               <th></th>' +
        '               <th></th>' +
        '               <th></th>' +
        '               <th>Reverse</th>' +
        '               <th></th>' +
        '           </tr>' +
        '       </thead>' +
        '       <tbody>' +
        '       </tbody>' +
        '   </table>' +
        '   <br />');
        $('<div class="col-md-2"><select class="form-control" id="newcondition"><option value="' + data.menus[Menu].id + '">Menu ' + data.menus[Menu].id + '</option></select></div>').appendTo('#conditions');
        $('<button type="button" id="addcondition" class="btn btn-primary col-sm-2" style="display: block">Add new condition</button>').appendTo('#conditions');
		
		$('#condition_' + i).change(function() {
			var NewType = $(this).val();
			$(this).closest('td').next('td').html('');
			$(this).closest('td').next('td').next('td').html('');
			$(this).closest('td').next('td').next('td').next('td').html('');
			getConditionType(data, NewType);
		});

        // Adds the options
        if(data.menus[Menu].options) {
            for (i = 0; i < data.menus[Menu].options.length ; i++) {
                Option("display", data.menus[Menu], i);
            }
        }

        // Adds the conditions
        if(data.menus[Menu].conditions) {
            for (i = 0; i < data.menus[Menu].conditions.length ; i++) {
                Condition("display", data.menus[Menu], i);
				
				if(data.menus[Menu].options[i].conditions) {
					for (x = 0; x < data.menus[Menu].options[i].conditions.length ; x++) {
						Condition("display", data.menus[Menu].options[i], x);
					}
				}
            }
        }

        $('#addoption').click(function() {
            var ActualMenu = $('#menusselect').val();
            var ID = Data.menus[ActualMenu];

            if(ID.options.length == 0 && OptionsCount == null) {
                OptionsCount = -1;
                NewOptionsCount = -1;
            }

            if(OptionsCount > NewOptionsCount) {
                OptionsCount = NewOptionsCount;
            }

            for(i = OptionsCount; i == NewOptionsCount++; i++) {
                Option("new", Data.menus[ActualMenu], OptionsCount);
            }
        });

        $('#addcondition').click(function() {
            var NewCondition = $('#newcondition').val();
			var Source;
			var NewCondMenu = data.menus[Menu].id;
			var NewCondOption = 0;
			if (NewCondition >= 100) {
				var NewCondID = 'Menu ' + NewCondition;
				Source = 14;
			} else {
				var NewCondID = 'Option ' + NewCondition;
				Source = 15;
			}
			
			$.ajax({
				type: 'GET',
				data: 'source=' + Source + '&menu=' + NewCondMenu + '&option=' + NewCondition,
				url: 'setNewCondition.php',
				dataType: 'json',
				success: 
					function(response) {
						console.log(response);
						Condition("new", response, i)
					},
				error:
					function() {
						alert('You are trying to duplicate an already existent condition.');
					}
			});
        });
        
        $('#gossip_text').keyup(function() {
            var GossipLive = $(this).val();
            $('.gossip_text').html(GossipLive);
        });

        $('table').on('click', 'span.glyphicon-remove', function(e){
			var CondID = $(this).closest('td').siblings(':first-child').text();
           	$(this).closest('tr').remove();
			$('#newcondition option[value="' + CondID + '"]').remove();
			$('#option_' + CondID).remove();
			$('#gossip_conditions td:first-child:contains("Option ' + CondID + '")').closest('tr').remove();
        });
    }
    
}

function Condition(mode, data, i) {
	debugger;
    if(mode === "new") {
        if (!data.conditions) {
            data.conditions = [{}];
            var i = {source: "0", type: "0", target: "0", reverse: "0", value1: "0", value2: "0", value3: "0"};
			
			if(data.source == 14) {
            	var i = {id: data.id, source: "14", type: "0", target: "0", reverse: "0", value1: "0", value2: "0", value3: "0"};
			}
			if(data.source == 15) {
            	var i = {id: data.id, source: "15", type: "0", target: "0", reverse: "0", value1: "0", value2: "0", value3: "0"};
			}
            data.conditions[i] = i;
        }
    }

	if (data.conditions[i].source == 14) {
		var NewCondID = 'Menu ' + data.id;
	} else if (data.conditions[i].source == 15) {
		var NewCondID = 'Option ' + i;
	}

	if (data.source == 14) {
		var NewCondID = 'Menu ' + data.menu;
	} else if (data.source == 15) {
		var NewCondID = 'Option ' + data.option;
	}
	
    if (mode === "display" || mode === "new") {
        $('#gossip_conditions tbody').append('' +
		'<tr id="' + data.conditions[i].id + '">' + 
		'   <td>' + NewCondID + '</td>' +
		'   <td>' +
		'       <select class="form-control" id="condition_' + data.conditions[i].id + '">' +
		'       	<option value="0">None</option>' +
		'       	<option value="8">Quest rewarded</option>' +
		'       	<option value="9">Quest taken</option>' +
		'       	<option value="28">Quest complete</option>' +
		'       	<option value="14">Quest none</option>' +
		'       	<option value="15">Class</option>' +
		'       	<option value="16">Race</option>' +
		'       	<option value="1">Aura</option>' +
		'       	<option value="2">Item</option>' +
		'       	<option value="3">Item equipped</option>' +
		'       	<option value="4">ZoneID</option>' +
		'       	<option value="5">Reputation rank</option>' +
		'       	<option value="6">Team</option>' +
		'       	<option value="7">Skill</option>' +
		'       	<option value="10">Drunken state</option>' +
		'       	<option value="11">World state</option>' +
		'       	<option value="12">Active event</option>' +
		'       	<option value="13">Instance info</option>' +
		'       	<option value="18">Title</option>' +
		'       	<option value="20">Gender</option>' +
		'       	<option value="22">MapID</option>' +
		'       	<option value="23">AreaID</option>' +
		'       	<option value="25">Spell</option>' +
		'       	<option value="27">Level</option>' +
		'       	<option value="29">Near creature</option>' +
		'       	<option value="30">Near gameobject</option>' +
		'       	<option value="37">HP Value</option>' +
		'			<option value="38">HP %</option>' +
		'       </select>' +
		'   </td>' +
		'	<td></td>' +
		'	<td></td>' +
		'	<td></td>' +
		'	<td>' +
		'		<select class="form-control">' +
		'       	<option value="0">No</option>' +
		'          	<option value="1">Yes</option>' + 
		'       </select>' + 
		'	</td>' +
		'	<td>' +
		'		<span class="glyphicon glyphicon-ok" onclick="saveCondition(' + data.conditions[i].id + ')"></span>' +
		'		<span class="glyphicon glyphicon-remove" onclick="deleteCondition(' + data.conditions[i].id + ')"></span>' +
		'	</td>' +
		'</tr>');
		
		var ConditionType = $('#condition_' + data.conditions[i].id);
		ConditionType.val(data.conditions[i].type);
		getConditionType(data.conditions[i], data.conditions[i].type);
		
		$('#condition_' + data.conditions[i].id).change(function() {
			var NewType = $(this).val();
			$(this).closest('td').next('td').html('');
			$(this).closest('td').next('td').next('td').html('');
			$(this).closest('td').next('td').next('td').next('td').html('');
			getConditionType(data.conditions[i], NewType);
		});
    }
}

function getIcon(data) {
    switch(data) {
        case "0": return "GossipGossipIcon"; break;
        case "1": return "VendorGossipIcon"; break;
        case "2": return "TaxiGossipIcon"; break;
        case "3": return "TrainerGossipIcon"; break;
        case "4": return "BinderGossipIcon"; break;
        case "5": return "HealerGossipIcon"; break;
        case "6": return "BankerGossipIcon"; break;
        case "7": return "PetitionGossipIcon"; break;
        case "8": return "TabardGossipIcon"; break;
        case "9": return "BattleMasterGossipIcon"; break;
        case "10": return "UI-Quest-BulletPoint"; break;
        default: return;
    }
}

function updateGossip(Menu, Value) {
    var Guid = $('#guid').val();
    $.ajax({
    type : 'GET',
    data : 'guid=' + Guid + '&menu=' + Menu + '&value=' + Value,
    url  : 'setGossip.php'
    });
}

function updateOption(Menu, id, Info, Value) {
	if(Info == "text") {
		$('#option_' + id + ' span').html(Value);
	} else if (Info == "icon") {
		var Icon = getIcon(Value);
		$('#option_' + id + ' img').attr('src', "img/icons/" + Icon + ".png");
	} else if (Info == "next") {
		$('#option_' + id).attr('title', 'Next menu:' + Value);
	}
	
    var Guid = $('#guid').val();
    $.ajax({
    type : 'GET',
    data : 'menu=' + Menu + '&id=' + id + '&info=' + Info + '&value=' + Value,
    url  : 'setOption.php'
    });
}

function next(id) {
	if(id == 0 || id == null) {
		return;
	}
	
    $('#result').html('');
	var Menu = $('#menusselect option').filter(function () { return $(this).html() == id; }).val();
    displayGossip("display", Data, Menu);
    OptionsCount = Data.menus[Menu].options.length - 1;
    NewOptionsCount = Data.menus[Menu].options.length - 1;
}

function deleteCondition(id) {
    $.ajax({
    type : 'GET',
    data : 'condition=' + id,
    url  : 'deleteCondition.php'
    });
}

function saveCondition(id) {
	var Type    = $('#' + id).find('td:nth-child(2)').find('select').val() || 0;
	var Value1  = $('#' + id).find('td:nth-child(3)').find('input').val() || 0;
	var Value2  = $('#' + id).find('td:nth-child(4)').find('input').val() || 0;
	var Value3  = $('#' + id).find('td:nth-child(5)').find('input').val() || 0;
	var Reverse = $('#' + id).find('td:nth-child(6)').find('select').val() || 0;
	
    $.ajax({
    type : 'GET',
    data : 'condition=' + id + '&type=' + Type + '&reverse=' + Reverse + '&1=' + Value1 + '&2=' + Value2 + '&3=' + Value3,
    url  : 'setCondition.php'
    });
}

function getConditionType(data, type) {
	var ConditionType = $('#condition_' + data.id);
	
	switch(type) {
		case "1": // Aura
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Spell ID" title="Spell ID" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Effect index" title="Effect index" value="' + data.value2 + '" />');
			break;

		case "2": // Item
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Item ID" title="Item ID" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Count" title="Count" value="' + data.value2 + '" />');
			ConditionType.closest('td').next('td').next('td').next('td').append('<select class="form-control" id="bank_' + data.id + '">' +
				'	<option value="0">In Bank: No</option>' +
				'	<option value="1">In Bank: Yes</option>' +
				'</select>');
			$('#bank_' + data.id).val(data.value3);
			break;

		case "3": // Item equipped
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Item ID" title="Item ID" value="' + data.value1 + '" />');
			break;

		case "4": // ZoneID
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Zone ID" title="Zone ID" value="' + data.value1 + '" />');
			break;

		case "5": // Faction ID
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Faction ID" title="Faction ID" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="rankMask" title="rankMask" value="' + data.value2 + '" />');
			break;

		case "6": // Team
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Player team" title="Player Team" value="' + data.value1 + '" />');
			break;

		case "7": // Skill
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Skill ID" title="Skill ID" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Skill value" title="Skill value" value="' + data.value2 + '" />');
			break;

		case "8": // Quest rewarded
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Quest ID" title="Quest ID" value="' + data.value1 + '" />');
			break;

		case "9": // Quest taken
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Quest ID" title="Quest ID" value="' + data.value1 + '" />');
			break;

		case "10": // Drunken state
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Drunken state" title="Drunken state" value="' + data.value1 + '" />');
			break;

		case "11": // World state
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Index" title="Index" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Value" title="Value" value="' + data.value2 + '" />');
			break;

		case "12": // Active event
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Event ID" title="Event ID" value="' + data.value1 + '" />');
			break;

		case "13": // Instance info
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Entry" title="Entry" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Data" title="Data" value="' + data.value2 + '" />');
			ConditionType.closest('td').next('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Type" title="Type" value="' + data.value3 + '" />');
			break;

		case "14": // Quest none
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Quest ID" title="Quest ID" value="' + data.value1 + '" />');
			break;

		case "15": // Class
			ConditionType.closest('td').next('td').append('<select class="form-control" id="class_' + data.id + '" onchange="updateCondition(' + data.id + ', 1, this.value)">' +
				'	<option value="1">Warrior</option>' +
				'	<option value="2">Paladin</option>' +
				'	<option value="3">Hunter</option>' +
				'	<option value="4">Rogue</option>' +
				'	<option value="5">Priest</option>' +
				'	<option value="7">Shaman</option>' +
				'	<option value="8">Mage</option>' +
				'	<option value="9">Warlock</option>' +
				'	<option value="11">Druid</option>' +
				'</select>');
			$('#class_' + data.id).val(data.value1);
			break;

		case "16": // Race
			ConditionType.closest('td').next('td').append('<select class="form-control" id="race_' + data.id + '" onchange="updateCondition(' + data.id + ', 1, this.value)">' +
				'	<option value="1">Human</option>' +
				'	<option value="2">Orc</option>' +
				'	<option value="3">Dwarf</option>' +
				'	<option value="4">NightElf</option>' +
				'	<option value="5">Undead</option>' +
				'	<option value="6">Tauren</option>' +
				'	<option value="7">Gnome</option>' +
				'	<option value="8">Troll</option>' +
				'	<option value="10">Blood Elf</option>' +
				'	<option value="11">Draenei</option>' +
				'</select>');
			$('#race_' + data.id).val(data.value1);
			break;

		case "18": // Title
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Title ID" title="Title ID" value="' + data.value1 + '" />');
			break;

		case "20": // Gender
			ConditionType.closest('td').next('td').append('<select class="form-control" id="gender_' + data.id + '" onchange="updateCondition(' + data.id + ', 1, this.value)">' +
				'	<option value="0">Male</option>' +
				'	<option value="1">Female</option>' +
				'</select>');
			$('#gender_' + data.id).val(data.value1);
			break;

		case "22": // Map ID
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Map ID" title="Map ID" value="' + data.value1 + '" />');
			break;

		case "23": // Area ID
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Area ID" title="Area ID" value="' + data.value1 + '" />');
			break;

		case "25": // Spell
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Spell ID learnt" title="Spell ID learnt" value="' + data.value1 + '" />');
			break;

		case "27": // Level
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Level" title="Level" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Comparison" title="Comparison" value="' + data.value1 + '" />');
			break;

		case "28": // Quest complete
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Quest ID" title="Quest ID" value="' + data.value1 + '" />');
			break;

		case "29": // Near creature
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Entry" title="Entry" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Range" title="Range" value="' + data.value1 + '" />');
			break;

		case "30": // Near gameobject
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Entry" title="Entry" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Range" title="Range" value="' + data.value1 + '" />');
			break;

		case "37": // HP val
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="HP val" title="HP val" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Comparison" title="Comparison" value="' + data.value1 + '" />');
			break;

		case "38": // HP %
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="HP %" title="HP %" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Comparison" title="Comparison" value="' + data.value1 + '" />');
			break;
		default: return;
	}
}