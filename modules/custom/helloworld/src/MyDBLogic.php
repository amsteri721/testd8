<?php

namespace Drupal\helloworld;

use Drupal\Core\Database\Connection;

class MyDBLogic {
  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public function getAll() {
    return $this->getBuID();
  }

  public function getAll() {
    return $this->getBuID();
  }
}
