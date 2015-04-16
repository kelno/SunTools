requirejs.config({
    paths: {
    'ace' : '../ace/js/ace',
    'ace-elements': '../ace/js/ace-elements',
    'ace-extra': '../ace/js/ace-extra',
    'bootstrap': '../ace/js/bootstrap',
    'creatureDefines': '../js/creatureDefines',
    'durandal':'../lib/durandal/js',
    'knockout': '../lib/knockout/knockout-3.1.0',
    'plugins' : '../lib/durandal/js/plugins',
    'transitions' : '../lib/durandal/js/transitions',
    'jquery': '../lib/jquery/jquery-1.9.1',
    'text': '../lib/require/text',
  },
  shim: {
      'ace': {
          deps: ['jquery', 'bootstrap'],
          exports: 'ace'
      },
      'ace-elements': {
          deps: ['ace']
      },
      'ace-extras': {
          deps: ['ace']
      },
      'bootstrap': {
          deps: ['jquery'],
      },
      'jquery': {
        exports: 'jQuery'
      }
  }
});

define(['durandal/system', 'durandal/app', 'durandal/viewLocator', 'plugins/router', 'ace', 'jquery']
   , function (system, app, viewLocator, router, ace, $) {
       'use strict';

       system.debug(true);

       app.title = "HoheTest";
       app.icon = "fa fa-institution";
 
       app.configurePlugins({
           router: true,
           dialog: true,
           widget: true
       });

       app.start().then(function () {
           //Replace 'viewmodels' in the moduleId with 'views' to locate the view.
           //Look for partial views in a 'views' folder in the root.
           viewLocator.useConvention();
           router.makeRelative({
               moduleId: 'viewmodels'
           });

           //Show the app by setting the root view model for our application with a transition.
           
           app.setRoot('viewmodels/shell', 'entrance');
       })

   }
);