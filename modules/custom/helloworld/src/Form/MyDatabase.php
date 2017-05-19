<?php
/**
 * @file
 * Contains \Drupal\helloworld\Form\MyDatabase.
 */

namespace Drupal\helloworld\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class MyDatabase extends FormBase {

  public function getFormId() {
    return 'my_database';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $data = db_query('SELECT * FROM {custom_table}')->fetchAllAssoc('id');
    if ($data) {
      $form['data'] = array(
        '#type' => 'table',
        '#caption' => $this->t('Table Data'),
        '#header' => array($this->t('id'), $this->t('Number'), $this->t('Teaser'), $this->t('Text'), $this->t('Action')),
      );
      foreach ($data as $item) {
        $form['data'][] = array(
          'id' => array(
            '#type' => 'murkup',
            '#markup' => t($item->id),
          ),
          'number' => array(
            '#type' => 'murkup',
            '#markup' => t($item->number),
          ),
          'teaser' => array(
            '#type' => 'murkup',
            '#markup' => t($item->teaser),
          ),
          'text' => array(
            '#type' => 'murkup',
            '#markup' => t($item->text),
          ),
          'Action' => array(
            '#type' => 'murkup',
            '#markup' => t('Delete<br>Edit'),
          ),
        );
      }
    }

    $form['number'] = array(
      '#title' => $this->t('Number'),
      '#type' => 'textfield',
      '#maxlength' => 10,
      '#description' => t('Only numbers'),
      '#required' => TRUE,
    );
    $form['teaser'] = array(
      '#title' => $this->t('Teaser'),
      '#type' => 'textfield',
      '#maxlength' => 150,
      '#required' => TRUE,
    );
    $form['text'] = array(
      '#title' => $this->t('Text'),
      '#type' => 'textarea',
      '#required' => TRUE,
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Send'),
      '#button_type' => 'primary',
    );

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $number = $form_state->getValue('number');

    if (!preg_match("/^[1-9]\d*$/", $number, $match)) {
      $form_state->setErrorByName('title', $this->t('"' . $form_state->getValue('number').'" is not number'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $number = $form_state->getValue('number');
    $teaser = $form_state->getValue('teaser');
    $text = $form_state->getValue('text');
    db_insert('custom_table')->fields(array(
      'number' => $number,
      'teaser' => $teaser,
      'text' => $text,
      ))->execute();
  }

}
