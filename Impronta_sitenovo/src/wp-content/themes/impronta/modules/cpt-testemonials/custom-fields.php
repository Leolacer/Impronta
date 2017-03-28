<?php
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_depoimento',
    'title' => 'Depoimento',
    'fields' => array (
      array (
        'key' => 'field_5415aacda84e9',
        'label' => 'Depoimento',
        'name' => 'depoimento',
        'type' => 'wysiwyg',
        'instructions' => 'Coloque o conteúdo do depoimento em si nesse campo.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'basic',
        'media_upload' => 'no',
      ),
      array (
        'key' => 'field_5415a9a5ccd14',
        'label' => 'Autor',
        'name' => 'autor',
        'type' => 'text',
        'instructions' => 'Adicione nesse campo o nome do autor do depoimento, seguindo do cargo, se for pertinente. Ex.: José Maria, presidente da Coca-Cola Brasil.',
        'required' => 1,
        'default_value' => '',
        'placeholder' => 'Nome do autor do depoimento',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5415aa03ccd15',
        'label' => 'Link da empresa do Autor',
        'name' => 'autor_link',
        'type' => 'text',
        'instructions' => 'Opcional: coloque o link para o site da empresa do autor do depoimento, para dar credibilidade.',
        'default_value' => 'http://',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5415aa4fccd16',
        'label' => 'Foto do Autor',
        'name' => 'autor_foto',
        'type' => 'image',
        'instructions' => 'Opcional: Adicione a foto do autor, se houver.',
        'save_format' => 'object',
        'preview_size' => 'thumbnail',
        'library' => 'uploadedTo',
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
        0 => 'the_content',
        1 => 'excerpt',
        2 => 'featured_image',
      ),
    ),
    'menu_order' => 0,
  ));
}
