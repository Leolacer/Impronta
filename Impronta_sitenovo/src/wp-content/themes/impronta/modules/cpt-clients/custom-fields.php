<?php
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_cliente',
    'title' => 'Cliente',
    'fields' => array (
      array (
        'key' => 'field_5415ac7f81b30',
        'label' => 'Logotipo da Empresa do Cliente',
        'name' => 'client_logo',
        'type' => 'image',
        'instructions' => 'Essa imagem será mostrada na página de clientes.',
        'required' => 1,
        'save_format' => 'object',
        'preview_size' => 'thumbnail',
        'library' => 'uploadedTo',
      ),
      array (
        'key' => 'field_5415acae81b31',
        'label' => 'Link do Site do Cliente',
        'name' => 'client_link',
        'type' => 'text',
        'instructions' => 'Opcional: Se colocado, o logotipo selecionado acima terá um link para que seus visitantes possam acessar a página do cliente em questão, em outra aba.',
        'default_value' => 'http://',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5415acf981b32',
        'label' => 'Adicionar Texto?',
        'name' => 'client_switch',
        'type' => 'true_false',
        'instructions' => 'Você deseja adicionar algum texto para ser mostrado junto com esse cliente?',
        'required' => 1,
        'message' => '',
        'default_value' => 0,
      ),
      array (
        'key' => 'field_5415ad2b81b33',
        'label' => 'Texto',
        'name' => 'client_text',
        'type' => 'wysiwyg',
        'instructions' => 'Adicione um texto para ser usado na exibição desse cliente.',
        'conditional_logic' => array (
          'status' => 1,
          'rules' => array (
            array (
              'field' => 'field_5415acf981b32',
              'operator' => '==',
              'value' => '1',
            ),
          ),
          'allorany' => 'all',
        ),
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
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
        1 => 'featured_image',
      ),
    ),
    'menu_order' => 0,
  ));
}
