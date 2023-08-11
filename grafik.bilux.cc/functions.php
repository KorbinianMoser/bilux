<?php



// remove_action( 'wp_head', '_wp_render_title_tag', 1);
// remove_action( 'wp_head', 'wp_enqueue_scripts', 1);
// remove_action( 'wp_head', 'noindex', 1);
remove_action( 'wp_head', 'wp_post_preview_js', 1 );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
// remove_action( 'wp_head', 'wp_print_styles', 8);
// remove_action( 'wp_head', 'wp_print_head_scripts', 9);
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'rsd_link', 10 );
remove_action( 'wp_head', 'wlwmanifest_link', 10 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
remove_action( 'wp_head', 'locale_stylesheet', 10 );
remove_action( 'wp_head', 'wp_generator', 10 );
remove_action( 'wp_head', 'rel_canonical', 10 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', '_custom_logo_header_styles', 10 ); 
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_oembed_add_host_js', 10 );
remove_action( 'wp_head', 'wp_site_icon', 99 );
remove_action( 'wp_head', 'wp_custom_css_cb', 101 );

show_admin_bar( false );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_filter( 'option_use_smilies', '__return_false' );

add_action( 'wp_enqueue_scripts', function () {
	wp_dequeue_style( 'dashicons' );
	wp_dequeue_style( 'admin-bar' );
} );



// https
add_filter( 'the_content', function($cnt) {
	return str_replace([
		'http://bilux.cc',
		'http://grafik.bilux.cc',
	], [
		'https://bilux.cc',
		'https://bilux.cc/grafik',
	], $cnt);
});