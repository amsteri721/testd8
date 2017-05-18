<?php
  namespace Drupal\firstpage\Controller;
  use Drupal\Core\Controller\ControllerBase;

  class firstpageController extends ControllerBase {
    public function firstPage() {
      $output = array();
      $output['#title'] = t('Hello');
      $output['#markup'] = t('This is my home page');
      return $output;
    }
  }
