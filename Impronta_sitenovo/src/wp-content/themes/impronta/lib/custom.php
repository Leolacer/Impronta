<?php
global $theme_options;
/**
 * Custom functions
 */

// GA Hook
add_action('wp_footer', 'statrAnalytics');

// Google Analytics Code
function statrAnalytics() {
	global $theme_options;
	echo $theme_options['google-analytics'];
}

function makePagination($wp_query) {

    $big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5,
        'prev_text'    => __('« Anterior'),
		'next_text'    => __('Próximo »'),
    ) );

    // Display the pagination if more than one page is found
    if ($paginate_links) {
        echo '<nav class="post-nav">';
        echo $paginate_links;
        echo '</nav>';
    }
}