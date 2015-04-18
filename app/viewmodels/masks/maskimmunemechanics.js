define(['durandal/app', 'knockout', 'jquery', 'creatureDefines'], 
    function (app, ko, $, creatureDefines) {
        "use strict";

        var
        clicked = function (self, event) {
            var target = event.currentTarget;
            $(target).toggleClass("active");
            var active = $(target).hasClass("active");
            $(".list-group-item").each(function (index, element) {
                if (element == event.currentTarget) {
                    if (active == true)
                        var newVal = selection() | Math.pow(2, index);
                    else
                        newVal = selection() & ~Math.pow(2, index);

                    selection(newVal);
                }
            });
        },
        redrawList = function () {
            $(".list-group-item").each(function (index, element) {
                var active = selection() & Math.pow(2, index);
                $(element).toggleClass("active", active != 0);
            });
        },
        selection = ko.observable(0),
        selectionC = ko.computed(function () {
            redrawList();
            return selection();
        }),
        reset = function () { selection(0); }
        ;

        return {
            creatureImmuneMechanics: creatureDefines.creatureImmuneMechanics,
            selection: selection,
            selectionC: selectionC,
            redrawList: redrawList,
            clicked: clicked,
            reset: reset,
        };
});