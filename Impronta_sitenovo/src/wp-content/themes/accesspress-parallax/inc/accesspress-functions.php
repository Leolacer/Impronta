<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package accesspress_parallax
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function accesspress_parallax_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'accesspress_parallax_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function accesspress_parallax_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'accesspress_parallax_body_classes' );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function accesspress_parallax_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'accesspress_parallax_setup_author' );

//bxSlider Callback for do action
function accesspress_parallax_bxslidercb(){
		global $post;
		$accesspress_parallax = of_get_option('parallax_section');
		if(!empty($accesspress_parallax)) :
			$accesspress_parallax_first_page_array = array_slice($accesspress_parallax, 0, 1);
			$accesspress_parallax_first_page = $accesspress_parallax_first_page_array[0]['page'];
		endif;
		$accesspress_slider_category = of_get_option('slider_category');
		$accesspress_slider_full_window = of_get_option('slider_full_window') ;
		$accesspress_show_slider = of_get_option('show_slider') ;
		$accesspress_show_pager = (!of_get_option('show_pager') || of_get_option('show_pager') == "yes") ? "true" : "false";
		$accesspress_show_controls = (!of_get_option('show_controls') || of_get_option('show_controls') == "yes") ? "true" : "false";
		$accesspress_auto_transition = (!of_get_option('auto_transition') || of_get_option('auto_transition') == "yes") ? "true" : "false";
		$accesspress_slider_transition = (!of_get_option('slider_transition')) ? "fade" : of_get_option('slider_transition');
		$accesspress_slider_speed = (!of_get_option('slider_speed')) ? "5000" : of_get_option('slider_speed');
		$accesspress_slider_pause = (!of_get_option('slider_pause')) ? "5000" : of_get_option('slider_pause');
		$accesspress_show_caption = of_get_option('show_caption') ;
		$accesspress_enable_parallax = of_get_option('enable_parallax');
		?>

		<?php if( $accesspress_show_slider == "yes" || empty($accesspress_show_slider)) : ?>
		<section id="main-slider" class="full-screen-<?php echo $accesspress_slider_full_window; ?>">
		
		<div class="overlay"></div>

		<?php if(!empty($accesspress_parallax_first_page) && $accesspress_enable_parallax == 1): ?>
		<div class="next-page"><a href="<?php echo esc_url( home_url( '/' ) ); ?>#section-<?php echo esc_attr($accesspress_parallax_first_page); ?>"></a></div>
		<?php endif; ?>

 		<script type="text/javascript">
            jQuery(function($){
				$('#main-slider .bx-slider').bxSlider({
					adaptiveHeight: true,
					pager: <?php echo $accesspress_show_pager; ?>,
					controls: <?php echo $accesspress_show_controls; ?>,
					mode: '<?php echo $accesspress_slider_transition; ?>',
					auto : <?php echo $accesspress_auto_transition; ?>,
					pause: <?php echo $accesspress_slider_pause; ?>,
					speed: <?php echo $accesspress_slider_speed; ?>
				});

				<?php if($accesspress_slider_full_window == "yes" && !empty($accesspress_slider_category)) : ?>
				$(window).resize(function(){
					var winHeight = $(window).height();
					var headerHeight = $('#masthead').outerHeight();
					$('#main-slider .bx-viewport , #main-slider .slides').height(winHeight-headerHeight);
				}).resize();
				<?php endif; ?>
				
			});
        </script>
        <?php
		if( !empty($accesspress_slider_category)) :

				$loop = new WP_Query(array(
						'cat' => $accesspress_slider_category,
						'posts_per_page' => -1
					));
					if($loop->have_posts()) : ?>

					<div class="bx-slider">
					<?php
					while($loop->have_posts()) : $loop-> the_post(); 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); 
					$image_url = "";
					if($accesspress_slider_full_window == "yes") : 
						$image_url =  "style = 'background-image:url(".esc_url($image[0]).");'";
				    endif;
					?>
					<div class="slides" <?php echo $image_url; ?>>
					
					<?php if($accesspress_slider_full_window == "no") : ?>		
						<img src="<?php echo esc_url($image[0]); ?>">
					<?php endif; ?>
								
						<?php if($accesspress_show_caption == 'yes'): ?>
						<div class="slider-caption">
							<div class="mid-content">
								<div class="caption-title"><?php the_title();?></div>
								<div class="caption-description"><?php the_content();?></div>
							</div>
						</div>
						<?php endif; ?>
				
			        </div>
					<?php endwhile; ?>
					</div>
					<?php endif; ?>
			<?php else: ?>

            <div class="bx-slider">
				<div class="slides">
					<img src="<?php echo get_template_directory_uri(); ?>/images/demo/slider1.jpg" alt="slider1">
					<div class="slider-caption">
						<div class="mid-content">
							<h1 class="caption-title"><?php _e('Welcome to AccessPress Parallax!','accesspress-parallax'); ?></h1>
							<h2 class="caption-description">
							<p><?php _e('A full featured parallax theme - and its absolutely free!','accesspress-parallax'); ?></p>
							<p><a href="#"><?php _e('Read More','accesspress-parallax'); ?></a></p>
							</h2>
						</div>
					</div>
				</div>
						
				<div class="slides">
					<img src="<?php echo get_template_directory_uri(); ?>/images/demo/slider2.jpg" alt="slider2">
					<div class="slider-caption">
						<div class="ak-container">
							<h1 class="caption-title"><?php _e('Amazing multi-purpose parallax theme','accesspress-parallax'); ?></h1>
							<h2 class="caption-description">
							<p><?php _e('Travel, corporate, small biz, portfolio, agencies, photography, health, creative - useful for anyone and everyone','accesspress-parallax'); ?></p>
							<p><a href="#"><?php _e('Read More','accesspress-parallax'); ?></a></p>
							</h2>
							</div>
					</div>
				</div>
			</div>

			<?php  endif; ?>
		</section>
		<?php endif; ?>
<?php
}

add_action('accesspress_bxslider','accesspress_parallax_bxslidercb', 10);


//add class for parallax
function accesspress_is_parallax($class){
	$is_parallax = of_get_option('enable_parallax');
	if($is_parallax=='1' || is_page_template('home-page.php')):
		$class[] = "parallax-on"; 
	endif;
	return $class;
}

add_filter('body_class','accesspress_is_parallax');


//Dynamic styles on header
function accesspress_header_styles_scripts(){
	$sections = array();
	$sections = of_get_option('parallax_section');
	$favicon = of_get_option('fav_icon');
	$custom_css = of_get_option('custom_css');
	$slider_overlay = of_get_option('slider_overlay');
	$image_url = get_template_directory_uri()."/images/";
	$dyamic_style = "";
	echo "<link type='image/png' rel='icon' href='".esc_url($favicon)."'/>\n";
	echo "<style type='text/css' media='all'>"; 

	if(!empty($sections)){
	foreach ($sections as $section) {
		$dyamic_style .= "#section-".$section['page']."{ background:url(".$section['image'].") ".$section['repeat']." ".$section['attachment']." ".$section['position']." ".$section['color']."; background-size:".$section['size']."; color:".$section['font_color']."}\n";
		$dyamic_style .= "#section-".$section['page']." .overlay { background:url(".$image_url.$section['overlay'].".png);}\n";
	}
	}

	if($slider_overlay == "yes"){
		$dyamic_style .= "#main-slider .overlay{display:none};";
	}
	echo esc_textarea($dyamic_style);
	echo esc_textarea($custom_css);

	echo "</style>\n"; 

	echo "<script>\n";
	if(of_get_option('enable_animation') == '1' && is_front_page()) : ?>
    jQuery(document).ready(function($){
       wow = new WOW(
        {
          offset:  200 
        }
      )
      wow.init();
    });
    <?php endif;
	echo "</script>\n";
}

add_action('wp_head','accesspress_header_styles_scripts');

function accesspress_footer_count(){
	$count = 0;
	if(is_active_sidebar('footer-1'))
	$count++;

	if(is_active_sidebar('footer-2'))
	$count++;

	if(is_active_sidebar('footer-3'))
	$count++;

	if(is_active_sidebar('footer-4'))
	$count++;

	return $count;
}


function accesspress_social_cb(){
	$facebooklink = of_get_option('facebook');
	$twitterlink = of_get_option('twitter');
	$google_pluslink = of_get_option('google_plus');
	$youtubelink = of_get_option('youtube');
	$pinterestlink = of_get_option('pinterest');
	$linkedinlink = of_get_option('linkedin');
	$flickrlink = of_get_option('flickr');
	$vimeolink = of_get_option('vimeo');
	$instagramlink = of_get_option('instagram');
	$skypelink = of_get_option('skype');
	?>
	<div class="social-icons">
		<?php if(!empty($facebooklink)){ ?>
		<a href="<?php echo esc_url($facebooklink); ?>" class="facebook" data-title="Facebook" target="_blank"><i class="fa fa-facebook"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($twitterlink)){ ?>
		<a href="<?php echo esc_url($twitterlink); ?>" class="twitter" data-title="Twitter" target="_blank"><i class="fa fa-twitter"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($google_pluslink)){ ?>
		<a href="<?php echo esc_url($google_pluslink); ?>" class="gplus" data-title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($youtubelink)){ ?>
		<a href="<?php echo esc_url($youtubelink); ?>" class="youtube" data-title="Youtube" target="_blank"><i class="fa fa-youtube"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($pinterestlink)){ ?>
		<a href="<?php echo esc_url($pinterestlink); ?>" class="pinterest" data-title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($linkedinlink)){ ?>
		<a href="<?php echo esc_url($linkedinlink); ?>" class="linkedin" data-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($flickrlink)){ ?>
		<a href="<?php echo esc_url($flickrlink); ?>" class="flickr" data-title="Flickr" target="_blank"><i class="fa fa-flickr"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($vimeolink)){ ?>
		<a href="<?php echo esc_url($vimeolink); ?>" class="vimeo" data-title="Vimeo" target="_blank"><i class="fa fa-vimeo-square"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($instagramlink)){ ?>
		<a href="<?php echo esc_url($instagramlink); ?>" class="instagram" data-title="instagram" target="_blank"><i class="fa fa-instagram"></i><span></span></a>
		<?php } ?>
		
		<?php if(!empty($skypelink)){ ?>
		<a href="<?php echo "skype:".esc_attr($skypelink) ?>" class="skype" data-title="Skype"><i class="fa fa-skype"></i><span></span></a>
		<?php } ?>
	</div>

	<script>
	jQuery(document).ready(function($){
		$(window).resize(function(){
			 var socialHeight = $('.social-icons').outerHeight();
			 $('.social-icons').css('margin-top',-(socialHeight/2));
		}).resize();
	});
	</script>
<?php
}
add_action('accesspress_social','accesspress_social_cb', 10);

function accesspress_remove_page_menu_div( $menu ){
    return preg_replace( array( '#^<div[^>]*>#', '#</div>$#' ), '', $menu );
}
add_filter( 'wp_page_menu', 'accesspress_remove_page_menu_div' );

function accesspress_customize_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'accesspress_customize_excerpt_more');

function accesspress_word_count($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}

function accesspress_letter_count($content, $limit) {
	$striped_content = strip_tags($content);
	$striped_content = strip_shortcodes($striped_content);
	$limit_content = mb_substr($striped_content, 0 , $limit );

	if( strlen($limit_content) < strlen($content) ){
		$limit_content .= "..."; 
	}
	return $limit_content;
}



function accesspress_register_string(){
	if(function_exists('pll_register_string')){
		$home_text = of_get_option('home_text');
		pll_register_string('Menu: Home Text', $home_text ,'Theme Option Text');
	}
}

add_action('after_setup_theme','accesspress_register_string');

add_action( 'tgmpa_register', 'accesspress_parallax_register_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function accesspress_parallax_register_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
            'name'      => __( 'AccessPress Social Icons', 'accesspress-parallax' ), //The plugin name
            'slug'      => 'accesspress-social-icons',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ),
         array(
            'name'      => __( 'AccessPress Social Counter', 'accesspress-parallax' ), //The plugin name
            'slug'      => 'accesspress-social-counter',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ),
         array(
            'name'      => __( 'AccessPress Social Share', 'accesspress-parallax' ), //The plugin name
            'slug'      => 'accesspress-social-share',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ),   
        array(
            'name'      => 'Ultimate Form Builder Lite',
            'slug'      => 'ultimate-form-builder-lite',
            'required'  => false,
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),   
        array(
            'name'      => 'AccessPress Twitter Feed',
            'slug'      => 'accesspress-twitter-feed',
            'required'  => false,
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),      
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'accesspress-parallax',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'accesspress-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}