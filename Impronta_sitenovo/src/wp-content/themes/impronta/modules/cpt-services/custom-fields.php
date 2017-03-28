<?php
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_servico',
    'title' => 'Serviço',
    'fields' => array (
      array (
        'key' => 'field_54162976e4ea1',
        'label' => 'Imagem',
        'name' => 'service_imagem',
        'type' => 'image',
        'instructions' => 'Adicione uma imagem que represente esse serviço.',
        'save_format' => 'object',
        'preview_size' => 'thumbnail',
        'library' => 'uploadedTo',
      ),
      array (
        'key' => 'field_5416299fe4ea2',
        'label' => 'Descrição do Serviço',
        'name' => 'service_text',
        'type' => 'wysiwyg',
        'instructions' => 'Adicione os detalhes desse serviço em particular.',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
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
        1 => 'featured_image',
      ),
    ),
    'menu_order' => 0,
  ));
}
