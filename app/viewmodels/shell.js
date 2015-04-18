define(['bootstrap', 'knockout', 'ace', 'ace-elements', 'ace-extra', 'jquery', 'plugins/router', 'durandal/app', 'routes']
, function (bootstrap, ko, ace, aceelements, aceextra, $, router, app, routes) {
    "use strict";
    var parentRoute = ko.computed(function() {
        //get current module hash
        var currentRouteLastPart = null;
        if (router.activeInstruction()) {
            var fullPath = router.activeInstruction().fragment;
            currentRouteLastPart = fullPath.substr(fullPath.lastIndexOf('/') + 1);
        }
        if (currentRouteLastPart == null)
            return null;

        //find current route
        /*var currentRoute = _.find(router.routes, function (route) {
            var routeLastPart = route.route.substr(route.route.lastIndexOf('/') + 1);
            return routeLastPart == currentRouteLastPart;
        });
        if (currentRoute == undefined)
            return null;
        
        //return parent route
        return currentRoute.parentRoute;*/
        return null;
    });

    var viewTitle = ko.computed(function () {
        if (router.activeInstruction()) {
            return router.activeInstruction().config.title;
        }
        return '';
    }),
    navigateToHome = function () {
        // re-get the user's home route each time because he could have changed his role. ;-)
        /*router.navigate(routingUtils.getUserHomeRoute());
        return false;*/
        router.navigate('#');
    },
    navigateBack = function () {
        history.back();
    },
    navigateForward = function () {
        history.forward();
    },
    refreshPage = function () {
        window.location.reload();
    };

    var navigateToParent = function () {
        if(parentRoute())
            router.navigate(parentRoute().route);
        else
            console.log("navigateBackModule: No parent route found");
    };

    return {
        app: app,
        router: router,
        activate: function () {
            ace.vars['minimized'] = false; //sidebar starts expended
            return router.map(routes)
            .buildNavigationModel()
            .activate();
        },

        viewTitle: viewTitle,

        navigateToHome: navigateToHome,
        navigateBack: navigateBack,
        navigateForward: navigateForward,
        refreshPage: refreshPage,

        navigateToParent: navigateToParent,
        parentRoute: parentRoute,
    };
});