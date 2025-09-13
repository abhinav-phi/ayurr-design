<?php
/**
 * Ayurvedic Medicine functions and definitions
 *
 * @package Ayurvedic Medicine
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'ayurvedic_medicine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function ayurvedic_medicine_setup() {
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 680;
	
	load_theme_textdomain( 'ayurvedic-medicine', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'custom-header', array(
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 100,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ayurvedic-medicine' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_editor_style( 'editor-style.css' );

	global $pagenow;

    if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        add_action('admin_notices', 'ayurvedic_medicine_deprecated_hook_admin_notice');
    }
}
endif; // ayurvedic_medicine_setup
add_action( 'after_setup_theme', 'ayurvedic_medicine_setup' );

function ayurvedic_medicine_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a> >> ";

        if (is_category() || is_single()) {
            the_category(' >> ');
            if (is_single()) {
                echo ' >> <span class="current-breadcrumb">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function ayurvedic_medicine_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'ayurvedic-medicine' ),
		'description'   => __( 'Appears on blog page sidebar', 'ayurvedic-medicine' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'ayurvedic-medicine' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'ayurvedic-medicine' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'ayurvedic-medicine' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ayurvedic-medicine' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
        'name'          => __('Shop Sidebar', 'ayurvedic-medicine'),
        'description'   => __('Sidebar for WooCommerce shop pages', 'ayurvedic-medicine'),
		'id'            => 'woocommerce-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'ayurvedic-medicine'),
        'description'   => __('Sidebar for single product pages', 'ayurvedic-medicine'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));		
	
	$ayurvedic_medicine_widget_areas = get_theme_mod('ayurvedic_medicine_footer_widget_areas', '4');
	for ($ayurvedic_medicine_i=1; $ayurvedic_medicine_i<=$ayurvedic_medicine_widget_areas; $ayurvedic_medicine_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'ayurvedic-medicine' ) . $ayurvedic_medicine_i,
			'id'            => 'footer-' . $ayurvedic_medicine_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="ftr-4-box widget-column-4 %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

}
add_action( 'widgets_init', 'ayurvedic_medicine_widgets_init' );

// Change number of products per row to 3
add_filter('loop_shop_columns', 'ayurvedic_medicine_loop_columns');
if (!function_exists('ayurvedic_medicine_loop_columns')) {
    function ayurvedic_medicine_loop_columns() {
        $colm = get_theme_mod('ayurvedic_medicine_products_per_row', 4); // Default to 3 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function ayurvedic_medicine_products_per_page($cols) {
    $cols = get_theme_mod('ayurvedic_medicine_products_per_page', 8); // Default to 8 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'ayurvedic_medicine_products_per_page', 8);

function ayurvedic_medicine_scripts() {
	
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style('ayurvedic-medicine-style', get_stylesheet_uri(), array() );
		wp_style_add_data('ayurvedic-medicine-style', 'rtl', 'replace');
	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'ayurvedic-medicine-style',$ayurvedic_medicine_color_scheme_css );
	wp_enqueue_style( 'ayurvedic-medicine-default', esc_url(get_template_directory_uri())."/css/default.css" );
	wp_enqueue_style( 'ayurvedic-medicine-style', get_stylesheet_uri() );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'ayurvedic-medicine-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );
	wp_enqueue_style( 'ayurvedic-medicine-block-style', esc_url( get_template_directory_uri() ).'/css/blocks.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// font-family
    $ayurvedic_medicine_body_font = esc_html(get_theme_mod('ayurvedic_medicine_body_fonts'));

    if ($ayurvedic_medicine_body_font) {
        wp_enqueue_style('ayurvedic-medicine-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($ayurvedic_medicine_body_font));
    } else {
        wp_enqueue_style('Montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900');
    }
}
add_action( 'wp_enqueue_scripts', 'ayurvedic_medicine_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Sanitization Callbacks.
 */
require get_template_directory() . '/inc/sanitization-callbacks.php';

/**
 * Webfont-Loader.
 */
require get_template_directory() . '/inc/wptt-webfont-loader.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * select .
 */
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

function ayurvedic_medicine_setup_theme() {
	if ( ! defined( 'AYURVEDIC_MEDICINE_PRO_NAME' ) ) {
		define( 'AYURVEDIC_MEDICINE_PRO_NAME', __( 'About Ayurvedic Medicine', 'ayurvedic-medicine' ));
	}
	if ( ! defined( 'AYURVEDIC_MEDICINE_PREMIUM_PAGE' ) ) {
	define('AYURVEDIC_MEDICINE_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/ayurvedic-medicine-wordpress-theme','ayurvedic-medicine'));
	}
	if ( ! defined( 'AYURVEDIC_MEDICINE_THEME_PAGE' ) ) {
	define('AYURVEDIC_MEDICINE_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','ayurvedic-medicine'));
	}
	if ( ! defined( 'AYURVEDIC_MEDICINE_SUPPORT' ) ) {
	define('AYURVEDIC_MEDICINE_SUPPORT',__('https://wordpress.org/support/theme/ayurvedic-medicine/','ayurvedic-medicine'));
	}
	if ( ! defined( 'AYURVEDIC_MEDICINE_REVIEW' ) ) {
	define('AYURVEDIC_MEDICINE_REVIEW',__('https://wordpress.org/support/theme/ayurvedic-medicine/reviews/','ayurvedic-medicine'));
	}
	if ( ! defined( 'AYURVEDIC_MEDICINE_PRO_DEMO' ) ) {
	define('AYURVEDIC_MEDICINE_PRO_DEMO',__('https://live.theclassictemplates.com/ayurvedic-medicine-pro/','ayurvedic-medicine'));
	}
	if ( ! defined( 'AYURVEDIC_MEDICINE_THEME_DOCUMENTATION' ) ) {
	define('AYURVEDIC_MEDICINE_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/ayurvedic-medicine-free/','ayurvedic-medicine'));
	}
}
add_action('after_setup_theme', 'ayurvedic_medicine_setup_theme');
    
// logo
if ( ! function_exists( 'ayurvedic_medicine_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function ayurvedic_medicine_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

/* Activation Notice */
function ayurvedic_medicine_deprecated_hook_admin_notice() {
    $ayurvedic_medicine_theme = wp_get_theme();
    $ayurvedic_medicine_dismissed = get_user_meta( get_current_user_id(), 'ayurvedic_medicine_dismissable_notice', true );
    if ( !$ayurvedic_medicine_dismissed) { ?>
        <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class">
            <div class="admin-image">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
            <div class="admin-content" >
                <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'ayurvedic-medicine' ), esc_html($ayurvedic_medicine_theme->get( 'Name' )), esc_html($ayurvedic_medicine_theme->get( 'Version' ))); ?>
                </h1>
                <p><?php _e('Get Started With Theme By Clicking On Getting Started.', 'ayurvedic-medicine'); ?></p>
                <div style="display: grid;">
                    <a class="admin-notice-btn button button-hero upgrade-pro" target="_blank" href="<?php echo esc_url( AYURVEDIC_MEDICINE_PREMIUM_PAGE ); ?>"><?php esc_html_e('Upgrade Pro', 'ayurvedic-medicine') ?><i class="dashicons dashicons-cart"></i></a>
                    <a class="admin-notice-btn button button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=ayurvedic-medicine' )); ?>"><?php esc_html_e( 'Get started', 'ayurvedic-medicine' ) ?><i class="dashicons dashicons-backup"></i></a>
                    <a class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( AYURVEDIC_MEDICINE_THEME_DOCUMENTATION ); ?>"><?php esc_html_e('Free Doc', 'ayurvedic-medicine') ?><i class="dashicons dashicons-visibility"></i></a>
                    <a  class="admin-notice-btn button button-hero" target="_blank" href="<?php echo esc_url( AYURVEDIC_MEDICINE_PRO_DEMO ); ?>"><?php esc_html_e('View Demo', 'ayurvedic-medicine') ?><i class="dashicons dashicons-awards"></i></a>
                </div>
            </div>
        </div>
    <?php }
}