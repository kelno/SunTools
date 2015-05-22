var EquipID = null;
var Entry = null;
var ID = null;
var NewID = 0;

$('#itemId').keyup(function() {
    var Item = $(this).val();
    var ItemName = $('#item');
    var ItemDisplay = $('#display');
    var ItemEquipInfo = $('#equipinfo');
    var ItemEquipSlot = $('#equipslot');
    var UrlToPass = 'item=' + Item;
    $.ajax({
        type: 'GET',
        data: UrlToPass,
        url: 'query.php',
        dataType: 'json',
        success: function(data) {
            if (data != null) {
                console.log(data);
                ItemName.html(data.name);
                ItemDisplay.attr('value', data.display);
                ItemEquipInfo.attr('value', data.skill);
                ItemEquipSlot.attr('value', data.slot);
            } else {
                alert('Problem with sql query');
            }
        }
    });

    if (Item === '') {
        ItemName.html("ID");
    }
});

$('#entryId').keyup(function() {
    Entry = $(this).val();
    var EntryName = $('#entry');
    var EquipmentID = $('#equipment');
    var UrlToPass = 'entry=' + Entry;
    $('#result').html("");
    $('#new').html("");
    EntryName.html("");
    EquipmentID.attr('value', "");

    $.ajax({
        type: 'GET',
        data: UrlToPass,
        url: 'query.php',
        dataType: 'json',
        success: function(data) {
                Ajax = data;
                console.log(data);
                EntryName.html(data.name);
                EquipID = data.equipmentID;
                EquipmentID.attr('value', EquipID);
            
                if (EquipID == 0) {
                    ID = -1;
                    NewID = 0;
                    $('#new').html('<button type="button" id="add" class="btn btn-primary">New ID</button>');
                }
            
                if (EquipID !== "0" || EquipID !== null) {
                    ID = data.id.length;

                    for (i = 0; i < data.id.length; i++) {
                        ID = i;
                        $('#result').append(
                            '<div class="col-md-12"><br />' +
                            '   <div class="col-md-4">' +
                            '       <object width="100%" height="300px" type="application/x-shockwave-flash" data="http://wow.zamimg.com/modelviewer/ZAMviewerfp11.swf" id="paperdoll-model-paperdoll-0-equipment-set" style="background: #fff">' +
                            '             <param name="quality" value="high">' +
                            '             <param name="allowsscriptaccess" value="always">' +
                            '             <param name="allowfullscreen" value="true">' +
                            '             <param name="menu" value="false">' +
                            '             <param name="flashvars" value="model=orcfemale&amp;modelType=16&amp;cls=11&amp;equipList=17,' + data.id[i].mainhand.displayid + ',17,' + data.id[i].offhand.displayid + '&amp;sk=7&amp;ha=0&amp;hc=5&amp;fa=4&amp;fh=1&amp;fc=1&amp;mode=3&amp;contentPath=//wow.zamimg.com/modelviewer/&amp;container=paperdoll-model-paperdoll-0-equipment-set&amp;hd=false&amp;">' +
                            '             <param name="bgcolor" value="fff"> ' +
                            '             <param name="wmode" value="direct">' +
                            '        </object>' +
                            '   </div>' +
                            '   <div class="col-md-8">' +
                            '   <h4>ID : ' + i + '</h4>' +
                            '   <div class="col-md-4">' +
                            '       <h5>Main Hand</h5>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">DisplayID</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'mh\', \'display\', this.value)" value="' + data.id[i].mainhand.displayid + '">' +
                            '       </div>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">Skill</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'mh\', \'skill\', this.value)" value="' + data.id[i].mainhand.skill + '">' +
                            '       </div>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">Slot</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'mh\', \'slot\', this.value)" value="' + data.id[i].mainhand.slot + '">' +
                            '       </div>' +
                            '   </div>' +
                            '   <div class="col-md-4">' +
                            '       <h5>Off Hand</h5>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">DisplayID</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'oh\', \'slot\', this.value)" value="' + data.id[i].offhand.displayid + '">' +
                            '       </div>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">Skill</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'oh\', \'slot\', this.value)" value="' + data.id[i].offhand.skill + '">' +
                            '       </div>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">Slot</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'oh\', \'slot\', this.value)" value="' + data.id[i].offhand.slot + '">' +
                            '       </div>' +
                            '   </div>' +
                            '   <div class="col-md-4">' +
                            '       <h5>Ranged</h5>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">DisplayID</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'ranged\', \'slot\', this.value)" value="' + data.id[i].ranged.displayid + '">' +
                            '       </div>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">Skill</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'ranged\', \'slot\', this.value)" value="' + data.id[i].ranged.skill + '">' +
                            '       </div>' +
                            '       <div class="input-group col-md-12">' +
                            '           <span class="input-group-addon">Slot</span>' +
                            '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + ID + ', \'ranged\', \'slot\', this.value)" value="' + data.id[i].ranged.slot + '">' +
                            '       </div>' +
                            '   </div>' +
                            '   </div>' +
                            '</div>'
                        );
                    } // endfor
                    NewID = data.id.length;
                    $('#new').html('<button type="button" id="add" class="btn btn-primary">New ID</button>');
                } //end check
            } //end of function(data)
    }); //end of ajax

    if (Entry === '') {
        EntryName.html("Entry");
        EquipmentID.html("");
    }
});

$('#new').click(function() {
    console.log('add a new id: ' + NewID);
    $('#result').append(
        '<div class="col-md-12"><br />' +
        '   <div class="col-md-4">' +
        '       <object width="100%" height="300px" type="application/x-shockwave-flash" data="http://wow.zamimg.com/modelviewer/ZAMviewerfp11.swf" id="paperdoll-model-paperdoll-0-equipment-set" style="background: #fff">' +
        '             <param name="quality" value="high">' +
        '             <param name="allowsscriptaccess" value="always">' +
        '             <param name="allowfullscreen" value="true">' +
        '             <param name="menu" value="false">' +
        '             <param name="flashvars" value="model=orcfemale&amp;modelType=16&amp;cls=11&amp;equipList=17,0,17,0&amp;sk=7&amp;ha=0&amp;hc=5&amp;fa=4&amp;fh=1&amp;fc=1&amp;mode=3&amp;contentPath=//wow.zamimg.com/modelviewer/&amp;container=paperdoll-model-paperdoll-0-equipment-set&amp;hd=false&amp;">' +
        '             <param name="bgcolor" value="fff"> ' +
        '             <param name="wmode" value="direct">' +
        '        </object>' +
        '   </div>' +
        '   <div class="col-md-8">' +
        '   <h4>ID : ' + NewID + '</h4>' +
        '   <div class="col-md-4">' +
        '       <h5>Main Hand</h5>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">DisplayID</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'mh\', \'display\', this.value)" value="">' +
        '       </div>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">Skill</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'mh\', \'skill\', this.value)" value="">' +
        '       </div>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">Slot</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'mh\', \'slot\', this.value)" value="">' +
        '       </div>' +
        '   </div>' +
        '   <div class="col-md-4">' +
        '       <h5>Off Hand</h5>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">DisplayID</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'oh\', \'display\', this.value)" value="">' +
        '       </div>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">Skill</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'oh\', \'skill\', this.value)" value="">' +
        '       </div>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">Slot</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'oh\', \'slot\', this.value)" value="">' +
        '       </div>' +
        '   </div>' +
        '   <div class="col-md-4">' +
        '       <h5>Ranged</h5>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">DisplayID</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'ranged\', \'display\', this.value)" value="">' +
        '       </div>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">Skill</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'ranged\', \'skill\', this.value)" value="">' +
        '       </div>' +
        '       <div class="input-group col-md-12">' +
        '           <span class="input-group-addon">Slot</span>' +
        '           <input type="text" class="form-control" onchange="update(' + Entry + ', ' + EquipID + ', ' + NewID + ', \'ranged\', \'slot\', this.value)" value="">' +
        '       </div>' +
        '   </div>' +
        '   </div>' +
        '</div>'
    );
    NewID++;
    console.log('after add, NewID = ' + NewID);
});

function update(entry, equipmentid, id, weapon, info, value) {
    if (!(weapon == 'mh' || weapon == 'oh' || weapon == 'ranged') || !(info == 'display' || info == 'skill' || info == 'slot')) {
        return false;
    }

    $.ajax({
        type: 'GET',
        data: 'entry=' + entry + '&equipmentid=' + equipmentid + '&id=' + id + '&weapon=' + weapon + '&info=' + info + '&value=' + value,
        url: 'query.php'
    });
}