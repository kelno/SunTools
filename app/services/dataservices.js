/*
 * Unique point in the application responsible for data querying.
 * 
 */
define(
    [
        'jquery',
        'toastr',
    ],
    function ($, toastr) {
        "use strict";

        /* TODO services :
        updateGossipText
        updateMenu
        updateCreatureGossip
        getGossipText
        getCreatureGossip
        */

        /* 
        obj : json object in the form of { url: "xx", method: "xxx" }   (get those from the config file)
        */
        var ajax = function(obj, args) {
            return $.ajax({
              method: obj.method,
              url: obj.url,
              data: args,
            })
            .fail(function(a, b, c) {
                toastr.error('Something went wrong !<br/>Error: ' + c);
            });
        }

        /** (optional) gossip_text = generictable model object (not observable)
        */
        var getGossipText = function(id, gossipText) {
            var args = { id: id };
            return ajax(config.servicesList.npc.getGossipText, args)
            .done(function(data, b, c) {
                if(gossipText) {
                    gossipText.receiveDTO(data);
                }
            });
        };

        var updateGossipText = function(gossip_text) {
            var dto = gossip_text.createDTO();
            return ajax(config.servicesList.npc.updateGossipText, dto)
            .done(function(data) {
                toastr.success('Text successfully updated');
            })
        }

        return {
            getGossipText:                  getGossipText,
            updateGossipText:               updateGossipText,
        };
    }
);
