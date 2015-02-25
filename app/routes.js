define(
[],
    function () {
        var routes = [
        {
            route: '',
            title: 'Home',
            moduleId: 'home',
            nav: true,
            iconClass: "menu-icon fa fa-home",
        }, {
            route: 'MaskHome',
            moduleId: 'masks/index',
            moduleRootId: 'masks', // Custom property to make child routes easier
            title: 'Masks',
            nav: true,
            hash: '#MaskHome',
            iconClass: "menu-icon fa fa-heart",
            childRoutes: [
                {
                    route: 'MaskGeneric',
                    moduleId: 'maskgeneric',
                    title: 'Generic',
                    nav: true,
                    hash: 'MaskGeneric',
                }, {
                    route: 'MaskImmuneMechanics',
                    moduleId: 'maskimmunemechanics',
                    title: 'Immune Mechanics',
                    nav: true,
                    hash: 'MaskImmuneMechanics',
                }, {
                    route: 'MaskExtraFlags',
                    moduleId: 'maskextraflags',
                    title: 'Extra flags',
                    nav: true,
                    hash: 'MaskExtraFlags',
                }
                ]
        }, {
            route: 'Statis',
            moduleId: 'statis',
            title: 'Stasis',
            nav: true,
            iconClass: "menu-icon fa fa-database",
        }, {
            route: 'DBCs',
            moduleId: 'dbcs/index',
            moduleRootId: 'dbcs', // Custom property to make child routes easier
            title: 'DBCs',
            nav: true,
            hash: '#DBCs',
            iconClass: "menu-icon fa fa-folder",
            childRoutes: [
                {
                    route: 'CastTimes',
                    moduleId: 'casttimes',
                    title: 'Cast Times',
                    nav: true,
                    hash: 'CastTimes',
                }, {
                    route: 'Radius',
                    moduleId: 'radius',
                    title: 'Radius',
                    nav: true,
                    hash: 'Radius',
                }, {
                    route: 'Range',
                    moduleId: 'range',
                    title: 'Range',
                    nav: true,
                    hash: 'Range',
                }
            ]
        }
        ];

        $.each(routes, function (index, route) {
            if (route.childRoutes === undefined)
                return
            $.each(route.childRoutes, function (index, childRoute) {
                childRoute.route = route.route + '/' + childRoute.route;
                childRoute.moduleId = route.moduleRootId + '/' + childRoute.moduleId;
                childRoute.title = childRoute.title;
                childRoute.hash = route.hash + '/' + childRoute.hash;
                childRoute.parent = route.moduleRootId;
            });
            routes = routes.concat(route.childRoutes);
        });

        return routes;
    }
);