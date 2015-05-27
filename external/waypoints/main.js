"use strict";

var Entry;
var PathID;
var PointID;
var EntryName = $('#entry');
var PathIDInfos = $('#pathid');
var PathIDPauseInfos = $('#pathid_pause');
var Data;

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

$('#path_pause').keyup(function() {
    PathID = $(this).val();
    $('#pointid').val(''); 

    $.ajax({
        type: 'GET',
        data: 'pathid=' + PathID,
        url: 'getPathid.php',
        dataType: 'json',
        success: function(data) {     
                Data = data;
				PathIDPauseInfos.html("PathID");
                console.log(data);
                PathIDPauseInfos.append(' (' + data.points + ' points)');
            }
    });

    if (PathID === '') {
        PathIDPauseInfos.html("PathID");
    }
});

$('#pointid').keyup(function() {
    if(Data != null) {
        PointID = $(this).val();

        if(PointID < 1 || PointID > Data.points) {
            $('#form-point').removeClass('has-success').addClass('has-warning'); 
        } else {
            $('#form-point').removeClass('has-warning').addClass('has-success'); 
        }
    }
});

$('#delay').keyup(function() {
    var Delay = $(this).val();

    if(Delay <= 0) {
        $('#form-delay').removeClass('has-success').addClass('has-warning'); 
    } else {
        $('#form-delay').removeClass('has-warning').addClass('has-success'); 
    }
});