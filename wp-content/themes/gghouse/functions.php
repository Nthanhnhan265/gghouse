<?php
// Enqueue styles and scripts
function my_theme_enqueue_styles()
{
    wp_enqueue_style('my-theme-style', get_stylesheet_uri() . '/style.css');
    wp_enqueue_script('my-theme-scripts', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Register Navigation Menu
function my_theme_register_menus()
{
    register_nav_menus(array(
        'main-menu' => 'Main Menu',
    ));
}
add_action('after_setup_theme', 'my_theme_register_menus');


function custom_search_orderby($query) {
    if ($query->is_search && !is_admin()) {
        if (isset($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'date':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                case 'views':
                    $query->set('meta_key', 'post_views_count');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;
                default:
                    $query->set('orderby', 'relevance');
            }
        }
               // Lọc theo ngày
               if (isset($_GET['date']) && $_GET['date'] !== '') {
                switch ($_GET['date']) {
                    case 'this_month':
                        $query->set('date_query', array(
                            array(
                                'year'  => date('Y'),
                                'month' => date('m'),
                                'day'   => date('d'),
                                'compare' => '>='
                            )
                        ));
                        break;
                    case 'this_week':
                        $query->set('date_query', array(
                            array(
                                'after' => '1 week ago'
                            )
                        ));
                        break;
                    case 'this_year':
                        $query->set('date_query', array(
                            array(
                                'year' => date('Y'),
                                'compare' => '='
                            )
                        ));
                        break;
                }
            }
        // Lọc theo chuyên mục
        if (isset($_GET['category']) && $_GET['category'] !== '') {
            $query->set('category_name', sanitize_text_field($_GET['category']));
        }

<<<<<<< HEAD


// Đăng ký menu cho footer
function my_theme_register_footer_menu()
{
    register_nav_menus(array(
        'footer-menu' => 'Footer Menu', // Tên của menu
        'footer-bottom-menu' => 'Footer Bottom Menu'
    ));
}
add_action('after_setup_theme', 'my_theme_register_footer_menu');


function enqueue_fontawesome()
{
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_fontawesome');
=======
        // Lọc theo tác giả
        if (isset($_GET['author']) && $_GET['author'] !== '') {
            $query->set('author', intval($_GET['author']));
        }
        
        // Lọc theo độ dài bài viết
        if (isset($_GET['length']) && $_GET['length'] !== '') {
            switch ($_GET['length']) {
                case 'short':
                    $query->set('meta_query', array(
                        array(
                            'key' => 'word_count',
                            'value' => 500,
                            'compare' => '<',
                            'type' => 'NUMERIC'
                        )
                    ));
                    break;
                case 'medium':
                    $query->set('meta_query', array(
                        array(
                            'key' => 'word_count',
                            'value' => array(500, 1000),
                            'compare' => 'BETWEEN',
                            'type' => 'NUMERIC'
                        )
                    ));
                    break;
                case 'long':
                    $query->set('meta_query', array(
                        array(
                            'key' => 'word_count',
                            'value' => 1000,
                            'compare' => '>',
                            'type' => 'NUMERIC'
                        )
                    ));
                    break;
            }
        }
    }
    return $query;
}
add_filter('pre_get_posts', 'custom_search_orderby');



/**
 * Đếm lượt xem cho bài viết
 */
function set_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

/**
 * Lấy số lượt xem của bài viết
 */
function get_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        return "0";
    }
    return $count;
}

/**
 * Tự động đếm lượt xem khi xem bài viết
 */
function track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');

/**
 * Thêm cột lượt xem trong admin
 */
function add_post_views_column($columns) {
    $columns['post_views'] = 'Lượt xem';
    return $columns;
}
add_filter('manage_posts_columns', 'add_post_views_column');

/**
 * Hiển thị số lượt xem trong cột admin
 */
function display_post_views_column($column, $post_id) {
    if ($column === 'post_views') {
        echo get_post_views($post_id) . ' lượt xem';
    }
}
add_action('manage_posts_custom_column', 'display_post_views_column', 10, 2);

/**
 * Cho phép sắp xếp theo lượt xem trong admin
 */
function sort_post_views_column($columns) {
    $columns['post_views'] = 'post_views';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'sort_post_views_column');
// Thêm vào functions.php
function add_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'add_font_awesome');



// Thêm chức năng bài viết liên quan
function get_related_posts($post_id, $number_posts = 3) {
    $categories = get_the_category($post_id);
    if ($categories) {
        $category_ids = array();
        foreach($categories as $individual_category) {
            $category_ids[] = $individual_category->term_id;
        }
        $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array($post_id),
            'posts_per_page' => $number_posts,
            'orderby' => 'rand'
        );
        return new WP_Query($args);
    }
    return false;
}


// Thêm shortcode hiển thị bài viết nổi bật
function featured_posts_shortcode($atts) {
    $atts = shortcode_atts(array(
        'posts' => 3,
    ), $atts);

    $args = array(
        'posts_per_page' => $atts['posts'],
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    );

    $featured_posts = new WP_Query($args);
    
    ob_start();
    if ($featured_posts->have_posts()) : ?>
        <div class="featured-posts">
            <h2>Bài viết nổi bật</h2>
            <div class="featured-posts-grid">
                <?php while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
                    <div class="featured-post-item">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                        </a>
                        <div class="post-meta">
                            <span class="views">👁 <?php echo get_post_views(get_the_ID()); ?> lượt xem</span>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif;
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('featured_posts', 'featured_posts_shortcode');


function custom_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_home() || is_archive() || is_search()) {
            $query->set('posts_per_page', 6); // Số bài viết trên mỗi trang
        }
    }
}
add_action('pre_get_posts', 'custom_posts_per_page');

// Cập nhật thông tin nguời dùng 
function handle_user_info_update() {
    if ( isset($_POST['user_info_nonce']) && wp_verify_nonce($_POST['user_info_nonce'], 'update_user_info') ) {
        // Lấy ID người dùng hiện tại
        $user_id = get_current_user_id();
        
        if ($user_id) {
            // Cập nhật tên
            if (isset($_POST['full_name'])) {
                wp_update_user(array(
                    'ID' => $user_id,
                    'first_name' => sanitize_text_field($_POST['full_name']),
                ));
            }
            
            // Cập nhật email
            if (isset($_POST['user_email'])) {
                wp_update_user(array(
                    'ID' => $user_id,
                    'user_email' => sanitize_email($_POST['user_email']),
                ));
            }

            // Cập nhật số điện thoại
            if (isset($_POST['phone'])) {
                update_user_meta($user_id, 'phone', sanitize_text_field($_POST['phone']));
            }

            // Cập nhật địa chỉ 1
            if (isset($_POST['address_1'])) {
                update_user_meta($user_id, 'address_1', sanitize_text_field($_POST['address_1']));
            }

            // Cập nhật địa chỉ 2
            if (isset($_POST['address_2'])) {
                update_user_meta($user_id, 'address_2', sanitize_text_field($_POST['address_2']));
            }

            // Cập nhật thành phố
            if (isset($_POST['city'])) {
                update_user_meta($user_id, 'city', sanitize_text_field($_POST['city']));
            }

            // Cập nhật mã bưu điện
            if (isset($_POST['postal_code'])) {
                update_user_meta($user_id, 'postal_code', sanitize_text_field($_POST['postal_code']));
            }

            // Redirect sau khi cập nhật thông tin thành công
            wp_redirect(add_query_arg('updated', 'true', get_permalink()));
            exit;
        }
    }

    // Xử lý cập nhật mật khẩu
    if ( isset($_POST['current_password']) && isset($_POST['new_password']) ) {
        $user = wp_get_current_user();
        
        // Kiểm tra mật khẩu hiện tại
        if (wp_check_password($_POST['current_password'], $user->user_pass, $user->ID)) {
            wp_set_password($_POST['new_password'], $user->ID);
            
            // Thông báo mật khẩu đã thay đổi thành công
            wp_redirect(add_query_arg('password_updated', 'true', get_permalink()));
            exit;
        } else {
            // Thông báo lỗi mật khẩu hiện tại không đúng
            echo 'Mật khẩu hiện tại không đúng.';
        }
    }
}
add_action('template_redirect', 'handle_user_info_update');



// Create a new page template for the contact form
add_filter('template_include', 'my_contact_form_template');
function my_contact_form_template($template) {
    if (is_page_template('contact-page.php')) {
        return plugin_dir_path(__FILE__) . 'contact-page.php';
    }
    return $template;
}

// Enqueue the custom CSS and JS files for the contact form
add_action('wp_enqueue_scripts', 'my_contact_form_assets');
function my_contact_form_assets() {
    if (is_page_template('contact-form.php')) {
        wp_enqueue_style('my-contact-form-css', plugin_dir_url(__FILE__) . 'assets/css/contact-form.css');
        wp_enqueue_script('my-contact-form-js', plugin_dir_url(__FILE__) . 'assets/js/contact-form.js', array('jquery'), false, true);
    }
}

// Handle the contact form submission
add_action('admin_post_nopriv_submit_contact_form', 'my_contact_form_submit');
add_action('admin_post_submit_contact_form', 'my_contact_form_submit');
function my_contact_form_submit() {
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);

    $to = '22211tt3830@mail.tdc.edu.vn';
    $subject = 'New Message from Contact Form';
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    if (wp_mail($to, $subject, $body, $headers)) {
        wp_redirect(add_query_arg('success', 'true', get_permalink()));
        exit;
    } else {
        wp_redirect(add_query_arg('success', 'false', get_permalink()));
        exit;
    }
}
?>
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
