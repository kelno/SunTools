define(['durandal/app', 'knockout'], 
    function (app, ko) {
        var mask = ko.observable(0);
        var bitsList = ko.observableArray();
        var computeList = ko.computed(function() {
            bitsList([]);
            var i;
            var maskInt = parseInt(mask());
            for(i = 0; i < 32; i++) {
                if(maskInt & Math.pow(2,i))
                    bitsList.push('0x' + Math.pow(2,i).toString(16));
            }
            return mask();
        });

        return {
            bitsList: bitsList,
            mask: mask,
        };
    }
);