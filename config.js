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
                updateGossipText:     { url: serviceRootPath + "npc/updateGossipText.php", method: "POST" },
                updateMenu:           { url: serviceRootPath + "npc/updateMenu.php", method: "POST" },
                updateCreatureGossip: { url: serviceRootPath + "npc/updateCreatureGossip.php", method: "POST" },
                getGossipText:        { url: serviceRootPath + "npc/getGossipText.php", method: "GET" },
                getGossipMenu:        { url: serviceRootPath + "npc/getGossipMenu.php", method: "GET" },
                getCreatureGossip:    { url: serviceRootPath + "npc/getCreatureGossip.php", method: "GET" },
            },
        },
    }
}();
