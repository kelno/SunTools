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
            route: 'Quests Tests',
            hash: 'external/quests/',
            title: 'Quests Tests',
            nav: true,
            iconClass: "menu-icon fa fa-exclamation",
            external: true,
        }, {
            route: 'ClassTests',
            hash: 'external/classes/',
            title: 'Class Tests',
            nav: true,
            iconClass: "menu-icon fa fa-cog",
            external: true,
        }, {
            route: 'Equipment',
            hash: 'external/equip/',
            title: 'Equipments',
            nav: true,
            iconClass: "menu-icon fa fa-cutlery",
            external: true,
        }, {
            route: 'Mask',
            moduleId: 'masks/index',
            moduleRootId: 'masks', // Custom property to make child routes easier
            title: 'Masks',
            nav: true,
            hash: '#Mask',
            iconClass: "menu-icon fa fa-calculator",
            childRoutes: [
                {
                    route: 'Generic',
                    moduleId: 'maskgeneric',
                    title: 'Generic',
                    nav: true,
                    hash: 'Generic',
                }, {
                    route: 'ImmuneMechanics',
                    moduleId: 'maskimmunemechanics',
                    title: 'Immune Mechanics',
                    nav: true,
                    hash: 'ImmuneMechanics',
                }, {
                    route: 'ExtraFlags',
                    moduleId: 'maskextraflags',
                    title: 'Extra flags',
                    nav: true,
                    hash: 'ExtraFlags',
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
            route: 'NPC',
            moduleId: 'npc/index',
            moduleRootId: 'npc', // Custom property to make child routes easier
            title: 'NPC',
            nav: true,
            hash: '#NPC',
            iconClass: "menu-icon fa fa-cog",
            childRoutes: [
                {
                    route: 'SmartAI Text',
                    hash: 'external/creature_text/',
                    title: 'SmartAI Text',
                    nav: true,
                    external: true,
                }, {
                    route: 'NPCModifiers',
                    hash: 'external/npcmodifiers/',
                    title: 'NPC Modifiers',
                    nav: true,
                    iconClass: "menu-icon fa fa-bar-chart ",
                    external: true,
                } , {
                    route: 'GossipMenu',
                    hash: 'external/gossip/',
                    title: 'Gossip Menu',
                    nav: true,
                    external: true,
                    iconClass: "menu-icon fa fa-cog",
                } ,
            ]
        },
		{
            route: 'IG Commands',
            hash: 'external/commands/',
            title: 'IG Commands',
            nav: true,
            iconClass: "menu-icon fa fa-pencil",
            external: true,
        },
		{
            route: 'Spell Info',
            hash: 'external/spellinfo/',
            title: 'Spell Info',
            nav: true,
            iconClass: "menu-icon fa fa-info-circle",
            external: true,
        },
        {
            route: 'Old',
            moduleId: 'old/index',
            moduleRootId: 'old', // Custom property to make child routes easier
            title: 'Old garbage',
            nav: true,
            hash: '#OLD',
            iconClass: "menu-icon fa fa-trash",
            childRoutes: [
		    {
                route: 'Fireworks Editor',
                hash: 'external/fireworks/',
                title: 'Fireworks Editor',
                nav: true,
                iconClass: "menu-icon fa fa-dot-circle-o",
                external: true,
            },
		    {
                route: 'Quest Generator',
                hash: 'external/questgenerator/',
                title: 'Quest Generator',
                nav: true,
                iconClass: "menu-icon fa fa-exclamation-circle",
                external: true,
            },
	    	{
                route: 'Make Heroic',
                hash: 'external/makeheroic/',
                title: 'Make Heroic',
                nav: true,
                iconClass: "menu-icon fa fa-angle-double-up",
                external: true,
            }
            ],
        },
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
                if(!childRoute.external)
                    childRoute.hash = route.hash + '/' + childRoute.hash;
                childRoute.parent = route.moduleRootId;
            });
            routes = routes.concat(route.childRoutes);
        });

        return routes;
    }
);
