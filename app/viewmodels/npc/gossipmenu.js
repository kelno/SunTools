define(['durandal/app', 'knockout', 'services/dataservices', 'model/db/generictable'], 
    function (app, ko, dataservices, generictable) {

        "use strict";

        var inputID = ko.observable(0);
        var gossipText = ko.observable();

        var activate = function() {
            //prepare table objects with dummy queries
            return dataservices.getGossipText(1) //this id must always exists for the page to work
            .then(function(data) {
                gossipText(new generictable(data));
                gossipText().ID(0);
            }); 
        };

        var autoGetGossipText = ko.computed(function() {
            var id = inputID();
            if(id == 0)
            {
                if(gossipText())
                    gossipText().clear();
                return;
            }

            dataservices.getGossipText(id, gossipText())
            .fail(function(a,b,c,d,e) {
                debugger;
            });
        });

        var sendGossipText = function() {
            if(gossipText().ID() == 0)
                return;

            dataservices.updateGossipText(gossipText());
        };

        return {
            activate: activate,

            inputID: inputID,
            gossipText: gossipText,
            sendGossipText: sendGossipText,
        };
    }
);