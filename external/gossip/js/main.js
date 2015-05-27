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
var i;
var Data;
var GossipIcon;
var OptionsCount;
var NewOptionsCount;

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
                    displayGossip("new", data);                    
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
    debugger;
    $('#result').html('');
    displayGossip("display", Data);
    OptionsCount = Data.menus[$(this).val()].options.length - 1;
    NewOptionsCount = Data.menus[$(this).val()].options.length - 1;
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
            
            displayGossip("display", Data);
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
        $('.gossip_options').append('<div class="options" title="Next menu: ' + data.options[i].next + '"><img src="img/icons/' + GossipIcon + '.png" alt="" /> ' + data.options[i].text + '</div>');
        $('#gossip_options tbody').append('' +
            '<tr>' + 
            '   <td>' + data.options[i].id + '</td>' +
            '   <td>' +
            '       <select class="form-control" onchange="updateOption(' + data.id + ', ' + data.options[i].id + ', \'icon\', this.value)">' +
            '           <option value="0" data-class="icon0">Chat</option>' +
            '           <option value="1" data-class="icon1">Vendor</option>' +
            '           <option value="2" data-class="icon2">Taxi</option>' +
            '           <option value="3" data-class="icon3">Trainer</option>' +
            '           <option value="4" data-class="icon4">Interact 1</option>' +
            '           <option value="5" data-class="icon5">Interact 2</option>' +
            '           <option value="6" data-class="icon6">Banker</option>' +
            '           <option value="7" data-class="icon7">Talk</option>' +
            '           <option value="8" data-class="icon8">Tabard</option>' +
            '           <option value="9" data-class="icon9">Battle</option>' +
            '           <option value="10" data-class="icon10">Quest</option>' +
            '       </select>' +
            '   </td>' +
            '   <td><textarea class="form-control" rows="1" onchange="updateOption(' + data.id + ', ' + data.options[i].id + ', \'text\', this.value)">' + data.options[i].text + '</textarea></td>' +
            '   <td><input type="text" class="form-control" onchange="updateOption(' + data.id + ', ' + data.options[i].id + ', \'next\', this.value)" value="' + data.options[i].next + '" /></td>' +
            '   <td><span class="glyphicon glyphicon-remove" onclick="updateOption(' + data.id + ', ' + data.options[i].id + ', \'delete\', 0)"></span></td>' +
            '</tr>');
        NewOptionsCount = OptionsCount++;
    }
}

function displayGossip(mode, data) {
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
        '   <br />');

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

        // Adds the options
        if(data.menus[Menu].options) {
            for (i = 0; i < data.menus[Menu].options.length ; i++) {
                Option("display", data.menus[Menu], i);
            }
        }

        $('#addoption').click(function() {
            debugger;
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
        
        $('#gossip_text').keyup(function() {
            var GossipLive = $(this).val();
            $('.gossip_text').html(GossipLive);
        });


        $('table').on('click', 'span', function(e){
           $(this).closest('tr').remove();
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
    var Guid = $('#guid').val();
    $.ajax({
    type : 'GET',
    data : 'menu=' + Menu + '&id=' + id + '&info=' + Info + '&value=' + Value,
    url  : 'setOption.php'
    });
}