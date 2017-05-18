<?php
  namespace Drupal\thirdpage\Controller;
  use Drupal\Core\Controller\ControllerBase;

  class thirdpageController extends ControllerBase {
    public function thirdPage() {
      $output = array();
      $output['#title'] = t('Access denied');
      $output['#markup'] = t('<h1>You are not authorized to access this page</h1>');
      return $output;
    }
  }
