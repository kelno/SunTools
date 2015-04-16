/* URL composer : 

Usage : composeModuleURL(URLToCompose, arg1, arg2, arg3, ...)
Example : 
    urlComposer("#Loltest/:replaceme:/ho/:yay:/:review:/a", "one", 2, "three")
    will return the string "#Loltest/one/ho/2/three/a".

A 'variable' part in the url must always be prefixed with a slash and a colon (/:), end with the next colon, or when reaching the end of the string.
The colons and everything between are replaced by the argument.
This is to be used in conjunction with modulesPathList (config.js)

2015-03-03 : Class written but not properly tested yet 
*/

define([],
    function () {
        "use strict";

        var composeModuleURL = function () {
            if (arguments.length < 1) {
                console.log("composeModuleURL : No arguments given");
                return;
            }

            //get replacement slots
            var replacementSlots = [];
            var lastSlotPos = 0;
            while (true) {
                //get slot first char
                var startChar = arguments[0].indexOf("/:", lastSlotPos+1);
                if (startChar == -1)
                    break;
                startChar += 1; //ignore the slash

                //get slot last char (the index to stop at, included)
                var endChar = arguments[0].indexOf(":", startChar+1);
                if (endChar == -1)
                    endChar = arguments[0].length - 1; //select last char index

                //save position for next occurence
                lastSlotPos = endChar;

                replacementSlots.push({ "start": startChar, "end": endChar });
            }

            //check arg counts
            if (arguments.length - 1 != replacementSlots.length) {
                console.log("composeModuleURL : Error while composing url for " + arguments[0] + ", was expecting "
                    + replacementSlots.length + " data arguments but received " + arguments.length - 1);
                return;
            }

            for(var i = 1; i < arguments.length; i++) {
                if(arguments[i] == undefined) {
                    console.log("composeModuleURL: was given a undefined data argument (" + i-1 + ")");
                    return;
                }
            }

            //proceed and compose url
            var composedURL = arguments[0];
            var currentOffset = 0; //complicated way to adapt replacements index after the first one, offset to the right
            for (var i = 0; i < replacementSlots.length; i++) {
                //adapt indexes
                replacementSlots[i].start += currentOffset;
                replacementSlots[i].end += currentOffset;
                //compose next step
                composedURL = composedURL.substring(0, replacementSlots[i].start) + arguments[i + 1] + composedURL.substring(replacementSlots[i].end+1);
                currentOffset += arguments[i+1].toString().length - (replacementSlots[i].end+1 - replacementSlots[i].start);
            }
            //console.log("composeModuleURL : " + composedURL);
            return composedURL;
        }

        return composeModuleURL;
    }
);