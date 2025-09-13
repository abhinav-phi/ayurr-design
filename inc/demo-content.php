<div class="theme-offer">
   <?php
     // POST and update the customizer and other related data of Ayurvedic Medicine
    if ( isset( $_POST['submit'] ) ) {

        // Check if woocommerce is installed and activated
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
            // Install the plugin if it doesn't exist
            $ayurvedic_medicine_plugin_slug = 'woocommerce';
            $ayurvedic_medicine_plugin_file = 'woocommerce/woocommerce.php';

            // Check if plugin is installed
            $ayurvedic_medicine_installed_plugins = get_plugins();
            if (!isset($ayurvedic_medicine_installed_plugins[$ayurvedic_medicine_plugin_file])) {
                include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
                include_once(ABSPATH . 'wp-admin/includes/file.php');
                include_once(ABSPATH . 'wp-admin/includes/misc.php');
                include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

                // Install the plugin
                $ayurvedic_medicine_upgrader = new Plugin_Upgrader();
                $ayurvedic_medicine_upgrader->install('https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip');
            }
            // Activate the plugin
            activate_plugin($ayurvedic_medicine_plugin_file);
        }

        // Check if Classic Blog Grid plugin is installed
        if (!is_plugin_active('classic-blog-grid/classic-blog-grid.php')) {
            // Plugin slug and file path for Classic Blog Grid
            $ayurvedic_medicine_plugin_slug = 'classic-blog-grid';
            $ayurvedic_medicine_plugin_file = 'classic-blog-grid/classic-blog-grid.php';
        
            // Check if Classic Blog Grid is installed and activated
            if ( ! is_plugin_active( $ayurvedic_medicine_plugin_file ) ) {
        
                // Check if Classic Blog Grid is installed
                $ayurvedic_medicine_installed_plugins = get_plugins();
                if ( ! isset( $ayurvedic_medicine_installed_plugins[ $ayurvedic_medicine_plugin_file ] ) ) {
        
                    // Include necessary files to install plugins
                    include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
                    include_once( ABSPATH . 'wp-admin/includes/file.php' );
                    include_once( ABSPATH . 'wp-admin/includes/misc.php' );
                    include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
        
                    // Download and install Classic Blog Grid
                    $ayurvedic_medicine_upgrader = new Plugin_Upgrader();
                    $ayurvedic_medicine_upgrader->install( 'https://downloads.wordpress.org/plugin/classic-blog-grid.latest-stable.zip' );
                }
        
                // Activate the Classic Blog Grid plugin after installation (if needed)
                activate_plugin( $ayurvedic_medicine_plugin_file );
            }
        }

        // ------- Create Main Menu --------
        $ayurvedic_medicine_menuname = 'Primary Menu'; 
        $ayurvedic_medicine_bpmenulocation = 'primary';
        $ayurvedic_medicine_menu_exists = wp_get_nav_menu_object($ayurvedic_medicine_menuname);

        if (!$ayurvedic_medicine_menu_exists) {
            // Create a new menu
            $ayurvedic_medicine_menu_id = wp_create_nav_menu($ayurvedic_medicine_menuname);

            // Define pages to be created
            $ayurvedic_medicine_pages = array(
                'home' => array(
                    'title' => 'Home',
                    'template' => '/templates/template-home-page.php'
                ),
                'shop' => array(
                    'title' => 'Shop',
                    'content' => '[products]' // Shortcode for products
                ),
                'blog' => array(
                    'title' => 'Blog',
                    'content' => ''
                ),
                'about-us' => array(
                    'title' => 'About Us',
                    'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
                ),
                'pages' => array(
                    'title' => 'Pages',
                    'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
                ),
            );

            $ayurvedic_medicine_page_ids = array();

            // Loop through the pages and create them if they don’t exist
            foreach ($ayurvedic_medicine_pages as $ayurvedic_medicine_slug => $ayurvedic_medicine_data) {
                $ayurvedic_medicine_existing_page = get_page_by_path($ayurvedic_medicine_slug);

                if ($ayurvedic_medicine_existing_page) {
                    // If the page already exists, use its ID
                    $ayurvedic_medicine_page_id = $ayurvedic_medicine_existing_page->ID;
                } else {
                    // Create a new page
                    $ayurvedic_medicine_page_data = array(
                        'post_type'    => 'page',
                        'post_title'   => $ayurvedic_medicine_data['title'],
                        'post_content' => isset($ayurvedic_medicine_data['content']) ? $ayurvedic_medicine_data['content'] : '',
                        'post_status'  => 'publish',
                        'post_author'  => get_current_user_id(), // Set author dynamically
                        'post_name'    => $ayurvedic_medicine_slug,
                    );

                    $ayurvedic_medicine_page_id = wp_insert_post($ayurvedic_medicine_page_data);

                    // Assign custom page template if specified
                    if (!empty($ayurvedic_medicine_data['template'])) {
                        update_post_meta($ayurvedic_medicine_page_id, '_wp_page_template', $ayurvedic_medicine_data['template']);
                    }
                }

                // Store the page IDs
                $ayurvedic_medicine_page_ids[$ayurvedic_medicine_slug] = $ayurvedic_medicine_page_id;
            }

            // Set homepage and blog page
            update_option('page_for_posts', $ayurvedic_medicine_page_ids['blog']);
            update_option('page_on_front', $ayurvedic_medicine_page_ids['home']);
            update_option('show_on_front', 'page');

            // Define menu items
            $ayurvedic_medicine_menu_items = array(
                'home',
                'blog',
                'shop',
                'about-us',
                'pages'
            );

            // Add menu items dynamically
            foreach ($ayurvedic_medicine_menu_items as $ayurvedic_medicine_slug) {
                wp_update_nav_menu_item($ayurvedic_medicine_menu_id, 0, array(
                    'menu-item-title' => esc_html($ayurvedic_medicine_pages[$ayurvedic_medicine_slug]['title']),
                    'menu-item-url' => get_permalink($ayurvedic_medicine_page_ids[$ayurvedic_medicine_slug]),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $ayurvedic_medicine_page_ids[$ayurvedic_medicine_slug],
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type',
                ));
            }

            // Assign menu to theme location
            $ayurvedic_medicine_locations = get_theme_mod('nav_menu_locations', array());
            $ayurvedic_medicine_locations[$ayurvedic_medicine_bpmenulocation] = $ayurvedic_medicine_menu_id;
            set_theme_mod('nav_menu_locations', $ayurvedic_medicine_locations);
        }

        //Logo
        set_theme_mod( 'ayurvedic_medicine_the_custom_logo', esc_url( get_template_directory_uri().'/images/Logo.png'));

        //Banner Section
        set_theme_mod('ayurvedic_medicine_banner', true);
        set_theme_mod('ayurvedic_medicine_button_text', 'Explore more');

                // Function to fetch or create a page using WP_Query
        function get_or_create_page_by_title( $ayurvedic_medicine_page_title, $ayurvedic_medicine_page_content = '' ) {
            $ayurvedic_medicine_args = array(
                'post_type'      => 'page',
                'title'          => $ayurvedic_medicine_page_title,
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'fields'         => 'ids'
            );
            $ayurvedic_medicine_query = new WP_Query( $ayurvedic_medicine_args );

            if ( ! empty( $ayurvedic_medicine_query->posts ) ) {
                return $ayurvedic_medicine_query->posts[0];
            } else {
                // Create the page if it doesn't exist
                $ayurvedic_medicine_page_id = wp_insert_post( array(
                    'post_type'    => 'page',
                    'post_title'   => $ayurvedic_medicine_page_title,
                    'post_content' => $ayurvedic_medicine_page_content,
                    'post_status'  => 'publish',
                    'post_author'  => 1
                ));
                return $ayurvedic_medicine_page_id;
            }
        }

        // Create Page
        $ayurvedic_medicine_page_title = 'Embrace Ayurveda’s Natural Healing.';
        $ayurvedic_medicine_page_content = 'Unlock the secrets of Ayurveda for a balanced and healthy life. Embrace nature’s healing with pure herbal remedies, rejuvenating therapies, and time-tested traditions.';
        $ayurvedic_medicine_page_id = get_or_create_page_by_title( $ayurvedic_medicine_page_title, $ayurvedic_medicine_page_content );

        if ( $ayurvedic_medicine_page_id ) {
            set_theme_mod( 'ayurvedic_medicine_banner_pageboxes', $ayurvedic_medicine_page_id );
        } else {
            error_log('Failed to create or fetch the "Welcome to Corporate Business Theme" page.');
        }

        $ayurvedic_medicine_image_url = get_template_directory_uri().'/images/about.png';
        $ayurvedic_medicine_image_id = media_sideload_image($ayurvedic_medicine_image_url, $ayurvedic_medicine_page_id, null, 'id');
        if (!is_wp_error($ayurvedic_medicine_image_id)) {
            // Set the downloaded image as the post's featured image
            set_post_thumbnail($ayurvedic_medicine_page_id, $ayurvedic_medicine_image_id);
        }     

        //Product Section
        set_theme_mod( 'ayurvedic_medicine_disabled_deal_section', true);
        set_theme_mod( 'ayurvedic_medicine_deal_sec_title', 'Today’s Deal');
        set_theme_mod( 'ayurvedic_medicine_deal_sec_text', 'Shop authentic Ayurvedic products for holistic wellness today!');

        // Set the theme mod for the product category
        set_theme_mod('ayurvedic_medicine_products_cat', 'productcategory1');

        // Define the single product category name, product titles, and tags
        $ayurvedic_medicine_category_name = 'productcategory1';
        $ayurvedic_medicine_titles = array(
            "Gokshura Capsules",
            "Arjuna Powder",
            "Dashmool Powder",
            "Shilajit Resin",
            "Jatamansi Oil"
        );

        // Create or retrieve the product category term ID
        $ayurvedic_medicine_term = term_exists($ayurvedic_medicine_category_name, 'product_cat');
        if (!$ayurvedic_medicine_term) {
            $ayurvedic_medicine_term = wp_insert_term($ayurvedic_medicine_category_name, 'product_cat');
        }

        if (is_wp_error($ayurvedic_medicine_term)) {
            error_log('Error creating category: ' . $ayurvedic_medicine_term->get_error_message());
            return; // Exit if category creation fails
        }

        $ayurvedic_medicine_term_id = is_array($ayurvedic_medicine_term) ? $ayurvedic_medicine_term['term_id'] : $ayurvedic_medicine_term;

        // Loop to create 5 products for the category
        foreach ($ayurvedic_medicine_titles as $ayurvedic_medicine_index => $ayurvedic_medicine_title) {
            // Create product content
            $ayurvedic_medicine_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';

            // Create product post object
            $ayurvedic_medicine_post_id = wp_insert_post(array(
                'post_title'    => wp_strip_all_tags($ayurvedic_medicine_title),
                'post_content'  => $ayurvedic_medicine_content,
                'post_status'   => 'publish',
                'post_type'     => 'product', // Post type set to 'product'
            ));

            if (is_wp_error($ayurvedic_medicine_post_id)) {
                error_log('Error creating product: ' . $ayurvedic_medicine_post_id->get_error_message());
                continue; // Skip to the next product if creation fails
            }

            // Assign the category to the product
            wp_set_object_terms($ayurvedic_medicine_post_id, $ayurvedic_medicine_term_id, 'product_cat');

            // Set product price and sale price
            update_post_meta($ayurvedic_medicine_post_id, '_regular_price', '39.99'); // Regular price
            update_post_meta($ayurvedic_medicine_post_id, '_sale_price', '29.99'); // Sale price 
            update_post_meta($ayurvedic_medicine_post_id, '_price', '29.99'); // Active price

            // Handle the featured image using media_sideload_image
            $ayurvedic_medicine_image_url = get_template_directory_uri() . '/images/Product' . ($ayurvedic_medicine_index + 1) . '.png';
            $ayurvedic_medicine_image_id = media_sideload_image($ayurvedic_medicine_image_url, $ayurvedic_medicine_post_id, null, 'id');

            if (!is_wp_error($ayurvedic_medicine_image_id)) {
                // Assign featured image to product
                set_post_thumbnail($ayurvedic_medicine_post_id, $ayurvedic_medicine_image_id);
            } else {
                error_log('Error downloading image for product: ' . $ayurvedic_medicine_image_id->get_error_message());
            }
        }
        set_theme_mod( 'ayurvedic_medicine_product_clock_timer_end', 'July 12 2026 03:00:00');
    
        // Show success message and the "View Site" button
         echo '<div class="success">Demo Import Successful</div>';
    }
     ?>
    <ul>
        <li>
        <hr>
        <?php 
        // Check if the form is submitted
        if ( !isset( $_POST['submit'] ) ) : ?>
            <!-- Show demo importer form only if it's not submitted -->
            <?php echo esc_html( 'Click on the below content to get demo content installed.', 'ayurvedic-medicine' ); ?>
             <br>
             <small><b><?php echo esc_html('Please take a backup if your website is already live with data. This importer will overwrite existing data.', 'ayurvedic-medicine' ); ?></b></small>
             <br><br>
             <form id="demo-importer-form" action="" method="POST" onsubmit="return runDemoImport();">
             <input type="submit" name="submit" value="<?php echo esc_attr('Run Importer','ayurvedic-medicine'); ?>" class="button button-primary button-large">
             </form>
             <script type="text/javascript">
                 function runDemoImport() {
                     if (confirm('Do you really want to do this?')) {
                         document.getElementById('demo-import-loader').style.display = 'block';
                         return true;
                     }
                     return false;
                 }
             </script>
         <?php 
        endif; 

        // Show "View Site" button after form submission
        if ( isset( $_POST['submit'] ) ) {
        echo '<div class="view-site-btn">';
        echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
        echo '<a href="' . esc_url( admin_url('customize.php') ) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">Customize Demo Content</a>';
        echo '</div>';
        }
        ?>

        <hr>
        </li>
    </ul>
 </div>