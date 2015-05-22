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
	
    var serviceRootPath = "app/services/";
	
    return {
        appTitle: "Sunstrider Tools",
		
        modulesPathList: {

        },
        servicesList: {
          
        },
    }
}();
