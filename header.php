<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Ayurvedic Medicine
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<?php if ( get_theme_mod('ayurvedic_medicine_preloader', false) != "") { ?>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
<?php }?>

<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'ayurvedic-medicine' ); ?></a>

<div id="pageholder" <?php if( get_theme_mod( 'ayurvedic_medicine_box_layout', false) != "" ) { echo 'class="boxlayout"'; } ?>>

<div class="mainhead<?php if( get_theme_mod( 'ayurvedic_medicine_stickyheader', false) == 1) { ?> is-sticky-on"<?php } else { ?>close-sticky <?php } ?>">
  <div class="main-header py-2">
    <div class="container p-0">
      <div class="header-bg px-3">
        <div class="row">
          <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-12 col-12 align-self-center py-1">
            <div class="logo">
              <?php if (get_theme_mod('ayurvedic_medicine_logo_enable', true)) { ?>
                <?php ayurvedic_medicine_the_custom_logo(); ?>
              <?php } ?>
              <div class="site-branding-text">
                <?php if (get_theme_mod('ayurvedic_medicine_title_enable', false)) { ?>
                  <?php if (is_front_page() && is_home()) : ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                  <?php else : ?>
                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
                  <?php endif; ?>
                <?php } ?>
                <?php $ayurvedic_medicine_description = get_bloginfo('description', 'display');
                if ($ayurvedic_medicine_description || is_customize_preview()) : ?>
                  <?php if (get_theme_mod('ayurvedic_medicine_tagline_enable', false)) { ?>
                    <span class="site-description"><?php echo esc_html($ayurvedic_medicine_description); ?></span>
                  <?php } ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-xxl-7 col-xl-7 col-lg-6 col-md-3 col-sm-6 col-12 align-self-center text-center">
            <div class="menu-sec d-inline-block">
              <div class="toggle-nav text-center">
                <?php if (has_nav_menu('primary')) { ?>
                  <button role="tab"><?php esc_html_e('Menu', 'ayurvedic-medicine'); ?></button>
                <?php } ?>
              </div>
              <div id="mySidenav" class="nav sidenav">
                <nav id="site-navigation" class="main-nav" role="navigation" aria-label="<?php esc_attr_e('Top Menu', 'ayurvedic-medicine'); ?>">
                  <ul class="mobile_nav">
                    <?php wp_nav_menu(array(
                      'theme_location' => 'primary',
                      'container_class' => 'main-menu',
                      'items_wrap' => '%3$s',
                      'fallback_cb' => 'wp_page_menu',
                    )); ?>
                  </ul>
                  <a href="javascript:void(0)" class="close-button"><?php esc_html_e('CLOSE', 'ayurvedic-medicine'); ?></a>
                </nav>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 d-flex justify-content-lg-end justify-content-md-end justify-content-between align-items-center">
            <div class="top-search position-relative">
              <?php if(class_exists('woocommerce')):?>
                <?php get_product_search_form(); ?>
              <?php else : ?>
                <?php get_search_form(); ?>
              <?php endif; ?>
            </div>
            <?php if (class_exists('woocommerce')) { ?>
              <div class="product-account">
                <?php if (is_user_logged_in()) { ?>
                  <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php esc_attr_e('My Account', 'ayurvedic-medicine'); ?>"><i class="fa-solid fa-user"></i></a>
                <?php } else { ?>
                  <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php esc_attr_e('Login / Register', 'ayurvedic-medicine'); ?>"><i class="fa-solid fa-user"></i></a>
                <?php } ?>
              </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>