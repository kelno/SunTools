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

    var QuestRootModule = "#Quests";
    return {
        //appTitle: "SunTools",
        modulesPathList: {

            quests: {
                index: QuestRootModule,
                php: "app/views/quests/index2.html",
            },
        },
    }
}();
