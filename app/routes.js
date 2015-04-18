define(
[],
    function () {
        var routes = [
        {
            route: '',
            title: 'Home',
            moduleId: 'home',
            nav: false,
            iconClass: "menu-icon fa fa-home",
        }, {
            route: 'MaskHome',
            moduleId: 'masks/index',
            moduleRootId: 'masks', // Custom property to make child routes easier
            title: 'Masks',
            nav: true,
            hash: '#MaskHome',
            iconClass: "menu-icon fa fa-calculator",
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
                    hash: 'CastTimes',
                    moduleId: 'casttimes',
                    title: 'Cast Times',
                    nav: true,
                }, {
                    route: 'Radius',
                    hash: 'Radius',
                    moduleId: 'radius',
                    title: 'Radius',
                    nav: true,
                }, {
                    route: 'Range',
                    hash: 'Range',
                    moduleId: 'range',
                    title: 'Range',
                    nav: true,
                }
            ]
        }, {
            route: 'Statis',
            moduleId: 'statis',
            title: 'Stasis',
            nav: true,
            iconClass: "menu-icon fa fa-database",
        }, {
            route: 'Quests',
            hash: 'external/quests/index.php',
            title: 'Quests',
            nav: true,
            iconClass: "menu-icon fa fa-exclamation",
        },
		{
            route: 'NPCModifiers',
            hash: 'external/npcmodifiers/index.php',
            title: 'NPC Modifiers',
            nav: true,
            iconClass: "menu-icon fa fa-bar-chart ",
        },
		{
            route: 'SpellInfo',
            hash: 'external/spellinfo/index.php',
            title: 'Spell Info',
            nav: true,
            iconClass: "menu-icon fa fa-cog",
        }
        ];

        //create parents route for each route
        for(var i = 0; routes[i] != undefined; i++) {
            var route = routes[i];
            route.parentRoute = null;
            if (route.childRoutes != undefined) {
                for(var j = 0; route.childRoutes[j] != undefined; j++) {

                    var childRoute = route.childRoutes[j];
                    childRoute.parentRoute = route;
                }
            }
        }

        //Last step, map child routes
        $.each(routes, function (index, route) {
            if (route.childRoutes === undefined)
                return;
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