<?php
$ayurvedic_medicine_color_scheme_css = '';

$ayurvedic_medicine_first_color = get_theme_mod('ayurvedic_medicine_first_color');
$ayurvedic_medicine_second_color = get_theme_mod('ayurvedic_medicine_second_color');

/*------------------ Global First Color -----------*/

if ($ayurvedic_medicine_first_color) {
  $ayurvedic_medicine_color_scheme_css .= ':root {';
  $ayurvedic_medicine_color_scheme_css .= '--first-theme-color: ' . esc_attr($ayurvedic_medicine_first_color) . ' !important;';
  $ayurvedic_medicine_color_scheme_css .= '} ';
}

/*------------------ Global Second Color -----------*/

if ($ayurvedic_medicine_second_color) {
  $ayurvedic_medicine_color_scheme_css .= ':root {';
  $ayurvedic_medicine_color_scheme_css .= '--second-theme-color: ' . esc_attr($ayurvedic_medicine_second_color) . ' !important;';
  $ayurvedic_medicine_color_scheme_css .= '} ';
}
//---------------------------------Logo-Max-height--------- 
$ayurvedic_medicine_logo_width = get_theme_mod('ayurvedic_medicine_logo_width', 200);
if($ayurvedic_medicine_logo_width != false){
    $ayurvedic_medicine_color_scheme_css .='.logo img{';
      $ayurvedic_medicine_color_scheme_css .='width: '.esc_html($ayurvedic_medicine_logo_width).'px;';
    $ayurvedic_medicine_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Product Image Border Radius -------------------*/

$ayurvedic_medicine_woo_product_img_border_radius = get_theme_mod('ayurvedic_medicine_woo_product_img_border_radius');
if($ayurvedic_medicine_woo_product_img_border_radius != false){
    $ayurvedic_medicine_color_scheme_css .='.woocommerce-shop.woocommerce .product-content .product-image img{';
    $ayurvedic_medicine_color_scheme_css .='border-radius: '.esc_attr($ayurvedic_medicine_woo_product_img_border_radius).'px;';
    $ayurvedic_medicine_color_scheme_css .='}';
}  

/*--------------------------- Preloader Background Image--------------------------- */

$ayurvedic_medicine_preloader_bg_image = get_theme_mod('ayurvedic_medicine_preloader_bg_image');
if($ayurvedic_medicine_preloader_bg_image != false){
  $ayurvedic_medicine_color_scheme_css .='#preloader{';
    $ayurvedic_medicine_color_scheme_css .='background: url('.esc_attr($ayurvedic_medicine_preloader_bg_image).'); background-size: cover;';
  $ayurvedic_medicine_color_scheme_css .='}';
}

/*--------------------------- Scroll to top positions -------------------*/

$ayurvedic_medicine_scroll_position = get_theme_mod( 'ayurvedic_medicine_scroll_position','Right');
if($ayurvedic_medicine_scroll_position == 'Right'){
    $ayurvedic_medicine_color_scheme_css .='#button{';
        $ayurvedic_medicine_color_scheme_css .='right: 20px;';
    $ayurvedic_medicine_color_scheme_css .='}';
}else if($ayurvedic_medicine_scroll_position == 'Left'){
    $ayurvedic_medicine_color_scheme_css .='#button{';
        $ayurvedic_medicine_color_scheme_css .='left: 20px;';
    $ayurvedic_medicine_color_scheme_css .='}';
}else if($ayurvedic_medicine_scroll_position == 'Center'){
    $ayurvedic_medicine_color_scheme_css .='#button{';
        $ayurvedic_medicine_color_scheme_css .='right: 50%;left: 50%;';
    $ayurvedic_medicine_color_scheme_css .='}';
}

/*--------------------------- Footer background image -------------------*/

$ayurvedic_medicine_footer_bg_image = get_theme_mod('ayurvedic_medicine_footer_bg_image');
if($ayurvedic_medicine_footer_bg_image != false){
    $ayurvedic_medicine_color_scheme_css .='#footer{';
        $ayurvedic_medicine_color_scheme_css .='background: url('.esc_attr($ayurvedic_medicine_footer_bg_image).');';
        $ayurvedic_medicine_color_scheme_css .= 'background-size: cover;';  
    $ayurvedic_medicine_color_scheme_css .='}';
}

/*--------------------------- Footer image position -------------------*/

$ayurvedic_medicine_footer_img_position = get_theme_mod('ayurvedic_medicine_footer_img_position','center center');
if($ayurvedic_medicine_footer_img_position != false){
    $ayurvedic_medicine_color_scheme_css .='#footer{';
        $ayurvedic_medicine_color_scheme_css .='background-position: '.esc_attr($ayurvedic_medicine_footer_img_position).';';
    $ayurvedic_medicine_color_scheme_css .='}';
}	

/*--------------------------- Blog Post Page Image Box Shadow -------------------*/

$ayurvedic_medicine_blog_post_page_image_box_shadow = get_theme_mod('ayurvedic_medicine_blog_post_page_image_box_shadow',0);
if($ayurvedic_medicine_blog_post_page_image_box_shadow != false){
    $ayurvedic_medicine_color_scheme_css .='.blog-post img{';
        $ayurvedic_medicine_color_scheme_css .='box-shadow: '.esc_attr($ayurvedic_medicine_blog_post_page_image_box_shadow).'px '.esc_attr($ayurvedic_medicine_blog_post_page_image_box_shadow).'px '.esc_attr($ayurvedic_medicine_blog_post_page_image_box_shadow).'px #cccccc;';
    $ayurvedic_medicine_color_scheme_css .='}';
}       

/*--------------------------- Single Post Page Image Box Shadow -------------------*/

$ayurvedic_medicine_single_post_page_image_box_shadow = get_theme_mod('ayurvedic_medicine_single_post_page_image_box_shadow',0);
if($ayurvedic_medicine_single_post_page_image_box_shadow != false){
    $ayurvedic_medicine_color_scheme_css .='.single-post img{';
        $ayurvedic_medicine_color_scheme_css .='box-shadow: '.esc_attr($ayurvedic_medicine_single_post_page_image_box_shadow).'px '.esc_attr($ayurvedic_medicine_single_post_page_image_box_shadow).'px '.esc_attr($ayurvedic_medicine_single_post_page_image_box_shadow).'px #cccccc;';
    $ayurvedic_medicine_color_scheme_css .='}';
}  

/*--------------------------- Shop page pagination -------------------*/

$ayurvedic_medicine_wooproducts_nav = get_theme_mod('ayurvedic_medicine_wooproducts_nav', 'Yes');
if($ayurvedic_medicine_wooproducts_nav == 'No'){
  $ayurvedic_medicine_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
    $ayurvedic_medicine_color_scheme_css .='display: none;';
  $ayurvedic_medicine_color_scheme_css .='}';
}

/*--------------------------- Related Product -------------------*/

$ayurvedic_medicine_related_product_enable = get_theme_mod('ayurvedic_medicine_related_product_enable',true);
if($ayurvedic_medicine_related_product_enable == false){
  $ayurvedic_medicine_color_scheme_css .='.related.products{';
    $ayurvedic_medicine_color_scheme_css .='display: none;';
  $ayurvedic_medicine_color_scheme_css .='}';
}

/*--------------------------- Scroll to Top Button Shape -------------------*/

	$ayurvedic_medicine_scroll_top_shape = get_theme_mod('ayurvedic_medicine_scroll_top_shape', 'circle');
	if($ayurvedic_medicine_scroll_top_shape == 'box' ){
		$ayurvedic_medicine_color_scheme_css .='#button{';
			$ayurvedic_medicine_color_scheme_css .=' border-radius: 0%';
		$ayurvedic_medicine_color_scheme_css .='}';
	}elseif($ayurvedic_medicine_scroll_top_shape == 'curved' ){
		$ayurvedic_medicine_color_scheme_css .='#button{';
			$ayurvedic_medicine_color_scheme_css .=' border-radius: 20%';
		$ayurvedic_medicine_color_scheme_css .='}';
	}elseif($ayurvedic_medicine_scroll_top_shape == 'circle' ){
		$ayurvedic_medicine_color_scheme_css .='#button{';
			$ayurvedic_medicine_color_scheme_css .=' border-radius: 50%;';
		$ayurvedic_medicine_color_scheme_css .='}';
	}