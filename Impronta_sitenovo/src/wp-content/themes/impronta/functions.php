<?php
/**
 * Esse é o arquivo principal do nosso Tema Personalizado
 *
 * Aqui carregamos uma nova instancia da nossa classe StartrCore, que cuida de todo o processo de setup do tema
 * de load de dependencias, de adiconar menus, e muito mais.
 * Essa classe também serve de base para nossos módulos, tendo funções uteis.
 * Ela pode ser acessada via a variavel global $Tema.
 *
 * Algumas funções úteis são:
 * 
 * $Tema->getAsset($file, $dir = 'img')
 * - Permite retornar a url de um asset de forma rápida. Ex.: $Tema->getAsset('logo.png');
 * - Isso Retornará a url para o logo, uma vez que a pasta padrão da função é a img, mas também poderia usar
 * - $Tema->getAsset('main.min.css', 'css'), para buscar o arquivo main.min.css na pasta css.
 *
 * $Tema->URL($file) ou $Tema->path($file)
 * - Permite retornar ou a URL ou o cainho absoluto para um determinado arquivo ou diretório.
 * - Ex.: $Tema->path('admin/config.php') retornaria o path absoluto para o arquivo config.php, na pasta admin.
 *
 * Nós também usamos o redux para nosso painel de Opções. O Redux por padrão seta uma variavel global contendo
 * as opções adiconadas pelo usuário. Essa variavel pode ser acessada usando $Options.
 *
 */

/** Carregamos a classe que serve de base para todo o tema */
require_once locate_template('/framework/startr.php');

/** Carregamos nosso Admin Panel, usando Redux */
require_once locate_template('/admin/admin.php');

/**
 * Criamos nossa classe que cuidará desse tema, extendendo nossa framework
 * Para mais detalhes sobre como cada um dos metodos funciona, veja framework/startr.php
 */
class TemaPersonalizado extends StartrCore {
  
  /**
   * Seta se estamos em modo DEV. Grunt muda pra production sozinho, no build 
   */
  public $dev = true;
  
  /**
   * Carregamos alguns arquivos importantes que o Roots coloca
   */
  public function __construct() {

    /** 
     * Importante: Rodamos o código da framework (nossa classe pai)
     * (para mais informações, veja o mesmo método em framework/startr.php)
     */
    parent::__construct();
    
    /**
     * Carregamos alguns arquivos que consideramos importante
     */
    require_once locate_template('/lib/wrapper.php'); // Theme wrapper class
    require_once locate_template('/lib/config.php'); // Configuration
    require_once locate_template('/lib/titles.php'); // Page titles
    require_once locate_template('/lib/cleanup.php'); // Cleanup
    require_once locate_template('/lib/nav.php'); // Custom nav modifications
    require_once locate_template('/lib/gallery.php'); // Custom [gallery] modifications
    require_once locate_template('/lib/comments.php'); // Custom comments modifications
    require_once locate_template('/lib/relative-urls.php'); // Root relative URLs
    require_once locate_template('/lib/scripts.php'); // Scripts and stylesheets
    require_once locate_template('/lib/custom.php'); // Custom functions
    
  }
  
  /**
   * Adicione os requires de custom fields do ACF no método abaixo 
   */
  public function addOns() {
    // Exemplo
    // require $this->path('inc/arquivo-do-custom-field.php');
  }
  
  /**
   * Use a função abaixo para adicionar novos menus ou sidebars
   */
  public function themeMenus() {
    // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
    register_nav_menus(array(
      'main_menu'   => __('Menu principal', $this->textDomain),
      'footer_menu' => __('Menu do Rodapé', $this->textDomain)
    ));
  }
  
}

/** Instanciamos nossa classe */
$Tema = new TemaPersonalizado;

/** Tornamos a variavel global para que possamos usar alguns de seus metodos e propriedades em outros locais */
global $Tema;

/** Carregamos nossos Modulos */
require_once locate_template('/framework/load-modules.php');