<?php
if(function_exists("register_field_group")) {
  
  register_field_group(array (
    'id' => 'acf_avaliacao',
    'title' => 'Avaliação',
    'fields' => array (
      array (
        'key' => 'field_5415972f856df',
        'label' => 'Avaliação do Produto',
        'name' => 'rating',
        'type' => 'star_rating',
        'instructions' => 'Selecione a avaliação desse produto.',
        'number' => 5,
        'default_value' => 2,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => $this->slug,
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'side',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array (
    'id' => 'acf_produtos',
    'title' => 'Produtos',
    'fields' => array (
      array (
        'key' => 'field_5415935372427',
        'label' => 'Especificações Técnicas',
        'name' => 'specs',
        'type' => 'wysiwyg',
        'instructions' => 'Use esse campo para adicionar as Especificações técnicas de cada produto.',
        'default_value' => '',
        'toolbar' => 'basic',
        'media_upload' => 'no',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => $this->slug,
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}