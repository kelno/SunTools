"use strict";

var Entry = null;
var PathID = null;
var EntryName = $('#entry');
var PathIDInfos = $('#pathid');

$('#entryid').keyup(function() {
    Entry = $(this).val();

    $.ajax({
        type: 'GET',
        data: 'entry=' + Entry,
        url: 'getEntry.php',
        dataType: 'json',
        success: function(data) {
            EntryName.html("");
            console.log(data);
            EntryName.html(data.name);
            $('#form-entry').removeClass('has-warning');
            $('#errors').html('');
                
            if( data.free === false ) {
                $('#form-entry').addClass('has-warning');   
                $('#errors').append('<div class="alert alert-warning" role="alert"><strong>Warning:</strong> this entry already has waypoints, submit will override the existents points.</div>');                     
            }
        }
    });

    if (Entry === '') {
        EntryName.html("Entry");
    }
});

$('#path').keyup(function() {
    PathID = $(this).val();

    $.ajax({
        type: 'GET',
        data: 'pathid=' + PathID,
        url: 'getPathid.php',
        dataType: 'json',
        success: function(data) {                
				PathIDInfos.html("PathID");
                console.log(data);
                PathIDInfos.append(' (' + data.points + ' points)');
                }
    });

    if (PathID === '') {
        PathIDInfos.html("PathID");
    }
});