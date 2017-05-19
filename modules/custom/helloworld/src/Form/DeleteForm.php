<?php
/**
 * @file
 * Contains \Drupal\helloworld\Form\DeleteForm.
 */

namespace Drupal\helloworld\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;


class DeleteForm extends FormBase {
  protected $id;

  public function getFormId() {
    return 'my_database';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $id = '') {
    $this->id = $id;
    $form['delete']['#type'] = 'actions';
    $form['delete']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('delete'),
      '#button_type' => 'primary',
      '#submit' => array([$this, 'submitForm']),
    );

    $form['cancel']['#type'] = 'actions';
    $form['cancel']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('cansel'),
      '#submit' => array([$this, 'cancelForm']),
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
      $id = $this->id;
      db_delete('custom_table')
        ->condition('id', $id)
        ->execute();
      drupal_set_message(t('BD Contact submission %id has been deleted.', array('%id' => $this->id)));
      $url = Url::fromRoute('my_database.form');
      $form_state->setRedirectUrl($url);
  }

  public function cancelForm(array &$form, FormStateInterface $form_state) {
      $url = Url::fromRoute('my_database.form');
      $form_state->setRedirectUrl($url);
  }

}
