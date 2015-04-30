/*
 * This file exposes the application global configuration.
 * Use and extend it for any property that can be shared in your
 * application or that needs to be controlled from this centralized
 * point without changing specific modules.
 * 
 * Examples of settings: data service url, application name, default module...
 * 
 */
var config = function () {
    "use strict";
    var QuestRootModule = "#Quests";
    var serviceRootPath = "app/services/";
    return {
        //appTitle: "SunTools",
        modulesPathList: {

            quests: {
                index: QuestRootModule,
                php: "app/views/quests/index2.html",
            },
        },
        servicesList: {
            npc: {
                updateGossipText:     serviceRootPath + "npc/updateGossipText.php",
                updateMenu:           serviceRootPath + "npc/updateMenu.php",
                updateCreatureGossip: serviceRootPath + "npc/updateCreatureGossip.php",
                getGossipText:        serviceRootPath + "npc/getGossipText.php",
                getGossipMenu:        serviceRootPath + "npc/getGossipMenu.php",
                getCreatureGossip:    serviceRootPath + "npc/getCreatureGossip.php",
            },
        },
    }
}();
