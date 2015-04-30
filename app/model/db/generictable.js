define(['knockout'],
    function (ko) {
        "use strict";

        /** Create a generic table object with member names from the given sql result (except the ones named only by numbers). 
        Those fields are al created as be empty observable. */
        var GenericTable = function (array) {
            var self = this;

            self.propList = [ ];
            for (var prop in array) {
                //exclude only numeric fields
                var found = prop.match("^[0-9]+$");
                if(found)
                    continue;
                if(array.hasOwnProperty(prop)){
                    self.propList.push(prop);
                    self[prop] = ko.observable();
                }
            }

            self.receiveDTO = function(dto) 
            {
                $.each(self.propList, function( index, prop ) {
                    self[prop](dto[prop]);
                });
            };

            self.createDTO = function() 
            {
                var dto = { };

                $.each(self.propList, function( index, prop ) {
                    dto[prop] = self[prop];
                    
                    //clear empty strings
                    if(dto[prop] == "")
                        dto[prop] = null;
                });

                return dto;
            };

            self.clear = function()
            {
                $.each(self.propList, function( index, prop ) {
                    self[prop](null);
                });
            };

            return self;
        }

        return GenericTable;
    }
);