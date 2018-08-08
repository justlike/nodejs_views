/**
 * @file
 *   Javascript for Nodejs Views
 */

(function ($, Drupal) {
  Drupal.behaviors.nodejsViews = {
    attach: function (context, settings) {
      
      var viewsList = settings.nodejs_views.views;
      var ajaxViews = settings.views.ajaxViews;
      var domIds = [];

      // Look through all the ajax views
      for (var viewName in ajaxViews) {

        var currentView = ajaxViews[viewName].view_name + '.' + ajaxViews[viewName].view_display_id;

        // Check if it's in our views list to refresh.        
        if (viewsList[currentView]) {
          
          var view_selector = '.js-view-dom-id-' + ajaxViews[viewName].view_dom_id;
          domIds.push(view_selector);

        } 

      } // ajaxViews loop      

      Drupal.Nodejs.callbacks.nodejsView = {
        callback: function (message) {
          
          // Check notification for relevant callback and view to refresh.
          if (message.callback == 'nodejsView' && viewsList[message.data.viewDisplay]) {
            
            for (var index in domIds) {                          
              $(domIds[index]).once().triggerHandler('RefreshView');            
            }
          }
          
        }
      };

    }
  };

})(jQuery, Drupal);
