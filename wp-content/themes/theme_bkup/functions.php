<?php

/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if (!isset($content_width)) {
    $content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.1-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('twentyfifteen_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Twenty Fifteen 1.0
     */
    function twentyfifteen_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on twentyfifteen, use a find and replace
         * to change 'twentyfifteen' to the name of your theme in all the template files
         */
        load_theme_textdomain('twentyfifteen', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(825, 510, true);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'twentyfifteen'),
            'social' => __('Social Links Menu', 'twentyfifteen'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ));

        $color_scheme = twentyfifteen_get_color_scheme();
        $default_color = trim($color_scheme[0], '#');

        // Setup the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('twentyfifteen_custom_background_args', array(
            'default-color' => $default_color,
            'default-attachment' => 'fixed',
        )));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url()));
    }

endif; // twentyfifteen_setup
add_action('after_setup_theme', 'twentyfifteen_setup');

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
//function twentyfifteen_widgets_init() {
//	register_sidebar( array(
//		'name'          => __( 'Widget Area', 'twentyfifteen' ),
//		'id'            => 'sidebar-1',
//		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
//		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//		'after_widget'  => '</aside>',
//		'before_title'  => '<h2 class="widget-title">',
//		'after_title'   => '</h2>',
//	) );
//}

register_sidebar(array(
    'name' => 'Sidebar',
    'id' => 'sidebar-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div> <!-- end .widget -->',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
));

register_sidebar(array(
    'name' => 'Post Footer',
    'id' => 'postfooter',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div> <!-- end .widget -->',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
));


add_action('widgets_init', 'twentyfifteen_widgets_init');

if (!function_exists('twentyfifteen_fonts_url')) :

    /**
     * Register Google fonts for Twenty Fifteen.
     *
     * @since Twenty Fifteen 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function twentyfifteen_fonts_url() {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /*
         * Translators: If there are characters in your language that are not supported
         * by Noto Sans, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Noto Sans font: on or off', 'twentyfifteen')) {
            $fonts[] = 'Noto Sans:400italic,700italic,400,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Noto Serif, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Noto Serif font: on or off', 'twentyfifteen')) {
            $fonts[] = 'Noto Serif:400italic,700italic,400,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Inconsolata, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Inconsolata font: on or off', 'twentyfifteen')) {
            $fonts[] = 'Inconsolata:400,700';
        }

        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen');

        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
            $subsets .= ',greek,greek-ext';
        } elseif ('devanagari' == $subset) {
            $subsets .= ',devanagari';
        } elseif ('vietnamese' == $subset) {
            $subsets .= ',vietnamese';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                    ), 'https://fonts.googleapis.com/css');
        }

        return $fonts_url;
    }

endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'twentyfifteen_javascript_detection', 0);

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null);

    // Add Genericons, used in the main stylesheet.
    wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2');

    // Load our main stylesheet.
    wp_enqueue_style('twentyfifteen-style', get_stylesheet_uri());

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style('twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array('twentyfifteen-style'), '20141010');
    wp_style_add_data('twentyfifteen-ie', 'conditional', 'lt IE 9');

    // Load the Internet Explorer 7 specific stylesheet.
    wp_enqueue_style('twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array('twentyfifteen-style'), '20141010');
    wp_style_add_data('twentyfifteen-ie7', 'conditional', 'lt IE 8');

    wp_enqueue_script('twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script('twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20141010');
    }

    wp_enqueue_script('twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20150330', true);
    wp_localize_script('twentyfifteen-script', 'screenReaderText', array(
        'expand' => '<span class="screen-reader-text">' . __('expand child menu', 'twentyfifteen') . '</span>',
        'collapse' => '<span class="screen-reader-text">' . __('collapse child menu', 'twentyfifteen') . '</span>',
    ));
}

add_action('wp_enqueue_scripts', 'twentyfifteen_scripts');

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
    if (!is_single()) {
        return;
    }

    $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);
    $css = '';

    if (is_attachment() && 'attachment' == $previous->post_type) {
        return;
    }

    if ($previous && has_post_thumbnail($previous->ID)) {
        $prevthumb = wp_get_attachment_image_src(get_post_thumbnail_id($previous->ID), 'post-thumbnail');
        $css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url($prevthumb[0]) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
    }

    if ($next && has_post_thumbnail($next->ID)) {
        $nextthumb = wp_get_attachment_image_src(get_post_thumbnail_id($next->ID), 'post-thumbnail');
        $css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url($nextthumb[0]) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
    }

    wp_add_inline_style('twentyfifteen-style', $css);
}

add_action('wp_enqueue_scripts', 'twentyfifteen_post_nav_background');

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description($item_output, $item, $depth, $args) {
    if ('primary' == $args->theme_location && $item->description) {
        $item_output = str_replace($args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output);
    }

    return $item_output;
}

add_filter('walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4);

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify($html) {
    return str_replace('class="search-submit"', 'class="search-submit screen-reader-text"', $html);
}

add_filter('get_search_form', 'twentyfifteen_search_form_modify');

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';


/* increase cart number */

//* Make Font Awesome available
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

function enqueue_font_awesome() {

    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
}

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
add_filter('wp_nav_menu_items', 'sk_wcmenucart', 10, 2);

function sk_wcmenucart($menu, $args) {

    // Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
    if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) || 'primary' !== $args->theme_location)
        return $menu;

    ob_start();
    global $woocommerce;
    $viewing_cart = __('View your shopping cart', 'your-theme-slug');
    $start_shopping = __('Start shopping', 'your-theme-slug');
    $cart_url = $woocommerce->cart->get_cart_url();
    $shop_page_url = get_permalink(woocommerce_get_page_id('cart'));
    $cart_contents_count = $woocommerce->cart->cart_contents_count;
    $cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
    $cart_total = $woocommerce->cart->get_cart_total();
    // Uncomment the line below to hide nav menu cart item when there are no items in the cart
    // if ( $cart_contents_count > 0 ) {
    if ($cart_contents_count == 0) {
        $menu_item = '<li class="right"><a class="wcmenucart-contents" href="' . $shop_page_url . '" title="' . $start_shopping . '">';
    } else {
        $menu_item = '<li class="right"><a class="wcmenucart-contents" href="' . $cart_url . '" title="' . $viewing_cart . '">';
    }

    $menu_item .= '<i class="fa fa-shopping-cart"></i> ';

    $menu_item .= $cart_contents . ' - ' . $cart_total;
    $menu_item .= '</a></li>';
    // Uncomment the line below to hide nav menu cart item when there are no items in the cart
    // }
    echo $menu_item;
    $social = ob_get_clean();
    return $menu . $social;
}

/* add css to admin header */

add_action('admin_head', 'admin_css');

function admin_css() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/css/bootstrap.min.css">';
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/css/tab.css">';
}

/* add js to admin header */
function plugin_admin_head_js() {
//print "<script type='text/javascript' src='" . get_template_directory_uri() . "/js/custom.js'></script>";
print "<script type='text/javascript' src='" . get_template_directory_uri() . "/js/bootstrap.min.js'></script>";
//print "<script type='text/javascript' src='" . get_template_directory_uri() . "/js/jquery-1.9.1.min.js'></script>";
//
}
add_action('admin_head', 'plugin_admin_head_js');


/**
 * Add HTML5 theme support.
 */
function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );

//function yith_loop_add_to_shortcode_button(){
//    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); 
//    
//} 
//add_action( 'woocommerce_after_shop_loop_item', 'yith_loop_add_to_shortcode_button' );

/* add wishlist function*/

function enollo_move_wc_wishlist_button($product) {
	if ( shortcode_exists('yith_wcwl_add_to_wishlist') ) {
		echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
	}
}
add_action( 'woocommerce_product_thumbnails', 'enollo_move_wc_wishlist_button' );

/* end wishlist function*/

add_action( 'woocommerce_after_single_product_summary', 'woa_add_product_navigation' );

/* start pagignation function in product details*/
function woa_add_product_navigation() {
	?>
<div class="container"><table border="2" style="float:right !important;margin: 0 105px 0 0;"><tr><td  style="padding: 15px"><?php previous_post_link(); ?></td> <td style="padding: 15px"><?php next_post_link(); ?></td></tr></table></div>
	<?php
}

/* end pagignation function in product details*/

/* start pagignation in home page*/
// Display 12 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
/* end pagignation in home page*/



// Add Shortcode
function brandlogo( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'image' => '',
		), $atts )
	);
        $results = '<li class="nbs-flexisel-item" style="width: 221.6px;">
                        <div class="brand_wrap">
                            <img class="img-responsive" alt="myntra" src="'.$atts['image'].'">
                        </div>
                    </li>';
        //[brandlogo image="http://eshopper.local/wp-content/themes/eshopper/images/brand2.png" ][/brandlogo]
       // print_r($atts);die;
        return $results;
}


add_shortcode( 'brandlogo', 'brandlogo' );



?>