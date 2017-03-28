<?php

// Checamos se o modulo já existe
if (!class_exists('StartrSocial')) :

class StartrSocial {
  
  /**
   * Inicio do Modulo
   * Use o construct para adicionar todos os hook que envolvem o modulo, e abaixo adicione os metodos,
   * preferencialmente por ordem de declaração no __construct
   * @return null
   */
  public function __construct() {
    // Criamos nosso shortcode
    add_shortcode('startr_social', array($this, 'createSocialIcons')); 
  }
  
  /**
   * Cria novos blocos de Icones Social
   * @param array $args Array com argumentos sobre o social icon
   * @return null
   */
  public function createSocialIcons($args, $content = null) {
    global $Tema, $Options;
    
    // Defaults
    $a = shortcode_atts(array(
      'id'     => 'social',
      'social' => array('facebook', 'twitter', 'instagram', 'pinterest', 'google-plus', 'skype'),
    ), $args);

    // Ajuste das opções
    $a['social'] = explode(',', $a['social']);
    
	// Contéudo
	$content = "<div id='social-".$a['id']."' class='social-icons'>";

	// Rodamos um pequeno loop para montar os icones que retornaremos
	foreach ($a['social'] as $social) {
      if ($Options[$social] && $Options[$social] !== "") 
		$content .= "<a href='{$Options[$social]}' target='_blank'><i class='fa fa-{$social}'></i></a>";
	}

	// Fechamos div
	$content .= "</div>";

	// Retornamos Resultado
	echo $content;
    
  }
  
}

// Rodamos o Modulo
new StartrSocial;

// Check da classe
endif;