<?php

// Checamos se o modulo já existe
if (!class_exists('StartrContactInfo')) :

class StartrContactInfo {
  
  /**
   * Inicio do Modulo
   * Use o construct para adicionar todos os hook que envolvem o modulo, e abaixo adicione os metodos,
   * preferencialmente por ordem de declaração no __construct
   * @return null
   */
  public function __construct() {
    // Criamos nosso shortcode: Endereco
    add_shortcode('startr_endereco', array($this, 'createEndereco')); 
    // Shortcode Telefone
    add_shortcode('startr_tel', array($this, 'createTelephone')); 
    // Shortcode Emails
    add_shortcode('startr_email', array($this, 'createEmails')); 
  }
  
  /**
   * Cria os blocos de endereco
   * @param array $args Array com argumentos sobre o slider
   * @return null
   */
  public function createEndereco($args, $content = null) {
    global $Tema, $Options;
    
    // Defaults
    $a = shortcode_atts(array(
      'id' => 1,
    ), $args);
    
    // Pegamos que endereço mostrar
    $i = (int) $a['id'];
    
    // HTML Tags
    $htmltags = true;
    
	// Contéudo
	$content = "<address>";

	// Adicionamos as opções recentes
	$content .= $Options["street-{$i}"].", ".$Options["number-{$i}"];
	$content .= ($htmltags) ? "<br>" : " - ";
	$content .= $Options["city-{$i}"].", ".$Options["state-{$i}"];
	$content .= ($htmltags) ? "<br>" : " - ";
	$content .= $Options["cep-{$i}"];

	// Fechamos div
	$content .= "</address>";

	// Retornamos Resultado
	echo $content;
  }
  
  /**
   * Cria os blocos de telefone
   * O Parametro tels define quantos dos telefones exibir.
   * @param array $args Array com argumentos sobre o slider
   * @return null
   */
  public function createTelephone($args, $content = null) {
    global $Tema, $Options;
    
    // Defaults
    $a = shortcode_atts(array(
      'id'   => 'main',
      'qtd' => 1,
    ), $args);
    
    // Pegamos que endereço mostrar
    $qtd = (int) $a['qtd'];

	// O que cortar, para facilitar
	$cut = 'tel';
	
	// Contéudo
	$content = "<div class='contact-phones'>";

	// Cortamos a array de números e retornamos só o que nos interessa
	$selection = array_slice($Options[$cut], 0, $qtd);

	foreach ($selection as $selection) { 
		$content .= "<span class='contact-phone'>{$selection}</span>";
	}

	// Fechamos div
	$content .= "</div>";

	// Retornamos Resultado
	echo $content;
  }
  
  /**
   * Cria os blocos de emails
   * O Parametro emails define quantos dos emails exibir.
   * @param array $args Array com argumentos sobre o slider
   * @return null
   */
  public function createEmails($args, $content = null) {
    global $Tema, $Options;
    
    // Defaults
    $a = shortcode_atts(array(
      'id'   => 'main',
      'qtd' => 1,
    ), $args);
    
    // Pegamos que endereço mostrar
    $qtd = (int) $a['qtd'];

	// O que cortar, para facilitar
	$cut = 'email';
	
	// Contéudo
	$content = "<div class='contact-emails'>";

	// Cortamos a array de números e retornamos só o que nos interessa
	$selection = array_slice($Options[$cut], 0, $qtd);

	foreach ($selection as $selection) { 
		$content .= "<span class='contact-email'><a href='mailto:{$selection}'>{$selection}</a></span>";
	}

	// Fechamos div
	$content .= "</div>";

	// Retornamos Resultado
	echo $content;
  }
  
}

// Rodamos o Modulo
new StartrContactInfo;

// Check da classe
endif;