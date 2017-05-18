<?php
namespace Drupal\helloworld\Controller;

class helloworldController  {
  public function content(){
    $add_link = '<p>' . l(t('New message'), 'admin/content/bd_contact/add') . '</p>';

    // Table header
    $header = array(
      'id' => t('Id'),
      'number' => t('Number'),
      'teaser' => t('Teaser'),
      'text' => t('Text'),
      'Action' => t('Delete'),
    );

    $rows = array();

    $res = db_query('SELECT * FROM {custom_table}')->fetchAllAssoc('id');

    foreach($res as $id=>$content) {
      // Row with attributes on the row and some of its cells.
      $rows[] = array(
        'data' => array($id, $content->number, $content->teaser, $content->text, l('Delete', "sdas"))
      );
    }

    $table = array(
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    );

    return $add_link;
  }
}
