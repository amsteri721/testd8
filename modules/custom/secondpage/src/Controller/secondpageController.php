<?php
  namespace Drupal\secondpage\Controller;
  use Drupal\Core\Controller\ControllerBase;

  class secondpageController extends ControllerBase {
    public function secondPage() {
      $output = array();
      $output['#title'] = t('404, That\'s an error');
      $output['#markup'] = t('<h1>The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found on this server.</h1>');
      return $output;
    }
  }
