<?php
/**
 * @file
 * Contains \Drupal\helloworld\Form\EditForm.
 */

namespace Drupal\helloworld\Form;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;


class EditForm extends FormBase {

  protected $id;

  public function getFormId() {
    return 'my_database';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $id='') {
    $this->id = $id;
    $data = db_query("SELECT * FROM {custom_table} WHERE id = :id", array(':id' => $this->id))->fetchAssoc();

    $form['number'] = array(
      '#title' => $this->t('Number'),
      '#type' => 'textfield',
      '#maxlength' => 10,
      '#value' => $data['number'],
      '#description' => t('Only numbers'),
      '#required' => TRUE,
    );
    $form['teaser'] = array(
      '#title' => $this->t('Teaser'),
      '#type' => 'textfield',
      '#value' => $data['teaser'],
      '#maxlength' => 150,
      '#required' => TRUE,
    );
    $form['text'] = array(
      '#title' => $this->t('Text'),
      '#value' => $data['text'],
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

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $id = $this->id;
   $query = \Drupal::database()->update('custom_table');
    $query->fields(array(
        'number' => $form_state->getValue('number'),
        'teaser' => $form_state->getValue('teaser'),
        'text' => $form_state->getValue('text'),
      ))
    ->condition('id', $id)
    ->execute();
    $url = Url::fromRoute('my_database.form');
    $form_state->setRedirectUrl($url);
  }

}
