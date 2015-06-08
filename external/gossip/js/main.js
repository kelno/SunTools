"use strict";

var ConditionSourceType =
{
    CONDITION_SOURCE_TYPE_NONE                           : "0",
    CONDITION_SOURCE_TYPE_CREATURE_LOOT_TEMPLATE         : "1",
    CONDITION_SOURCE_TYPE_DISENCHANT_LOOT_TEMPLATE       : "2",
    CONDITION_SOURCE_TYPE_FISHING_LOOT_TEMPLATE          : "3",
    CONDITION_SOURCE_TYPE_GAMEOBJECT_LOOT_TEMPLATE       : "4",
    CONDITION_SOURCE_TYPE_ITEM_LOOT_TEMPLATE             : "5",
    CONDITION_SOURCE_TYPE_MAIL_LOOT_TEMPLATE             : "6", //Not implemented
    CONDITION_SOURCE_TYPE_MILLING_LOOT_TEMPLATE          : "7", //Not implemented
    CONDITION_SOURCE_TYPE_PICKPOCKETING_LOOT_TEMPLATE    : "8",
    CONDITION_SOURCE_TYPE_PROSPECTING_LOOT_TEMPLATE      : "9",
    CONDITION_SOURCE_TYPE_REFERENCE_LOOT_TEMPLATE        : "10", //NYI
    CONDITION_SOURCE_TYPE_SKINNING_LOOT_TEMPLATE         : "11",
    CONDITION_SOURCE_TYPE_SPELL_LOOT_TEMPLATE            : "12", //NYI
    CONDITION_SOURCE_TYPE_SPELL_IMPLICIT_TARGET          : "13", //NYI
    CONDITION_SOURCE_TYPE_GOSSIP_MENU                    : "14",
    CONDITION_SOURCE_TYPE_GOSSIP_MENU_OPTION             : "15",
    CONDITION_SOURCE_TYPE_CREATURE_TEMPLATE_VEHICLE      : "16",
    CONDITION_SOURCE_TYPE_SPELL                          : "17",
    CONDITION_SOURCE_TYPE_SPELL_CLICK_EVENT              : "18", //Not implemented
    CONDITION_SOURCE_TYPE_QUEST_ACCEPT                   : "19",
    CONDITION_SOURCE_TYPE_QUEST_SHOW_MARK                : "20",
    CONDITION_SOURCE_TYPE_VEHICLE_SPELL                  : "21", //Not implemented
    CONDITION_SOURCE_TYPE_SMART_EVENT                    : "22",
    CONDITION_SOURCE_TYPE_NPC_VENDOR                     : "23",
    CONDITION_SOURCE_TYPE_SPELL_PROC                     : "24", //Not implemented
    CONDITION_SOURCE_TYPE_PHASE_DEFINITION               : "25", // only 4.3.4
    CONDITION_SOURCE_TYPE_MAX                            : "26"  // MAX
};

var ConditionTypes =
{                                                           // value1           value2         value3
    CONDITION_NONE                  : "0",                    // 0                0              0                  always true
    CONDITION_AURA                  : "1",                    // spell_id         effindex       use target?        true if player (or target, if value3) has aura of spell_id with effect effindex
    CONDITION_ITEM                  : "2",                    // item_id          count          bank               true if has #count of item_ids (if 'bank' is set it searches in bank slots too)
    CONDITION_ITEM_EQUIPPED         : "3",                    // item_id          0              0                  true if has item_id equipped
    CONDITION_ZONEID                : "4",                    // zone_id          0              0                  true if in zone_id
    CONDITION_REPUTATION_RANK       : "5",                    // faction_id       rankMask       0                  true if has min_rank for faction_id
    CONDITION_TEAM                  : "6",                    // player_team      0,             0                  469 - Alliance, 67 - Horde)
    CONDITION_SKILL                 : "7",                    // skill_id         skill_value    0                  true if has skill_value for skill_id
    CONDITION_QUESTREWARDED         : "8",                    // quest_id         0              0                  true if quest_id was rewarded before
    CONDITION_QUESTTAKEN            : "9",                    // quest_id         0,             0                  true while quest active
    CONDITION_DRUNKENSTATE          : "10",                   // DrunkenState     0,             0                  true if player is drunk enough
    CONDITION_WORLD_STATE           : "11",  //NYI            // index            value          0                  true if world has the value for the index
    CONDITION_ACTIVE_EVENT          : "12",                   // event_id         0              0                  true if event is active
    CONDITION_INSTANCE_INFO         : "13",                   // entry            data           type               true if the instance info defined by type (enum InstanceInfo) equals data.
    CONDITION_QUEST_NONE            : "14",                   // quest_id         0              0                  true if doesn't have quest saved
    CONDITION_CLASS                 : "15",                   // class            0              0                  true if player's class is equal to class
    CONDITION_RACE                  : "16",                   // race             0              0                  true if player's race is equal to race
    CONDITION_ACHIEVEMENT           : "17",  //NI - LK        // achievement_id   0              0                  true if achievement is complete
    CONDITION_TITLE                 : "18",                   // title id         0              0                  true if player has title
    CONDITION_SPAWNMASK             : "19",                   // spawnMask        0              0                  true if in spawnMask
    CONDITION_GENDER                : "20",                   // gender           0              0                  true if player's gender is equal to gender
    CONDITION_UNIT_STATE            : "21",                   // unitState        0              0                  true if unit has unitState
    CONDITION_MAPID                 : "22",                   // map_id           0              0                  true if in map_id
    CONDITION_AREAID                : "23",                   // area_id          0              0                  true if in area_id
    CONDITION_CREATURE_TYPE         : "24",                   // cinfo.type       0              0                  true if creature_template.type : value1
    CONDITION_SPELL                 : "25",                   // spell_id         0              0                  true if player has learned spell
    CONDITION_PHASEMASK             : "26",                   // phasemask        0              0                  true if object is in phasemask
    CONDITION_LEVEL                 : "27",                   // level            ComparisonType 0                  true if unit's level is equal to param1 (param2 can modify the statement)
    CONDITION_QUEST_COMPLETE        : "28",                   // quest_id         0              0                  true if player has quest_id with all objectives complete, but not yet rewarded
    CONDITION_NEAR_CREATURE         : "29",                   // creature entry   distance       0                  true if there is a creature of entry in range
    CONDITION_NEAR_GAMEOBJECT       : "30",                   // gameobject entry distance       0                  true if there is a gameobject of entry in range
    CONDITION_OBJECT_ENTRY_GUID     : "31",                   // TypeID           entry          guid               true if object is type TypeID and the entry is 0 or matches entry of the object or matches guid of the object
    CONDITION_TYPE_MASK             : "32",                   // TypeMask         0              0                  true if object is type object's TypeMask matches provided TypeMask
    CONDITION_RELATION_TO           : "33",                   // ConditionTarget  RelationType   0                  true if object is in given relation with object specified by ConditionTarget
    CONDITION_REACTION_TO           : "34",     //NYI         // ConditionTarget  rankMask       0                  true if object's reaction matches rankMask object specified by ConditionTarget
    CONDITION_DISTANCE_TO           : "35",                   // ConditionTarget  distance       ComparisonType     true if object and ConditionTarget are within distance given by parameters
    CONDITION_ALIVE                 : "36",                   // 0                0              0                  true if unit is alive
    CONDITION_HP_VAL                : "37",                   // hpVal            ComparisonType 0                  true if unit's hp matches given value
    CONDITION_HP_PCT                : "38",                   // hpPct            ComparisonType 0                  true if unit's hp matches given pct
    CONDITION_REALM_ACHIEVEMENT     : "39",                   // achievement_id   0              0                  true if realm achievement is complete
    CONDITION_IN_WATER              : "40",                   // 0                0              0                  true if unit in water
    CONDITION_MAX                   : "41"                    // MAX
};


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
            
            if(data.name !== null) {
                console.log(data);
                GuidName.html(data.name);
                
                if(data.options) {
                    OptionsCount    = data.options.length;
                    NewOptionsCount = data.options.length;
                } else {
                    OptionsCount    = 0;
                    NewOptionsCount = 0;
                }
                
                if(data.menus !== null) {
                    // Display first menu found
                    Menus.show();
                    displayGossip("new", data, null);                    
                }       
            }

            if(data !== null && data.name !== null) {
                AddMenu.show();
            }
            
            if(Guid.length === 0 || data.name === null) {
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
    //var Guid    = $('#guid').val();
    $.ajax({
    type : 'GET',
    data : 'guid=' + Guid + '&newmenu=true',
    url  : 'setNewMenu.php',
    dataType: 'json',
    success: 
        function(response) {
            console.log(response);
            
			if (!Data.menus)
				Data.menus = [ ];

			var newMenuIndex = Data.menus.length;
			Data.menus[newMenuIndex] = { id: response.new, text0: "", text1: "", };

			Menus.show();
			MenusSelect.show();
			MenusSelect.append('<option value="' + newMenuIndex +'">' + response.new +'</option>').show();
			MenusSelect.val(newMenuIndex);
			
            displayGossip("display", Data, null);
        }
    });
});

function Option(mode, data, i) {
    if(mode === "new") {
        if (!data.options)
            data.options = [{}];
			
		data.options[i] = {id: "0", icon: "0", text: "", next: ""};
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
    
	var Menu = 0;
    if(mode === "new" && data.menus.length > 1) {
        $('#menusselectdiv option[value="' + Menu + '"]').html(data.menus[Menu].id + ' (Principal)');
        MenusSelect.val(Menu);
    } else {
        Menu = MenusSelect.val();
    }
	
	if(menu !== null) {
		Menu = menu;
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
        if(data.menus[Menu].text0 !== null) {
            $('#gossip_text').html(data.menus[Menu].text0);
            $('.gossip_text').html(data.menus[Menu].text0);
        }
        if(data.menus[Menu].text1 !== null) {
            $('#gossip_text').html(data.menus[Menu].text1);
            $('.gossip_text').html(data.menus[Menu].text1);
        }
        if(data.menus[Menu].text0 !== null && data.menus[Menu].text1 !== null) {
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
			appendConditionInputForm(data, NewType);
		});

        // Adds the conditions
        if(data.menus[Menu].conditions) {
            for (i = 0; i < data.menus[Menu].conditions.length ; i++) {
                Condition("display", data.menus[Menu], i);
            }
        }

        // Adds the options
        if(data.menus[Menu].options) {
            for (i = 0; i < data.menus[Menu].options.length ; i++) {
                Option("display", data.menus[Menu], i);
				
				// Add the options conditions
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

            if(ID.options.length === 0 && OptionsCount === null) {
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
			var NewCondID;
			if (NewCondition >= 100) {
				NewCondID = 'Menu ' + NewCondition;
				Source = ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU;
			} else {
				NewCondID = 'Option ' + NewCondition;
				Source = ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU_OPTION;
			}
			
			$.ajax({
				type: 'GET',
				data: 'source=' + Source + '&menu=' + NewCondMenu + '&option=' + NewCondition,
				url: 'setNewCondition.php',
				dataType: 'json',
				success: 
					function(response) {
						console.log(response);
						Condition("new", response, i);
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
            
			if(data.source == ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU) 
            	data.conditions[i] = {id: data.id, source: ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU, type: "0", target: "0", reverse: "0", value1: "0", value2: "0", value3: "0"};
			if(data.source == ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU_OPTION)
            	data.conditions[i] = {id: data.id, source: ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU_OPTION, type: "0", target: "0", reverse: "0", value1: "0", value2: "0", value3: "0"};
			else
				data.conditions[i] = {source: ConditionSourceType.CONDITION_SOURCE_TYPE_NONE, type: "0", target: "0", reverse: "0", value1: "0", value2: "0", value3: "0"};
        }
    }

	var NewCondID;
	if (data.conditions[i].source == ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU) {
		NewCondID = 'Menu ' + data.id;
	} else if (data.conditions[i].source == ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU_OPTION) {
		NewCondID = 'Option ' + i;
	}

	if (data.source == ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU) {
		NewCondID = 'Menu ' + data.menu;
	} else if (data.source == ConditionSourceType.CONDITION_SOURCE_TYPE_GOSSIP_MENU_OPTION) {
		NewCondID = 'Option ' + data.option;
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
		appendConditionInputForm(data.conditions[i], data.conditions[i].type);
		
		$('#condition_' + data.conditions[i].id).change(function() {
			var NewType = $(this).val();
			$(this).closest('td').next('td').html('');
			$(this).closest('td').next('td').next('td').html('');
			$(this).closest('td').next('td').next('td').next('td').html('');
			appendConditionInputForm(data.conditions[i], NewType);
		});
    }
}

function getIcon(data) {
    switch(data) {
        case "0": return "GossipGossipIcon";
        case "1": return "VendorGossipIcon";
        case "2": return "TaxiGossipIcon";
        case "3": return "TrainerGossipIcon";
        case "4": return "BinderGossipIcon";
        case "5": return "HealerGossipIcon";
        case "6": return "BankerGossipIcon";
        case "7": return "PetitionGossipIcon";
        case "8": return "TabardGossipIcon";
        case "9": return "BattleMasterGossipIcon";
        case "10": return "UI-Quest-BulletPoint";
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
	if(id === 0 || id === null) {
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
	debugger;
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

function appendConditionInputForm(data, type) {
	debugger;
	var ConditionType = $('#condition_' + data.id);
	
	switch(type) {
		case ConditionTypes.CONDITION_AURA: // Aura
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Spell ID" title="Spell ID" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Effect index" title="Effect index" value="' + data.value2 + '" />');
			break;

		case ConditionTypes.CONDITION_ITEM: // Item
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Item ID" title="Item ID" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Count" title="Count" value="' + data.value2 + '" />');
			ConditionType.closest('td').next('td').next('td').next('td').append('<select class="form-control" id="bank_' + data.id + '">' +
				'	<option value="0">In Bank: No</option>' +
				'	<option value="1">In Bank: Yes</option>' +
				'</select>');
			$('#bank_' + data.id).val(data.value3);
			break;

		case ConditionTypes.CONDITION_ITEM_EQUIPPED: // Item equipped
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Item ID" title="Item ID" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_ZONEID: // ZoneID
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Zone ID" title="Zone ID" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_REPUTATION_RANK: // Faction ID
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Faction ID" title="Faction ID" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="rankMask" title="rankMask" value="' + data.value2 + '" />');
			break;

		case ConditionTypes.CONDITION_TEAM: // Team
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Player team" title="Player Team" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_SKILL: // Skill
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Skill ID" title="Skill ID" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Skill value" title="Skill value" value="' + data.value2 + '" />');
			break;

		case ConditionTypes.CONDITION_QUESTREWARDED: // Quest rewarded
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Quest ID" title="Quest ID" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_QUESTTAKEN: // Quest taken
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Quest ID" title="Quest ID" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_DRUNKENSTATE: // Drunken state
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Drunken state" title="Drunken state" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_WORLD_STATE: // World state
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Index" title="Index" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Value" title="Value" value="' + data.value2 + '" />');
			break;

		case ConditionTypes.CONDITION_ACTIVE_EVENT: // Active event
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Event ID" title="Event ID" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_INSTANCE_INFO: // Instance info
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Entry" title="Entry" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Data" title="Data" value="' + data.value2 + '" />');
			ConditionType.closest('td').next('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Type" title="Type" value="' + data.value3 + '" />');
			break;

		case ConditionTypes.CONDITION_QUEST_NONE: // Quest none
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Quest ID" title="Quest ID" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_CLASS: // Class
			ConditionType.closest('td').next('td').append('<select class="form-control" id="class_' + data.id + '">' +
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

		case ConditionTypes.CONDITION_RACE: // Race
			ConditionType.closest('td').next('td').append('<select class="form-control" id="race_' + data.id + '">' +
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
		//case CONDITION_ACHIEVEMENT
		case ConditionTypes.CONDITION_TITLE: // Title
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Title ID" title="Title ID" value="' + data.value1 + '" />');
			break;
	    //case CONDITION_SPAWNMASK
		case ConditionType.CONDITION_GENDER: // Gender
			ConditionType.closest('td').next('td').append('<select class="form-control" id="gender_' + data.id + '" onchange="updateCondition(' + data.id + ', 1, this.value)">' +
				'	<option value="0">Male</option>' +
				'	<option value="1">Female</option>' +
				'</select>');
			$('#gender_' + data.id).val(data.value1);
			break;
		//case CONDITION_UNIT_STATE
		case ConditionTypes.CONDITION_MAPID: // Map ID
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Map ID" title="Map ID" value="' + data.value1 + '" />');
			break;
		case ConditionTypes.CONDITION_AREAID: // Area ID
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Area ID" title="Area ID" value="' + data.value1 + '" />');
			break;
		//case CONDITION_CREATURE_TYPE
		case ConditionTypes.CONDITION_SPELL: // Spell
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Spell ID learnt" title="Spell ID learnt" value="' + data.value1 + '" />');
			break;
		//case CONDITION_PHASEMASK
		case ConditionTypes.CONDITION_LEVEL: // Level
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Level" title="Level" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Comparison" title="Comparison" value="' + data.value1 + '" />');
			break;
		case ConditionTypes.CONDITION_QUEST_COMPLETE: // Quest complete
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Quest ID" title="Quest ID" value="' + data.value1 + '" />');
			break;
		case ConditionTypes.CONDITION_NEAR_CREATURE: // Near creature
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Entry" title="Entry" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Range" title="Range" value="' + data.value1 + '" />');
			break;

		case ConditionTypes.CONDITION_NEAR_GAMEOBJECT: // Near gameobject
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="Entry" title="Entry" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Range" title="Range" value="' + data.value1 + '" />');
			break;
		//case CONDITION_OBJECT_ENTRY_GUID
		//...
		//case CONDITION_ALIVE
		case ConditionTypes.CONDITION_HP_VAL: // HP val
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="HP val" title="HP val" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Comparison" title="Comparison" value="' + data.value1 + '" />');
			break;
		case ConditionTypes.CONDITION_HP_PCT: // HP %
			ConditionType.closest('td').next('td').append('<input type="text" class="form-control" placeholder="HP %" title="HP %" value="' + data.value1 + '" />');
			ConditionType.closest('td').next('td').next('td').append('<input type="text" class="form-control" placeholder="Comparison" title="Comparison" value="' + data.value1 + '" />');
			break;
		//case CONDITION_REALM_ACHIEVEMENT
		//case CONDITION_IN_WATER
		default: 
			break;
	}
}