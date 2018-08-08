<?php

namespace Drupal\nodejs_views\Routing;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\views\Routing\ViewPageController;

/**
 * NodejsViewsViewsController
 * 
 * Add JS to views displays.
 */
class NodejsViewsViewsController extends ViewPageController {
    
  /**
   * Handler a response for a given view and display.
   *
   * @param string $view_id
   *   The ID of the view
   * @param string $display_id
   *   The ID of the display.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route match.
   * @return null|void
   */
  public function handle($view_id, $display_id, RouteMatchInterface $route_match) {
    // Get the view render array.
    $build = parent::handle($view_id, $display_id, $route_match);

    // Add the view and display to refresh for this route.
    $build['#attached']['drupalSettings']['nodejs_views']['views'][$view_id . '.' . $display_id] = 'refresh';
    
    // Add the js to the view display.
    $build['#attached']['library'][] = 'nodejs_views/nodejs_views.view';

    return $build;
  }

}
