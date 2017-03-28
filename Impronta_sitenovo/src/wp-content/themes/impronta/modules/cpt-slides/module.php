<?php

// Checamos se o modulo já existe
if (!class_exists('StartrSlidesCPT')) :

class StartrSlidesCPT {
  
  /**
   * @property string $slug 
   */
  public $slug = 'slide';
  
  /**
   * Inicio do Modulo
   * Use o construct para adicionar todos os hook que envolvem o modulo, e abaixo adicione os metodos,
   * preferencialmente por ordem de declaração no __construct
   * @return null
   */
  public function __construct() {
    global $Tema;
    
    // Registramos o nosso custom post type
    // Veja os icones disponíveis em: http://melchoyce.github.io/dashicons/
    $Tema->addPostType("Slides", "Slide", $this->slug, 'dashicons-format-gallery');
    
    // Registramos Taxonomia Fabricante para esse custom post type
    $Tema->addTaxonomy('Slider', array($this->slug), 'slider', false);

    // Adicionamos todos os custom fields exportados de produtos
    add_action("init", array($this, 'customFields'), 11);
    
  }
  
  /**
   * Carrega os custom fields, criados usando o ACF
   * @return null
   */
  public function customFields() {
    // Para manter o código organizado, separaremos em um arquivo a parte
    require_once "custom-fields.php";
  }
  
}

// Rodamos o Modulo
new StartrSlidesCPT;

// Check da classe
endif;