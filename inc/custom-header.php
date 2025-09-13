<?php
/**
 * @package Ayurvedic Medicine
 * Setup the WordPress core custom header feature.
 *
 * @uses ayurvedic_medicine_header_style()
 */
function ayurvedic_medicine_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ayurvedic_medicine_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 2500,
		'height'                 => 300,
		'wp-head-callback'       => 'ayurvedic_medicine_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'ayurvedic_medicine_custom_header_setup' );

if ( ! function_exists( 'ayurvedic_medicine_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see ayurvedic_medicine_custom_header_setup().
 */
function ayurvedic_medicine_header_style() {
    $ayurvedic_medicine_header_image = get_header_image() ?: get_template_directory_uri() . '/images/headerimg.png';

    $ayurvedic_medicine_custom_css = "
        .box-image .single-page-img {
            background-image: url('{$ayurvedic_medicine_header_image}');
            background-repeat: no-repeat;
            background-position: center bottom;
            background-size: cover !important;
            height: 300px;
        }

        h1.site-title a, p.site-title a {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_sitetitle_color')) . " !important;
        }

        .site-description {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_sitetagline_color')) . " !important;
        }

        .main-nav ul li a {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_menu_color')) . " !important;
        }

        .main-nav a:hover {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_menuhrv_color')) . " !important;
        }

        .main-nav ul ul a {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_submenu_color')) . " !important;
        }

        .main-nav ul ul a:hover {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_submenuhrv_color')) . " !important;
        }

        .copywrap, .copywrap a {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_footercoypright_color')) . " !important;
        }

        #footer h3 {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_footertitle_color')) . " !important;
        }

        #footer p {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_footerdescription_color')) . ";
        }

        #footer ul li a {
            color: " . esc_attr(get_theme_mod('ayurvedic_medicine_footerlist_color')) . ";
        }

        #footer {
            background-color: " . esc_attr(get_theme_mod('ayurvedic_medicine_footerbg_color')) . ";
        }
    ";

    // Attach to your main stylesheet (make sure this handle matches the one you registered)
    wp_add_inline_style('ayurvedic-medicine-style', $ayurvedic_medicine_custom_css);
}
endif;
add_action('wp_enqueue_scripts', 'ayurvedic_medicine_header_style');