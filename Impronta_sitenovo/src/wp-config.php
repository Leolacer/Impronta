<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'impronta_sitenovo_db');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');


define('WP_ALLOW_REPAIR', true);


/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+MsppmMXfL.TWq: R!n62+4(Gm/3#i6^#F]3edl87eK!yg|?-X[J2Rp6/<aW7<$g');
define('SECURE_AUTH_KEY',  'WJ>YTFP$E(_nrGHH3w%C. /CC}9?,u2j)~K?^MM@#1az`UjNz*bft20*3X,eeX+m');
define('LOGGED_IN_KEY',    'eE, V]wSS/4U%:yXdK!UC6MHl08_o1BV4m#Z)wTF )#*^qqJmRi;dD(y+oPjf=D6');
define('NONCE_KEY',        'k+Cz gh{4(ClvI|u>~_jsLrbb^=8W %lYhA X 1aq$VRntD<=nl3P;VU~vm4cMLU');
define('AUTH_SALT',        '#T:l*N=i!rykdh_}-1UP.cfByK`^)%7evF& FYxkp*CX+r_G{,IX}r3$L-kwt6IZ');
define('SECURE_AUTH_SALT', 'Q_;UUn%l.8/Vj3M$Zf;~#G`o$~,>VPLY*r9cy(WN Ig:cuZ=etr{*_XKs%)?3hz^');
define('LOGGED_IN_SALT',   'K:p6b4goZ(|.rkmnlCS4)n,nZ9tismdN0Rt.@v,3Wbm@1Qo3/#+~6jr#Hqm@h@=&');
define('NONCE_SALT',       'KxhgZ4yZ4+A1b`r?=r^3#.CKGHH`Oz=`XN^j;;>2roJEc k}N3Ap|_-!)2;$jW*z');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
