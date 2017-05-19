<?php
/**
 * @file
 * Contains \Drupal\helloworld\Form\MyDatabaseList.
 */

namespace Drupal\helloworld\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class MyDatabaseList extends FormBase {

  public function getFormId() {
    return 'my_database';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['data'] = array(
      '#type' => 'table',
      '#caption' => $this->t('Table Data'),
      '#header' => array($this->t('id'), $this->t('Title'), $this->t('Body')),
    );
    return $form;
  }

}
