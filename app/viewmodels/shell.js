define(['bootstrap', 'knockout', 'ace', 'ace-elements', 'ace-extra', 'jquery', 'plugins/router', 'durandal/app', 'routes']
, function (bootstrap, ko, ace, aceelements, aceextra, $, router, app, routes) {

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
    };
});