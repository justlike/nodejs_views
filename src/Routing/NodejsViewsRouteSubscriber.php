<?php

namespace Drupal\nodejs_views\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class NodejsViewsRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {

    if ($route = $collection->get('view.view_id.view_display')) {
      $route->setDefault('_controller', '\Drupal\nodejs_views\Routing\NodejsViewsViewsController::handle');
    }

  }

}
