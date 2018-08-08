<?php

namespace Drupal\nodejs_views\Controller;

use Drupal\nodejs\Nodejs;
use Drupal\Core\Controller\ControllerBase;

/**
 * NodeJS Views Controller.
 */
class NodejsViewsController extends ControllerBase {
  
  /*
   * Nodejs.
   *
   * @var \Drupal\nodejs\Nodejs
   */
  protected $nodejs;
  
  /**
   * 
   * @param Nodejs $nodejs
   */
  public function __construct(Nodejs $nodejs) {
    $this->nodejs = $nodejs;
  }

  /**
   * Sends a Nodejs notification to refresh the selected view.
   * 
   * @param string $viewDisplay
   *  The view display to refresh of the form view_id.view_display
   */
  public function refreshView($viewDisplay) {
    $this->nodejs->enqueueMessage($this->createMessage($viewDisplay));     
  }
  
  /**
   * 
   * @param string $viewDisplay
   *    The view display to refresh of the form view_id.view_display
   * @return object
   *    Message object for Nodejs.
   */
  private function createMessage($viewDisplay) {

    return (object) [
      'data' => (object) [
        'viewDisplay' => $viewDisplay
      ],
      'broadcast' => true,
      'callback' => 'nodejsView',
    ];
  }

}
