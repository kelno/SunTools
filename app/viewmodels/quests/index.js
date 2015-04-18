define(['knockout', 'jquery'],
    function (ko, $) {
        
        var phpPageString = ko.observable("<b>you should not be reading this</b>");
        var activate = function(context) {
            var getURL = config.modulesPathList.quests.php
            if(context !== undefined)
                getURL += "?zone=" + context.zone;
             
            $.ajax({
              url: getURL,
              dataType: "html",
              success: function(html) {
                  phpPageString(html);
              }
            });
        }

        return {
            activate: activate,
            phpPageString: phpPageString,
        };
    }
);