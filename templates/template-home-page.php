<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Ayurvedic Medicine
 */

get_header(); ?>

<div id="content" >
    <?php
        $ayurvedic_medicine_banner = get_theme_mod('ayurvedic_medicine_banner', false);
        $ayurvedic_medicine_banner_pageboxes = get_theme_mod('ayurvedic_medicine_banner_pageboxes', false);

        if ($ayurvedic_medicine_banner && $ayurvedic_medicine_banner_pageboxes) { ?>
        <section id="banner-cat" class="position-relative pb-4">
            <?php
            $ayurvedic_medicine_querymed = new WP_Query(array(
                'page_id' => esc_attr($ayurvedic_medicine_banner_pageboxes)
            ));
            while ($ayurvedic_medicine_querymed->have_posts()) : $ayurvedic_medicine_querymed->the_post(); ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 align-self-center">
                            <div class="bannerbox">
                                <h1 class="mb-3 text-uppercase banner-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                <?php
                                    $ayurvedic_medicine_trimexcerpt = get_the_excerpt();
                                    $ayurvedic_medicine_shortexcerpt = wp_trim_words($ayurvedic_medicine_trimexcerpt, 38);
                                    echo '<p class="banner-content">' . esc_html($ayurvedic_medicine_shortexcerpt) . '</p>';
                                ?>
                                <div class="bannerbtn mt-4">
                                    <?php
                                        $ayurvedic_medicine_button_text = get_theme_mod('ayurvedic_medicine_button_text', 'Explore more');
                                        $ayurvedic_medicine_button_link_banner = esc_url(get_theme_mod('ayurvedic_medicine_button_link_banner', get_permalink()));
                                        if ($ayurvedic_medicine_button_text || !empty($ayurvedic_medicine_button_link_banner)) { ?>
                                        <?php if ($ayurvedic_medicine_button_text != '') { ?>
                                            <a href="<?php echo esc_url($ayurvedic_medicine_button_link_banner); ?>" class="button">
                                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/btn-img.svg" alt="<?php echo esc_attr('Button Image', 'ayurvedic-medicine'); ?>"/>
                                                <?php echo esc_html($ayurvedic_medicine_button_text); ?>
                                                <span class="screen-reader-text"><?php echo esc_html($ayurvedic_medicine_button_text); ?></span>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 align-self-center text-center banner-img pe-lg-5">
                            <div class="bnr-img-bg position-relative">
                                <?php if (has_post_thumbnail()) { ?>
                                <div class="bnr-img">
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/bnr-img-bg.png" alt="<?php echo esc_attr('Image', 'ayurvedic-medicine'); ?>"/>
                                </div>
                                    <?php the_post_thumbnail('full bnr-inner-img'); ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="leafe1 position-absolute">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/leafe1.png" alt="<?php echo esc_attr('Leafe Image', 'ayurvedic-medicine'); ?>"/>
                </div>
                <div class="leafe2 position-absolute">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/leafe2.png" alt="<?php echo esc_attr('Leafe Image', 'ayurvedic-medicine'); ?>"/>
                </div>
                <div class="leafe3 position-absolute">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/leafe3.png" alt="<?php echo esc_attr('Leafe Image', 'ayurvedic-medicine'); ?>"/>
                </div>
                <div class="leafe4 position-absolute">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/leafe4.png" alt="<?php echo esc_attr('Leafe Image', 'ayurvedic-medicine'); ?>"/>
                </div>
                <div class="leafe5 position-absolute">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/leafe5.png" alt="<?php echo esc_attr('Leafe Image', 'ayurvedic-medicine'); ?>"/>
                </div>
                <div class="leafe6 position-absolute">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/leafe6.png" alt="<?php echo esc_attr('Leafe Image', 'ayurvedic-medicine'); ?>"/>
                </div>
            <?php endwhile;
                wp_reset_postdata();
            ?>
        </section>
    <?php } ?>

    <!-- Products Section -->
    <?php 
    $ayurvedic_medicine_hide_deal_section = get_theme_mod('ayurvedic_medicine_disabled_deal_section', false);
    if ($ayurvedic_medicine_hide_deal_section) { ?>
        <section id="deal-section" class="py-5 position-relative">
            <div class="deals-box mx-5 px-5">
                <div class="heading-box position-relative">
                    <div class="blog-bx mb-4 text-center position-relative">
                        <?php if (get_theme_mod('ayurvedic_medicine_deal_sec_title') != "") { ?>
                            <h2 class="deal-title text-uppercase">
                                <?php echo esc_html(get_theme_mod('ayurvedic_medicine_deal_sec_title')); ?>
                            </h2>
                        <?php } ?>
                        <?php if (get_theme_mod('ayurvedic_medicine_deal_sec_text') != "") { ?>
                            <p class="deal-text">
                                <?php echo esc_html(get_theme_mod('ayurvedic_medicine_deal_sec_text')); ?>
                            </p>
                        <?php } ?>
                    </div>
                    <?php if (get_theme_mod('ayurvedic_medicine_product_clock_timer_end') != "") { ?>
                        <div class="countdowntimer position-absolute">
                            <p id="timer" class="countdown">
                            <?php $ayurvedic_medicine_dateday = get_theme_mod('ayurvedic_medicine_product_clock_timer_end'); ?>
                            <input type="hidden" class="date" value="<?php echo esc_html($ayurvedic_medicine_dateday); ?>"></p>
                        </div>
                    <?php } ?>
                </div>
                <div class="deal-products pt-4 gap-4">
                    <?php 
                        if (class_exists('woocommerce')) {
                            $ayurvedic_medicine_selected_product_category = get_theme_mod('ayurvedic_medicine_products_cat');
                            
                            if ($ayurvedic_medicine_selected_product_category && $ayurvedic_medicine_selected_product_category !== 'select') {
                                $ayurvedic_medicine_args = array(
                                    'post_type' => 'product',
                                    'product_cat' => $ayurvedic_medicine_selected_product_category,
                                    'order' => 'ASC',
                                    'posts_per_page' => 5
                                );
                                $ayurvedic_medicine_loop = new WP_Query($ayurvedic_medicine_args);
                                
                                if ($ayurvedic_medicine_loop->have_posts()) {
                                    while ($ayurvedic_medicine_loop->have_posts()) : $ayurvedic_medicine_loop->the_post(); 
                                        global $product;
                                    ?>
                                    <div class="product-main-box mb-3 text-center">
                                        <div class="product-box position-relative">
                                            
                                            <div class="product-box-img text-center pb-2 mb-2 position-relative">
                                                <?php if (has_post_thumbnail($ayurvedic_medicine_loop->post->ID)) {
                                                    echo get_the_post_thumbnail($ayurvedic_medicine_loop->post->ID, 'shop_catalog', array('class' => 'product-img'));
                                                } else {
                                                    echo '<img class="product-img" src="' . esc_url(woocommerce_placeholder_img_src()) . '" />';
                                                } ?>
                                                <div class="image-bottom-box position-absolute">
                                                    <?php 
                                                        $ayurvedic_medicine_product_categories = get_the_terms( get_the_ID(), 'product_cat' );
                                                        if ( $ayurvedic_medicine_product_categories ) {
                                                        foreach ( $ayurvedic_medicine_product_categories as $ayurvedic_medicine_category ) { echo '<div class="product-cat text-capitalize mb-2"><a href="' . get_term_link( $ayurvedic_medicine_category ) . '">' . $ayurvedic_medicine_category->name . '</a></div>';
                                                    }}?>
                                                    <div class="addcart d-flex justify-content-center position-relative">
                                                        <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_add_to_cart( $ayurvedic_medicine_loop->post, $product ); } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="pro-title text-capitalize mb-1"><a href="<?php echo esc_url(get_permalink($ayurvedic_medicine_loop->post->ID)); ?>"><?php the_title(); ?></a></h3>
                                            <p class="product-price mb-1">
                                                <?php echo $product->get_price_html(); ?>
                                            </p>
                                        </div>
                                        <div class="delivery-text d-flex justify-content-center align-items-center flex-wrap">
                                            <i class="<?php echo esc_attr(get_theme_mod('ayurvedic_medicine_product_delivery_icon', 'fa-solid fa-truck-fast')); ?>"></i><p class="mb-0 ms-2"><?php echo esc_html(get_theme_mod('ayurvedic_medicine_product_delivery_text', 'Delivery by Tomorrow')); ?></p>
                                        </div>
                                    </div>
                                    <?php endwhile; 
                                    wp_reset_postdata();
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
    <?php } ?>
</div>
<?php get_footer(); ?>