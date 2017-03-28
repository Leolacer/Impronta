<?php

// Checamos se o modulo já existe
if (!class_exists('StartrSlider')) :

class StartrSlider {
  
  public $sliders;
  public $aditionalJS;
  public $aditionalCSS;
  
  /**
   * Inicio do Modulo
   * Use o construct para adicionar todos os hook que envolvem o modulo, e abaixo adicione os metodos,
   * preferencialmente por ordem de declaração no __construct
   * @return null
   */
  public function __construct() {
    
    // Adicionamos nossos scripts
    add_action('wp_enqueue_scripts', array($this, 'frontendScripts'));
    
    // Criamos nosso shortcode
    add_shortcode('startr_slider', array($this, 'createSlider'));
  }
  
  /**
   * Adiciona os JS e CSSs no frontend
   * @return null
   */
  public function frontendScripts() {
    global $Tema;
    
    // Adiciona os scripts
    wp_enqueue_script('startr-slider-js', $Tema->URL('modules/slider/assets/idangerous.swiper.min.js'));
    
    // Adicionamos o CSS também
    wp_enqueue_style('startr-slider-css', $Tema->URL('modules/slider/assets/idangerous.swiper.css'));
  }
  
  /**
   * Cria novos sliders usando nossa base de código
   * Para mais informações sobre o parametro $args, veja: https://codex.wordpress.org/Template_Tags/get_posts
   * @param array $args Array com argumentos sobre o slider
   * @return null
   */
  public function createSlider($args, $content = null) {
    global $Tema;
    
    // Defaults
    $a = shortcode_atts(array(
      'id'               => '',
      'posts_per_page'   => 5,
      'offset'           => 0,
      'category'         => '',
      'category_name'    => '',
      'orderby'          => 'post_date',
      'order'            => 'DESC',
      'include'          => '',
      'exclude'          => '',
      'meta_key'         => '',
      'meta_value'       => '',
      'post_type'        => 'post',
      'post_mime_type'   => '',
      'post_parent'      => '',
      'post_status'      => 'publish',
      'suppress_filters' => true 
    ), $args);
    
    // Arrumamos alguns atributos
    $a['post_type'] = explode(',', $a['post_type']);
    
    // Pegamos as postagens que queremos baseados em nossos argumentos
    $slides = get_posts($a);
    
    // Exibimos o slider, pegando o template ou outro a ser exibido
    $template = 'slider-'.$a['id'];
    
    // Expomos algumas variáveis úteis para o slider
    $sliderID = $a['id'];

    // Checamos se template existe
    if (file_exists($Tema->path("templates/sliders/$template.php"))) {
      
      // Incluimos nosso template
      include $Tema->path("templates/sliders/$template.php");
      
      // Incluimos CSS e JS que fazem tudo funcionar
      
      
    }
    
    // Template não existe, mostramos uma mensagem de instrução
    else {
      throw new ErrorException("Template não encontrado. O Seu slider não tem um template especifico, copie o arquivo slider-exemplo.php e renomeie-o para $template.php, usando ele como base.", 0);
    }
    
  }
  
}

// Rodamos o Modulo
new StartrSlider;

// Check da classe
endif;