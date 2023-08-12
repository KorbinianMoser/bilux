<?php


// html head cleanup
function cleanup() {
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
}
cleanup();


// add CSS and JS
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'bilux-css', get_template_directory_uri().'/style.css', [], filemtime(get_template_directory().'/style.css') );
    wp_enqueue_script( 'bilux-js', get_template_directory_uri().'/scripts.js', ['jquery'], filemtime(get_template_directory().'/script.js') );
    // wp_dequeue_style( 'leaflet-css' );
    // wp_dequeue_script( 'leaflet-js' );
}, 100 );


// redirect shortcode
add_action( 'template_redirect', function() {
    if( is_page() or is_single()) {
        global $post;
        if (preg_match('/\[kma_redirect([^\]]*)\]/', $post->post_content, $matches)) {
            if (count($matches)>1 && trim($matches[1])) {
                $dom = new DOMDocument();
                $dom->loadHTML('<div'.$matches[1].'>');
                $atts = [];
                foreach ($dom->getElementsByTagName('div')->item(0)->attributes as $attr) {
                    $atts[$attr->name] = $attr->value;
                }
                if (isset($atts['url'])) {
                    $url = $atts['url'];
                } elseif (isset($atts['cat_id'])) {
                    $url =  get_term_link( $atts['cat_id']);
                } elseif (isset($atts['post_id'])) {
                    $url = get_permalink( $atts['post_id']);
                } elseif (isset($atts['page_id'])) {
                    if (is_page() && in_array( trim($atts['page_id']), ['first-child',''])) {
                        $children = get_children([
                            'post_parent' => $post->ID,
                            'post_type' => 'page',
                            'post_status' => 'publish',
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'numberposts' => 1,
                        ]);
                        if( $child = array_shift($children)) {
                            $url = get_permalink($child->ID);
                        }
                    } else {
                        $url = get_permalink( $atts['page_id']);
                    }
                }
                // exit( print_r([$atts, $url], true));
                if( isset($url) && $url && !is_wp_error($url)) {
                    wp_redirect( $url );
                    exit;
                }
            }
        }
    }
});


// menus
add_action( 'init', function() {
    register_nav_menus(
        array(
            'works' => 'Arbeiten',
            'texts' => 'Textseiten',
            'footer' => 'Footer',
            'mobile' => 'Handy'
        )
    );
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



// galleries
add_filter( 'use_default_gallery_style', '__return_false' );