<?php
/**
 * Ayurvedic Medicine Theme Customizer
 *
 * @package Ayurvedic Medicine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ayurvedic_medicine_customize_register( $wp_customize ) {

	function ayurvedic_medicine_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	wp_enqueue_style('ayurvedic-medicine-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	// Enable / Disable Logo
	$wp_customize->add_setting('ayurvedic_medicine_logo_enable',array(
		'default' => true,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_logo_enable', array(
		'settings' => 'ayurvedic_medicine_logo_enable',
		'section'   => 'title_tagline',
		'label'     => __('Enable Logo','ayurvedic-medicine'),
		'type'      => 'checkbox'
	));

	//Logo
    $wp_customize->add_setting('ayurvedic_medicine_logo_width', array(
        'default' => 200,
        'transport' => 'refresh',
        'sanitize_callback' => 'ayurvedic_medicine_sanitize_integer'
    ));
    $wp_customize->add_control(new Ayurvedic_Medicine_Slider_Custom_Control($wp_customize, 'ayurvedic_medicine_logo_width', array(
    	'label'          => __( 'Logo Width', 'ayurvedic-medicine'),
        'section' => 'title_tagline',
        'settings' => 'ayurvedic_medicine_logo_width',
        'input_attrs' => array(
            'step' => 1,
            'min' => 0,
            'max' => 300,
        ),
    )));

	// color site title
	$wp_customize->add_setting('ayurvedic_medicine_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'ayurvedic_medicine_sitetitle_color', array(
	   'settings' => 'ayurvedic_medicine_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'ayurvedic-medicine'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('',array(
		'default' => false,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_title_enable', array(
	   'settings' => 'ayurvedic_medicine_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','ayurvedic-medicine'),
	   'type'      => 'checkbox'
	));

	// color site tagline
	$wp_customize->add_setting('ayurvedic_medicine_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_sitetagline_color', array(
	   'settings' => 'ayurvedic_medicine_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'ayurvedic-medicine'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('ayurvedic_medicine_tagline_enable',array(
		'default' => false,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_tagline_enable', array(
	   'settings' => 'ayurvedic_medicine_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','ayurvedic-medicine'),
	   'type'      => 'checkbox'
	));

	// woocommerce section
	$wp_customize->add_section('ayurvedic_medicine_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'ayurvedic-medicine'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('ayurvedic_medicine_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox'
	 ));
	 $wp_customize->add_control('ayurvedic_medicine_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_woocommerce_page_settings',
	 ));

    // shop page sidebar alignment
    $wp_customize->add_setting('ayurvedic_medicine_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices',
	));
	$wp_customize->add_control('ayurvedic_medicine_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'ayurvedic-medicine'),
		'section'        => 'ayurvedic_medicine_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'ayurvedic-medicine'),
			'Right Sidebar' => __('Right Sidebar', 'ayurvedic-medicine'),
		),
	));	 

	$wp_customize->add_setting('ayurvedic_medicine_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_choices'
	 ));
	 $wp_customize->add_control('ayurvedic_medicine_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','ayurvedic-medicine'),
		'choices' => array(
			 'Yes' => __('Yes','ayurvedic-medicine'),
			 'No' => __('No','ayurvedic-medicine'),
		 ),
		'section' => 'ayurvedic_medicine_woocommerce_page_settings',
	 ));

	 $wp_customize->add_setting( 'ayurvedic_medicine_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox'
    ) );
    $wp_customize->add_control('ayurvedic_medicine_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('ayurvedic_medicine_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices',
	));
	$wp_customize->add_control('ayurvedic_medicine_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'ayurvedic-medicine'),
		'section'        => 'ayurvedic_medicine_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'ayurvedic-medicine'),
			'Right Sidebar' => __('Right Sidebar', 'ayurvedic-medicine'),
		),
	));

	$wp_customize->add_setting('ayurvedic_medicine_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox'
	));
	$wp_customize->add_control('ayurvedic_medicine_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'ayurvedic_medicine_sanitize_integer'
    ) );
    $wp_customize->add_control(new Ayurvedic_Medicine_Slider_Custom_Control( $wp_customize, 'ayurvedic_medicine_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Woo Product Img Border Radius','ayurvedic-medicine'),
		'section'=> 'ayurvedic_medicine_woocommerce_page_settings',
		'settings'=>'ayurvedic_medicine_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	// Add a setting for number of products per row
    $wp_customize->add_setting('ayurvedic_medicine_products_per_row', array(
	    'default'   => '4',
	    'transport' => 'refresh',
	    'sanitize_callback' => 'ayurvedic_medicine_sanitize_integer'  
    ));

   	$wp_customize->add_control('ayurvedic_medicine_products_per_row', array(
	   'label'    => __('Products Per Row', 'ayurvedic-medicine'),
	   'section'  => 'ayurvedic_medicine_woocommerce_page_settings',
	   'settings' => 'ayurvedic_medicine_products_per_row',
	   'type'     => 'select',
	   'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
	  ),
   	) );
   
   	// Add a setting for the number of products per page
	$wp_customize->add_setting('ayurvedic_medicine_products_per_page', array(
		'default'   => '8',
		'transport' => 'refresh',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_integer'
	));

	$wp_customize->add_control('ayurvedic_medicine_products_per_page', array(
		'label'    => __('Products Per Page', 'ayurvedic-medicine'),
		'section'  => 'ayurvedic_medicine_woocommerce_page_settings',
		'settings' => 'ayurvedic_medicine_products_per_page',
		'type'     => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'step' => 1,
		),
	));

	//Theme Options
	$wp_customize->add_panel( 'ayurvedic_medicine_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'ayurvedic-medicine' ),
	) );

	//Site Layout Section
	$wp_customize->add_section('ayurvedic_medicine_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','ayurvedic-medicine'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','ayurvedic-medicine'),
		'priority'	=> 1,
		'panel' => 'ayurvedic_medicine_panel_area',
	));

	$wp_customize->add_setting('ayurvedic_medicine_preloader',array(
		'default' => false,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_preloader', array(
	   'section'   => 'ayurvedic_medicine_site_layoutsec',
	   'label'	=> __('Check to Show preloader','ayurvedic-medicine'),
	   'type'      => 'checkbox'
 	));	

	$wp_customize->add_setting('ayurvedic_medicine_preloader_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'ayurvedic_medicine_preloader_bg_image',array(
        'section' => 'ayurvedic_medicine_site_layoutsec',
		'label' => __('Preloader Background Image','ayurvedic-medicine'),
	)));

	$wp_customize->add_setting( 'ayurvedic_medicine_theme_page_breadcrumb',array(
		'default' => false,
        'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox',
	) );
	$wp_customize->add_control('ayurvedic_medicine_theme_page_breadcrumb',array(
       'section' => 'ayurvedic_medicine_site_layoutsec',
	   'label' => __( 'Check To Enable Theme Page Breadcrumb','ayurvedic-medicine' ),
	   'type' => 'checkbox'
    ));		

	$wp_customize->add_setting('ayurvedic_medicine_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_box_layout', array(
	   'section'   => 'ayurvedic_medicine_site_layoutsec',
	   'label'	=> __('Check to Show Box Layout','ayurvedic-medicine'),
	   'type'      => 'checkbox'
 	));

	// Add Settings and Controls for Page Layout
    $wp_customize->add_setting('ayurvedic_medicine_sidebar_page_layout',array(
		'default' => 'full',
	 	'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices'
	));
	$wp_customize->add_control('ayurvedic_medicine_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_site_layoutsec',
		'choices' => array(
			'full' => __('Full','ayurvedic-medicine'),
			'left' => __('Left','ayurvedic-medicine'),
			'right' => __('Right','ayurvedic-medicine'),
		),
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_site_layoutsec_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_site_layoutsec_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_site_layoutsec'
	));

	//Global Color
	$wp_customize->add_section('ayurvedic_medicine_global_color', array(
		'title'    => __('Manage Global Color Section', 'ayurvedic-medicine'),
		'panel'    => 'ayurvedic_medicine_panel_area',
	));

	$wp_customize->add_setting('ayurvedic_medicine_first_color', array(
		'default'           => '#A5C32D',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ayurvedic_medicine_first_color', array(
		'label'    => __('Theme Color', 'ayurvedic-medicine'),
		'section'  => 'ayurvedic_medicine_global_color',
		'settings' => 'ayurvedic_medicine_first_color',
	)));

	$wp_customize->add_setting('ayurvedic_medicine_second_color', array(
		'default'           => '#315E26',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ayurvedic_medicine_second_color', array(
		'label'    => __('Theme Color', 'ayurvedic-medicine'),
		'section'  => 'ayurvedic_medicine_global_color',
		'settings' => 'ayurvedic_medicine_second_color',
	)));

	$wp_customize->add_setting( 'ayurvedic_medicine_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_global_color'
	));
	
	// Header Section
	$wp_customize->add_section('ayurvedic_medicine_topbar_section',array(
	    'title' => __('Manage Header Section','ayurvedic-medicine'),
	    'description' => __('<p class="sec-title">Manage Header Section</p>', 'ayurvedic-medicine'),
	    'priority'  => null,
	    'panel' => 'ayurvedic_medicine_panel_area',
	));	

	$wp_customize->add_setting('ayurvedic_medicine_stickyheader',array(
		'default' => false,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_stickyheader', array(
	   'section'   => 'ayurvedic_medicine_topbar_section',
	   'label'	=> __('Check To Show Sticky Header','ayurvedic-medicine'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting( 'ayurvedic_medicine_header_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_header_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_topbar_section'
	));

	// Banner Section
	$wp_customize->add_section('ayurvedic_medicine_banner_section',array(
	    'title' => __('Manage Banner Section','ayurvedic-medicine'),
	    'priority'  => null,
	    'description'	=> __('<p class="sec-title">Manage Banner Section</p> Select Page from the Dropdowns for banner, Also use the given image dimension (300 x 300).','ayurvedic-medicine'),
	    'panel' => 'ayurvedic_medicine_panel_area',
	));	

	$wp_customize->add_setting('ayurvedic_medicine_banner',array(
		'default' => false,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_banner', array(
	   'settings' => 'ayurvedic_medicine_banner',
	   'section'   => 'ayurvedic_medicine_banner_section',
	   'label'     => __('Check To Enable This Section','ayurvedic-medicine'),
	   'type'      => 'checkbox'
	));

	// Page Dropdown
	$wp_customize->add_setting('ayurvedic_medicine_banner_pageboxes', array(
	    'default'           => '0',
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'ayurvedic_medicine_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('ayurvedic_medicine_banner_pageboxes', array(
	    'type'     => 'dropdown-pages',
	    'label'    => __('Select Page to display Banner', 'ayurvedic-medicine'),
	    'section'  => 'ayurvedic_medicine_banner_section',
	));

	// Button Text
	$wp_customize->add_setting('ayurvedic_medicine_button_text', array(
	    'default'           => 'Explore more',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('ayurvedic_medicine_button_text', array(
	    'settings' => 'ayurvedic_medicine_button_text',
	    'section'  => 'ayurvedic_medicine_banner_section',
	    'label'    => __('Add Banner Button Text', 'ayurvedic-medicine'),
	    'type'     => 'text',
	));

	// Button Link
	$wp_customize->add_setting('ayurvedic_medicine_button_link_banner', array(
	    'default'           => '',
	    'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('ayurvedic_medicine_button_link_banner', array(
	    'label'    => __('Add Banner Button Link', 'ayurvedic-medicine'),
	    'section'  => 'ayurvedic_medicine_banner_section',
	    'type'     => 'url',
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_banner_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_banner_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_banner_section'
	));

	// Products Section
	$wp_customize->add_section('ayurvedic_medicine_deal_section', array(
	    'title'       => __('Manage Products Section', 'ayurvedic-medicine'),
	    'description' => __('<p class="sec-title">Manage Products Section</p>', 'ayurvedic-medicine'),
	    'priority'    => null,
	    'panel'       => 'ayurvedic_medicine_panel_area',
	));

	$wp_customize->add_setting('ayurvedic_medicine_disabled_deal_section', array(
	    'default'           => false,
	    'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('ayurvedic_medicine_disabled_deal_section', array(
	    'settings' => 'ayurvedic_medicine_disabled_deal_section',
	    'section'  => 'ayurvedic_medicine_deal_section',
	    'label'    => __('Check To Enable Section', 'ayurvedic-medicine'),
	    'type'     => 'checkbox',
	));

	$wp_customize->add_setting('ayurvedic_medicine_deal_sec_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('ayurvedic_medicine_deal_sec_title', array(
	    'settings' => 'ayurvedic_medicine_deal_sec_title',
	    'section'  => 'ayurvedic_medicine_deal_section',
	    'label'    => __('Add Products Section Title', 'ayurvedic-medicine'),
	    'type'     => 'text',
	));

	$wp_customize->add_setting('ayurvedic_medicine_deal_sec_text', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('ayurvedic_medicine_deal_sec_text', array(
	    'settings' => 'ayurvedic_medicine_deal_sec_text',
	    'section'  => 'ayurvedic_medicine_deal_section',
	    'label'    => __('Add Products Section Text', 'ayurvedic-medicine'),
	    'type'     => 'text',
	));

	$ayurvedic_medicine_args = array(
       	'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
	$ayurvedic_medicine_categories = get_categories($ayurvedic_medicine_args);
	$ayurvedic_medicine_cat_posts = array();
	$ayurvedic_medicine_m = 0;
	$ayurvedic_medicine_cat_posts[]='Select';
	foreach($ayurvedic_medicine_categories as $ayurvedic_medicine_category){
		if($ayurvedic_medicine_m==0){
			$ayurvedic_medicine_default = $ayurvedic_medicine_category->slug;
			$ayurvedic_medicine_m++;
		}
		$ayurvedic_medicine_cat_posts[$ayurvedic_medicine_category->slug] = $ayurvedic_medicine_category->name;
	}

	$wp_customize->add_setting('ayurvedic_medicine_products_cat',array(
		'default'	=> 'select',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices',
	));
	$wp_customize->add_control('ayurvedic_medicine_products_cat',array(
		'type'    => 'select',
		'choices' => $ayurvedic_medicine_cat_posts,
		'label' => __('Select category to display products ','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_deal_section',
	));

	$wp_customize->add_setting('ayurvedic_medicine_product_delivery_icon',array(
        'default'=> 'fa-solid fa-truck-fast',
        'sanitize_callback' => 'sanitize_text_field'
    ));
        $wp_customize->add_control('ayurvedic_medicine_product_delivery_icon',array(
        'label' => __('Add Icon ','ayurvedic-medicine'),
        'description' => __('Fontawesome Icon (e.g., fa-solid fa-truck-fast)','ayurvedic-medicine'),
        'section'=> 'ayurvedic_medicine_deal_section',
        'type'=> 'text'
    ));

	$wp_customize->add_setting('ayurvedic_medicine_product_delivery_text', array(
	    'default'           => 'Delivery by Tomorrow',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('ayurvedic_medicine_product_delivery_text', array(
	    'settings' => 'ayurvedic_medicine_product_delivery_text',
	    'section'  => 'ayurvedic_medicine_deal_section',
	    'label'    => __('Add Delivery Text', 'ayurvedic-medicine'),
	    'type'     => 'text',
	));

	$wp_customize->add_setting('ayurvedic_medicine_product_clock_timer_end', array(
		'default'=> '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('ayurvedic_medicine_product_clock_timer_end', array(
		'label' => __('Enter Timer for Deal','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_deal_section',
		'description' => __('Timer get the current date and time. You simply need to include the end date. Please Use the following format to add the date "Month date year hours:minutes:seconds" example "July 12 2025 03:00:00".','ayurvedic-medicine'),
		'type'=> 'text',
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_product_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_product_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_deal_section'
	));

	//Blog post
	$wp_customize->add_section('ayurvedic_medicine_blog_post_settings',array(
        'title' => __('Manage Post Section', 'ayurvedic-medicine'),
        'priority' => null,
        'panel' => 'ayurvedic_medicine_panel_area'
    ) );

	$wp_customize->add_setting('ayurvedic_medicine_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control('ayurvedic_medicine_metafields_date', array(
	    'settings' => 'ayurvedic_medicine_metafields_date', 
	    'section'   => 'ayurvedic_medicine_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'ayurvedic-medicine'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('ayurvedic_medicine_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));	
	$wp_customize->add_control('ayurvedic_medicine_metafields_comments', array(
		'settings' => 'ayurvedic_medicine_metafields_comments',
		'section'  => 'ayurvedic_medicine_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'ayurvedic-medicine'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('ayurvedic_medicine_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control('ayurvedic_medicine_metafields_author', array(
		'settings' => 'ayurvedic_medicine_metafields_author',
		'section'  => 'ayurvedic_medicine_blog_post_settings',
		'label'    => __('Check to Enable Author', 'ayurvedic-medicine'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('ayurvedic_medicine_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control('ayurvedic_medicine_metafields_time', array(
		'settings' => 'ayurvedic_medicine_metafields_time',
		'section'  => 'ayurvedic_medicine_blog_post_settings',
		'label'    => __('Check to Enable Time', 'ayurvedic-medicine'),
		'type'     => 'checkbox',
	));	

	$wp_customize->add_setting('ayurvedic_medicine_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','ayurvedic-medicine'),
		'description' => __('Ex: "/", "|", "-", ...','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_blog_post_settings'
	)); 

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('ayurvedic_medicine_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices'
	));
	$wp_customize->add_control('ayurvedic_medicine_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'ayurvedic-medicine'),
		'description'   => __('This option work for blog page, archive page and search page.', 'ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_blog_post_settings',
		'choices' => array(
			'full' => __('Full','ayurvedic-medicine'),
			'left' => __('Left','ayurvedic-medicine'),
			'right' => __('Right','ayurvedic-medicine'),
			'three-column' => __('Three Columns','ayurvedic-medicine'),
			'four-column' => __('Four Columns','ayurvedic-medicine'),
			'grid' => __('Grid Layout','ayurvedic-medicine')
     ),
	) );

	$wp_customize->add_setting('ayurvedic_medicine_blog_post_description_option',array(
    	'default'   => 'Excerpt Content', 
        'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices'
	));
	$wp_customize->add_control('ayurvedic_medicine_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','ayurvedic-medicine'),
        'section' => 'ayurvedic_medicine_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','ayurvedic-medicine'),
            'Excerpt Content' => __('Excerpt Content','ayurvedic-medicine'),
            'Full Content' => __('Full Content','ayurvedic-medicine'),
        ),
	) );

	$wp_customize->add_setting('ayurvedic_medicine_blog_post_thumb',array(
        'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('ayurvedic_medicine_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'ayurvedic-medicine'),
        'section'     => 'ayurvedic_medicine_blog_post_settings',
    ));

    $wp_customize->add_setting( 'ayurvedic_medicine_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'ayurvedic_medicine_sanitize_integer'
    ) );
    $wp_customize->add_control(new Ayurvedic_Medicine_Slider_Custom_Control( $wp_customize, 'ayurvedic_medicine_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','ayurvedic-medicine'),
		'section'=> 'ayurvedic_medicine_blog_post_settings',
		'settings'=>'ayurvedic_medicine_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'ayurvedic_medicine_blog_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_blog_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_blog_post_settings'
	));

	//Single Post Settings
	$wp_customize->add_section('ayurvedic_medicine_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'ayurvedic-medicine'),
		'priority' => null,
		'panel' => 'ayurvedic_medicine_panel_area'
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control('ayurvedic_medicine_single_page_breadcrumb',array(
       'section' => 'ayurvedic_medicine_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','ayurvedic-medicine' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('ayurvedic_medicine_single_post_date',array(
		'default' => true,
		'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox'
	));
	$wp_customize->add_control('ayurvedic_medicine_single_post_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date ','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_single_post_settings'
	));	

	$wp_customize->add_setting('ayurvedic_medicine_single_post_author',array(
		'default' => true,
		'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox'
	));
	$wp_customize->add_control('ayurvedic_medicine_single_post_author',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Author','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_single_post_settings'
	));

	$wp_customize->add_setting('ayurvedic_medicine_single_post_comment',array(
		'default' => true,
		'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox'
	));
	$wp_customize->add_control('ayurvedic_medicine_single_post_comment',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Comments','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_single_post_settings'
	));	

	$wp_customize->add_setting('ayurvedic_medicine_single_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'ayurvedic_medicine_sanitize_checkbox'
	));
	$wp_customize->add_control('ayurvedic_medicine_single_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_single_post_settings'
	));	

	$wp_customize->add_setting('ayurvedic_medicine_single_post_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_single_post_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','ayurvedic-medicine'),
		'description' => __('Ex: "/", "|", "-", ...','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_single_post_settings'
	)); 

	$wp_customize->add_setting('ayurvedic_medicine_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices'
	));
	$wp_customize->add_control('ayurvedic_medicine_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'ayurvedic-medicine'),
     	'section' => 'ayurvedic_medicine_single_post_settings',
     	'choices' => array(
			'full' => __('Full','ayurvedic-medicine'),
			'left' => __('Left','ayurvedic-medicine'),
			'right' => __('Right','ayurvedic-medicine'),
     ),
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_single_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'ayurvedic_medicine_sanitize_integer'
    ) );
    $wp_customize->add_control(new Ayurvedic_Medicine_Slider_Custom_Control( $wp_customize, 'ayurvedic_medicine_single_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Single Post Image Box Shadow','ayurvedic-medicine'),
		'section'=> 'ayurvedic_medicine_single_post_settings',
		'settings'=>'ayurvedic_medicine_single_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'ayurvedic_medicine_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_single_post_settings'
	));

	// 404 Page Settings
	$wp_customize->add_section('ayurvedic_medicine_page_not_found', array(
		'title'	=> __('Manage 404 Page Section','ayurvedic-medicine'),
		'priority'	=> null,
		'panel' => 'ayurvedic_medicine_panel_area',
	));
	
	$wp_customize->add_setting('ayurvedic_medicine_page_not_found_heading',array(
		'default'=> __('404 Not Found','ayurvedic-medicine'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_page_not_found_heading',array(
		'label'	=> __('404 Heading','ayurvedic-medicine'),
		'section'=> 'ayurvedic_medicine_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ayurvedic_medicine_page_not_found_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('ayurvedic_medicine_page_not_found_content',array(
		'label'	=> __('404 Text','ayurvedic-medicine'),
		'input_attrs' => array(
			'placeholder' => __( 'Looks like you have taken a wrong turn.....Don\'t worry... it happens to the best of us.', 'ayurvedic-medicine' ),
		),
		'section'=> 'ayurvedic_medicine_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_page_not_found_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_page_not_found_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_page_not_found'
	));

	// Footer Section
	$wp_customize->add_section('ayurvedic_medicine_footer', array(
		'title'	=> __('Manage Footer Section','ayurvedic-medicine'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','ayurvedic-medicine'),
		'priority'	=> null,
		'panel' => 'ayurvedic_medicine_panel_area',
	));

	$wp_customize->add_setting('ayurvedic_medicine_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox',
	));
	$wp_customize->add_control('ayurvedic_medicine_footer_widget', array(
	    'settings' => 'ayurvedic_medicine_footer_widget',
	    'section'   => 'ayurvedic_medicine_footer',
	    'label'     => __('Check to Enable Footer Widget', 'ayurvedic-medicine'),
	    'type'      => 'checkbox',
	));

	//  footer bg color
	$wp_customize->add_setting('ayurvedic_medicine_footerbg_color',array(
		'default' => '',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footerbg_color', array(
		'settings' => 'ayurvedic_medicine_footerbg_color',
		'section'   => 'ayurvedic_medicine_footer',
		'label' => __('Footer Background Color', 'ayurvedic-medicine'),
		'type'      => 'color'
	));

	$wp_customize->add_setting('ayurvedic_medicine_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'ayurvedic_medicine_footer_bg_image',array(
        'label' => __('Footer Background Image','ayurvedic-medicine'),
        'section' => 'ayurvedic_medicine_footer',
    )));

	$wp_customize->add_setting('ayurvedic_medicine_footer_img_position',array(
		'default' => 'center center',
		'transport' => 'refresh',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices'
	));
	$wp_customize->add_control('ayurvedic_medicine_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_footer',
		'choices' 	=> array(
			'center center'   => esc_html__( 'Center', 'ayurvedic-medicine' ),
			'center top'   => esc_html__( 'Top', 'ayurvedic-medicine' ),
			'left center'   => esc_html__( 'Left', 'ayurvedic-medicine' ),
			'right center'   => esc_html__( 'Right', 'ayurvedic-medicine' ),
			'center bottom'   => esc_html__( 'Bottom', 'ayurvedic-medicine' ),
		),
	));	

	$wp_customize->add_setting('ayurvedic_medicine_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices',
	));
	$wp_customize->add_control('ayurvedic_medicine_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'ayurvedic_medicine_footer',
		'label'       => __('Footer widget area', 'ayurvedic-medicine'),
		'choices' => array(
		   '1'     => __('One', 'ayurvedic-medicine'),
		   '2'     => __('Two', 'ayurvedic-medicine'),
		   '3'     => __('Three', 'ayurvedic-medicine'),
		   '4'     => __('Four', 'ayurvedic-medicine')
		),
	));

	$wp_customize->add_setting('ayurvedic_medicine_copyright_line',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_copyright_line', array(
	   'section' 	=> 'ayurvedic_medicine_footer',
	   'label'	 	=> __('Copyright Line','ayurvedic-medicine'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	$wp_customize->add_setting('ayurvedic_medicine_copyright_link',array(
    	'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_copyright_link', array(
	   'section' 	=> 'ayurvedic_medicine_footer',
	   'label'	 	=> __('Copyright Link','ayurvedic-medicine'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	//  footer coypright color
	$wp_customize->add_setting('ayurvedic_medicine_footercoypright_color',array(
		'default' => '',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footercoypright_color', array(
	   'settings' => 'ayurvedic_medicine_footercoypright_color',
	   'section'   => 'ayurvedic_medicine_footer',
	   'label' => __('Coypright Color', 'ayurvedic-medicine'),
	   'type'      => 'color'
	));

	//  footer title color
	$wp_customize->add_setting('ayurvedic_medicine_footertitle_color',array(
		'default' => '',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footertitle_color', array(
	   'settings' => 'ayurvedic_medicine_footertitle_color',
	   'section'   => 'ayurvedic_medicine_footer',
	   'label' => __('Title Color', 'ayurvedic-medicine'),
	   'type'      => 'color'
	));

	//  footer description color
	$wp_customize->add_setting('ayurvedic_medicine_footerdescription_color',array(
		'default' => '',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footerdescription_color', array(
	   'settings' => 'ayurvedic_medicine_footerdescription_color',
	   'section'   => 'ayurvedic_medicine_footer',
	   'label' => __('Description Color', 'ayurvedic-medicine'),
	   'type'      => 'color'
	));

	//  footer list color
	$wp_customize->add_setting('ayurvedic_medicine_footerlist_color',array(
		'default' => '',
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footerlist_color', array(
	   'settings' => 'ayurvedic_medicine_footerlist_color',
	   'section'   => 'ayurvedic_medicine_footer',
	   'label' => __('List Color', 'ayurvedic-medicine'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('ayurvedic_medicine_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'ayurvedic_medicine_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'ayurvedic_medicine_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'ayurvedic-medicine' ),
        'section'        => 'ayurvedic_medicine_footer',
        'settings'       => 'ayurvedic_medicine_scroll_hide',
        'type'           => 'checkbox',
    )));

	$wp_customize->add_setting('ayurvedic_medicine_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'ayurvedic_medicine_sanitize_choices'
    ));
    $wp_customize->add_control('ayurvedic_medicine_scroll_position',array(
        'type' => 'radio',
        'section' => 'ayurvedic_medicine_footer',
        'label'	 	=> __('Scroll To Top Positions','ayurvedic-medicine'),
        'choices' => array(
            'Right' => __('Right','ayurvedic-medicine'),
            'Left' => __('Left','ayurvedic-medicine'),
            'Center' => __('Center','ayurvedic-medicine')
        ),
    ) );

	$wp_customize->add_setting('ayurvedic_medicine_scroll_text',array(
		'default'	=> __('TOP','ayurvedic-medicine'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('ayurvedic_medicine_scroll_text',array(
		'label'	=> __('Scroll To Top Button Text','ayurvedic-medicine'),
		'section'	=> 'ayurvedic_medicine_footer',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_scroll_top_shape', array(
		'default'           => 'circle',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	$wp_customize->add_control( 'ayurvedic_medicine_scroll_top_shape', array(
		'label'    => __( 'Scroll to Top Button Shape', 'ayurvedic-medicine' ),
		'section'  => 'ayurvedic_medicine_footer',
		'settings' => 'ayurvedic_medicine_scroll_top_shape',
		'type'     => 'radio',
		'choices'  => array(
			'box'        => __( 'Box', 'ayurvedic-medicine' ),
			'curved' => __( 'Curved', 'ayurvedic-medicine'),
			'circle'     => __( 'Circle', 'ayurvedic-medicine' ),
		),
	) );

	$wp_customize->add_setting( 'ayurvedic_medicine_footer_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_footer_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_footer'
	));
    
	// Footer Social Section
	$wp_customize->add_section('ayurvedic_medicine_footer_social_icons', array(
		'title'	=> __('Manage Footer Social Section','ayurvedic-medicine'),
		'description'	=> __('<p class="sec-title">Manage Footer Social Section</p>','ayurvedic-medicine'),
		'priority'	=> null,
		'panel' => 'ayurvedic_medicine_panel_area',
	));

	$wp_customize->add_setting('ayurvedic_medicine_footer_facebook_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footer_facebook_link', array(
		'settings' => 'ayurvedic_medicine_footer_facebook_link',
		'section'   => 'ayurvedic_medicine_footer_social_icons',
		'label' => __('Facebook Link', 'ayurvedic-medicine'),
		'type'      => 'url'
	));

	$wp_customize->add_setting('ayurvedic_medicine_footer_instagram_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footer_instagram_link', array(
		'settings' => 'ayurvedic_medicine_footer_instagram_link',
		'section'   => 'ayurvedic_medicine_footer_social_icons',
		'label' => __('Instagram Link', 'ayurvedic-medicine'),
		'type'      => 'url'
	));

	$wp_customize->add_setting('ayurvedic_medicine_footer_pinterest_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footer_pinterest_link', array(
		'settings' => 'ayurvedic_medicine_footer_pinterest_link',
		'section'   => 'ayurvedic_medicine_footer_social_icons',
		'label' => __('Pinterest Link', 'ayurvedic-medicine'),
		'type'      => 'url'
	));

	$wp_customize->add_setting('ayurvedic_medicine_footer_twitter_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footer_twitter_link', array(
		'settings' => 'ayurvedic_medicine_footer_twitter_link',
		'section'   => 'ayurvedic_medicine_footer_social_icons',
		'label' => __('Twitter Link', 'ayurvedic-medicine'),
		'type'      => 'url'
	));

	$wp_customize->add_setting('ayurvedic_medicine_footer_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_footer_youtube_link', array(
		'settings' => 'ayurvedic_medicine_footer_youtube_link',
		'section'   => 'ayurvedic_medicine_footer_social_icons',
		'label' => __('Youtube Link', 'ayurvedic-medicine'),
		'type'      => 'url'
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_footer_social_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ayurvedic_medicine_footer_social_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		<a target='_blank' href='". esc_url(AYURVEDIC_MEDICINE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'ayurvedic_medicine_footer_social_icons'
	));

	// Google Fonts
	$wp_customize->add_section( 'ayurvedic_medicine_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'ayurvedic-medicine' ),
		'priority'    => 24,
	) );

	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'ayurvedic_medicine_headings_fonts', array(
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_fonts',
	));
	$wp_customize->add_control( 'ayurvedic_medicine_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'ayurvedic-medicine'),
		'section' => 'ayurvedic_medicine_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'ayurvedic_medicine_body_fonts', array(
		'sanitize_callback' => 'ayurvedic_medicine_sanitize_fonts'
	));
	$wp_customize->add_control( 'ayurvedic_medicine_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'ayurvedic-medicine' ),
		'section' => 'ayurvedic_medicine_google_fonts_section',
		'choices' => $font_choices
	));
  
}
add_action( 'customize_register', 'ayurvedic_medicine_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ayurvedic_medicine_customize_preview_js() {
	wp_enqueue_script( 'ayurvedic_medicine_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'ayurvedic_medicine_customize_preview_js' );
