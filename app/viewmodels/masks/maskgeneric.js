define(['durandal/app', 'knockout'], 
    function (app, ko) {
        var mask = ko.observable(0);
        var bitsList = ko.observableArray();
        var computeList = ko.computed(function() {
            //clear list
            bitsList([]);
            //check for max
            if(mask() >= Math.pow(2,32)) {
                bitsList.push('Mask is too high');
                return;
            }
            //push present bits
            var i;
            for(i = 0; i < 32; i++) {
                if(mask() & Math.pow(2,i))
                    bitsList.push('0x' + Math.pow(2,i).toString(16));
            }
            return bitsList;
        });

        return {
            bitsList: bitsList,
            mask: mask,
        };
    }
);