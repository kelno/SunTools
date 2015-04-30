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

        /** (optional) gossip_text = generictable model object (not observable)
        */
        var getGossipText = function(id, gossipText) {
            return $.ajax({
              method: "GET",
              url: config.servicesList.npc.getGossipText,
              data: { id: id }
            })
            .done(function(data, b, c) {
                if(gossipText) {
                    gossipText.receiveDTO(data);
                }
            })
            .fail(function(a, b, c) {
                toastr.error('Something went wrong !<br/>Error: ' + c);
            });
        };

        var updateGossipText = function(gossip_text) {
            var dto = gossip_text.createDTO();
            return $.ajax({
              method: "POST",
              url: config.servicesList.npc.updateGossipText,
              data: dto
            })
            .done(function(data) {
                toastr.success('Text successfully updated');
            })
            .fail(function(a, b, c) {
                toastr.error('Something went wrong !<br/>Error: ' + c);
            });
        }

        return {
            getGossipText:                  getGossipText,
            updateGossipText:               updateGossipText,
        };
    }
);
