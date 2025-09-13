<?php
/*
 * @package Ayurvedic Medicine
 */

function ayurvedic_medicine_admin_enqueue_scripts() {
    wp_enqueue_style( 'ayurvedic-medicine-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'ayurvedic_medicine_admin_enqueue_scripts' );

function ayurvedic_medicine_theme_info_menu_link() {

    $ayurvedic_medicine_theme = wp_get_theme();
    add_theme_page(
        /* translators: 1: Theme name, 2: Theme version */
        sprintf( esc_html__( 'Welcome to %1$s %2$s', 'ayurvedic-medicine' ), $ayurvedic_medicine_theme->get( 'Name' ), $ayurvedic_medicine_theme->get( 'Version' ) ),
        esc_html__( 'Theme Info', 'ayurvedic-medicine' ),'edit_theme_options','ayurvedic-medicine','ayurvedic_medicine_theme_info_page'
    );

    // Add "Theme Demo Import" page
    add_theme_page(
        esc_html__( 'Theme Demo Import', 'ayurvedic-medicine' ),
        esc_html__( 'Theme Demo Import', 'ayurvedic-medicine' ),
        'edit_theme_options',
        'ayurvedic-medicine-demo',
        'ayurvedic_medicine_demo_content_page'
    );

}
add_action( 'admin_menu', 'ayurvedic_medicine_theme_info_menu_link' );

function ayurvedic_medicine_theme_info_page() {

    $ayurvedic_medicine_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'ayurvedic-medicine' ), esc_html($ayurvedic_medicine_theme->get( 'Name' )), esc_html($ayurvedic_medicine_theme->get( 'Version' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'ayurvedic-medicine' ); ?>
    </p>
    <div class="important-link">
        <p class="main-box columns-wrapper clearfix">
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Pro version of our theme', 'ayurvedic-medicine' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you exited for our theme? Then we will proceed for pro version of theme.', 'ayurvedic-medicine' ); ?></p>
                <a class="get-premium" href="<?php echo esc_url( AYURVEDIC_MEDICINE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'ayurvedic-medicine' ); ?></a>
                <p><strong><?php esc_html_e( 'Check all classic features', 'ayurvedic-medicine' ); ?></strong></p>
                <p><?php esc_html_e( 'Explore all the premium features.', 'ayurvedic-medicine' ); ?></p>
                <a href="<?php echo esc_url( AYURVEDIC_MEDICINE_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'ayurvedic-medicine' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Need Help?', 'ayurvedic-medicine' ); ?></strong></p>
                <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'ayurvedic-medicine' ); ?></p>
                <a href="<?php echo esc_url( AYURVEDIC_MEDICINE_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'ayurvedic-medicine' ); ?></a>
                <p><strong><?php esc_html_e( 'Leave us a review', 'ayurvedic-medicine' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'ayurvedic-medicine' ); ?></p>
                <a href="<?php echo esc_url( AYURVEDIC_MEDICINE_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'ayurvedic-medicine' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Check Our Demo', 'ayurvedic-medicine' ); ?></strong></p>
                <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium them.', 'ayurvedic-medicine' ); ?></p>
                <a href="<?php echo esc_url( AYURVEDIC_MEDICINE_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'ayurvedic-medicine' ); ?></a>
                <p><strong><?php esc_html_e( 'Theme Documentation', 'ayurvedic-medicine' ); ?></strong></p>
                <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'ayurvedic-medicine' ); ?></p>
                <a href="<?php echo esc_url( AYURVEDIC_MEDICINE_THEME_DOCUMENTATION ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'ayurvedic-medicine' ); ?></a>
            </div>
        </p>
    </div>
    <div id="getting-started">
        <h3><?php 
        /* translators: %s: Theme name */
        printf( esc_html__( 'Getting started with %s', 'ayurvedic-medicine' ),
        esc_html($ayurvedic_medicine_theme->get( 'Name' ))); ?></h3>
        <div class="columns-wrapper clearfix">
            <div class="column column-half clearfix">
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Description', 'ayurvedic-medicine' ); ?></h4>
                    <div class="theme-description-1"><?php echo esc_html($ayurvedic_medicine_theme->get( 'Description' )); ?></div>
                </div>
            </div>
            <div class="column column-half clearfix">
                <img src="<?php echo esc_url( $ayurvedic_medicine_theme->get_screenshot() ); ?>" alt="<?php echo esc_attr( 'screenshot', 'ayurvedic-medicine'); ?>"/>
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Options', 'ayurvedic-medicine' ); ?></h4>
                    <p class="about">
                    <?php 
                    /* translators: %s: Theme name */
                    printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'ayurvedic-medicine' ),esc_html($ayurvedic_medicine_theme->get( 'Name' ))); ?></p>
                    <p>
                    <div class="themelink-1">
                        <a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Theme', 'ayurvedic-medicine' ); ?></a>
                        <a class="get-premium" href="<?php echo esc_url( AYURVEDIC_MEDICINE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Checkout Premium', 'ayurvedic-medicine' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
      /* translators: 1: Theme name, 2: Developer name, 3: Call to action */
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'ayurvedic-medicine' ),
            esc_html($ayurvedic_medicine_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'ayurvedic-medicine' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url( AYURVEDIC_MEDICINE_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'ayurvedic-medicine' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'ayurvedic-medicine' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}

function ayurvedic_medicine_demo_content_page() {

    $ayurvedic_medicine_theme = wp_get_theme();
    ?>
    <div class="container">
       <div class="start-box">
          <div class="columns-wrapper m-0"> 
             <div class="column column-half clearfix">
               <div class="wrapper-info"> 
                  <img src="<?php echo esc_url( get_template_directory_uri().'/images/Logo.png' ); ?>" />
                  <h2><?php esc_html_e( 'Welcome to Ayurvedic Medicine', 'ayurvedic-medicine' ); ?></h2>
                  <span class="version"><?php esc_html_e( 'Version', 'ayurvedic-medicine' ); ?>: <?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></span>	
                  <p><?php esc_html_e( 'To begin, locate the run importer button and click on it to initiate the importation of all the demo content.', 'ayurvedic-medicine' ); ?></p>
                  <?php require get_parent_theme_file_path( '/inc/demo-content.php' ); ?>
                  <div id="demo-import-loader">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/images/status.gif'); ?>" alt="<?php echo esc_attr( 'Loading...', 'ayurvedic-medicine'); ?>" />
				  </div>
               </div>
             </div>
             <div class="column column-half clearfix">
             <div class="get-screenshot">
               <img src="<?php echo esc_url( get_template_directory_uri().'/screenshot.png' ); ?>" />
             </div>   
             </div>
          </div>
       </div>
    </div>
<?php
}

?>
