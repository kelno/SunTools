define(['bootstrap', 'knockout', 'ace', 'ace-elements', 'ace-extra', 'jquery', 'plugins/router', 'durandal/app', 'routes']
, function (bootstrap, ko, ace, aceelements, aceextra, $, router, app, routes) {

    var viewTitle = ko.computed(function () {
        if (router.activeInstruction()) {
            return router.activeInstruction().config.title;
        }
        return '';
    });

    return {
        app: app,
        router: router,
        activate: function () {
            ace.vars['minimized'] = true; //sidebar starts minimized
            return router.map(routes)
            .buildNavigationModel()
            .activate();
        },

        viewTitle: viewTitle,
    };
});