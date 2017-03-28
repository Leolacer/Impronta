<?php
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_slides',
    'title' => 'Slides',
    'fields' => array (
      
      array (
        'key' => 'field_5415a61237bc9',
        'label' => 'Ordem',
        'name' => 'slide_ordem',
        'type' => 'number',
        'instructions' => 'Selecione em que posição esse slide deve aparecer.',
        'required' => 1,
        'default_value' => 0,
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'min' => 0,
        'max' => '',
        'step' => 1,
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
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'permalink',
        2 => 'excerpt',
        3 => 'custom_fields',
        4 => 'discussion',
        5 => 'comments',
        6 => 'revisions',
        7 => 'slug',
        8 => 'author',
        9 => 'format',
        //10 => 'featured_image',
        11 => 'categories',
        12 => 'tags',
        13 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));
}