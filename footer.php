<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Ayurvedic Medicine
 */
?>
<div id="footer">
  <?php 
    $ayurvedic_medicine_footer_widget_enabled = get_theme_mod('ayurvedic_medicine_footer_widget', true);
    if ($ayurvedic_medicine_footer_widget_enabled !== false && $ayurvedic_medicine_footer_widget_enabled !== '') { ?>
    <?php 
        $ayurvedic_medicine_widget_areas = get_theme_mod('ayurvedic_medicine_footer_widget_areas', '4');
        if ($ayurvedic_medicine_widget_areas == '3') {
            $ayurvedic_medicine_cols = 'col-lg-4 col-md-6';
        } elseif ($ayurvedic_medicine_widget_areas == '4') {
            $ayurvedic_medicine_cols = 'col-lg-3 col-md-6';
        } elseif ($ayurvedic_medicine_widget_areas == '2') {
            $ayurvedic_medicine_cols = 'col-lg-6 col-md-6';
        } else {
            $ayurvedic_medicine_cols = 'col-lg-12 col-md-12';
        }
    ?>
    <div class="footer-widget">
        <div class="container">
          <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($ayurvedic_medicine_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'ayurvedic-medicine'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'ayurvedic-medicine'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($ayurvedic_medicine_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'ayurvedic-medicine'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Archives', 'ayurvedic-medicine'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($ayurvedic_medicine_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'ayurvedic-medicine'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Meta', 'ayurvedic-medicine'); ?></h3>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($ayurvedic_medicine_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="search-widget" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'ayurvedic-medicine'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Search', 'ayurvedic-medicine'); ?></h3>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
          </div>
        </div>
    </div>

    <?php } ?>
    <div class="clear"></div>
    <div class="copywrap text-center">
        <?php $ayurvedic_medicine_social_links_present = get_theme_mod('ayurvedic_medicine_footer_facebook_link') || get_theme_mod('ayurvedic_medicine_footer_instagram_link') || get_theme_mod('ayurvedic_medicine_footer_pinterest_link') || get_theme_mod('ayurvedic_medicine_footer_twitter_link') || get_theme_mod('ayurvedic_medicine_footer_youtube_link'); ?>
        <div class="container copywrap-info <?php echo $ayurvedic_medicine_social_links_present ? '' : 'center-content'; ?>">
            <p>
                <a href="<?php 
                $ayurvedic_medicine_copyright_link = get_theme_mod('ayurvedic_medicine_copyright_link', '');
                if (empty($ayurvedic_medicine_copyright_link)) {
                    echo esc_url('https://www.theclassictemplates.com/products/ayurvedic-medicine');
                } else {
                    echo esc_url($ayurvedic_medicine_copyright_link);
                } ?>" target="_blank">
                <?php echo esc_html(get_theme_mod('ayurvedic_medicine_copyright_line', __('Ayurvedic Medicine Wordpress Theme', 'ayurvedic-medicine'))); ?>
                </a> 
                <?php echo esc_html('By Classic Templates', 'ayurvedic-medicine'); ?>
            </p>
            <?php if ( $ayurvedic_medicine_social_links_present ) { ?>
                <div class="footer-social d-flex gap-3">
                    <?php if ( get_theme_mod('ayurvedic_medicine_footer_facebook_link') ) { ?>
                        <a title="<?php echo esc_attr('facebook', 'ayurvedic-medicine'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('ayurvedic_medicine_footer_facebook_link')); ?>"><i class="fa-brands fa-facebook-f"></i></a> 
                    <?php } ?>
                    <?php if ( get_theme_mod('ayurvedic_medicine_footer_instagram_link') ) { ?> 
                        <a title="<?php echo esc_attr('instagram', 'ayurvedic-medicine'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('ayurvedic_medicine_footer_instagram_link')); ?>"><i class="fa-brands fa-instagram"></i></a>
                    <?php } ?>
                    <?php if ( get_theme_mod('ayurvedic_medicine_footer_pinterest_link') ) { ?>
                        <a title="<?php echo esc_attr('pinterest', 'ayurvedic-medicine'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('ayurvedic_medicine_footer_pinterest_link')); ?>"><i class="fa-brands fa-pinterest"></i></a>
                    <?php } ?>
                    <?php if ( get_theme_mod('ayurvedic_medicine_footer_twitter_link') ) { ?> 
                        <a title="<?php echo esc_attr('twitter', 'ayurvedic-medicine'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('ayurvedic_medicine_footer_twitter_link')); ?>"><i class="fa-brands fa-twitter"></i></a>
                    <?php } ?>
                    <?php if ( get_theme_mod('ayurvedic_medicine_footer_youtube_link') ) { ?>
                        <a title="<?php echo esc_attr('youtube', 'ayurvedic-medicine'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('ayurvedic_medicine_footer_youtube_link')); ?>"><i class="fa-brands fa-youtube"></i></a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php if(get_theme_mod('ayurvedic_medicine_scroll_hide',true)){ ?>
    <a id="button"><?php echo esc_html( get_theme_mod('ayurvedic_medicine_scroll_text',__('TOP', 'ayurvedic-medicine' )) ); ?></a>
<?php } ?>
  
<?php wp_footer(); ?>
</body>
</html>
