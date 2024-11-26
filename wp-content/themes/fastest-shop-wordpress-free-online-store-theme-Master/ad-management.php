<?php

/**
 * Advanced WordPress Ad Management for E-commerce
 * Hệ thống quản lý quảng cáo chuyên nghiệp
 */

// 1. Nâng cấp Custom Post Type cho Quảng Cáo
function create_advanced_ad_post_type()
{
    register_post_type(
        'ads_manager',
        array(
            'labels' => array(
                'name' => __('Quảng Cáo'),
                'singular_name' => __('Quảng Cáo'),
                'add_new' => __('Thêm Quảng Cáo Mới'),
                'edit_item' => __('Chỉnh Sửa Quảng Cáo')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'custom-fields'
            ),
            'menu_icon' => 'dashicons-megaphone',
            'hierarchical' => false,
            'show_in_rest' => true  // Tích hợp với Gutenberg
        )
    );
}
add_action('init', 'create_advanced_ad_post_type');

// 2. Nâng cấp Meta Box với nhiều tùy chọn chi tiết
function add_comprehensive_ad_meta_boxes()
{
    add_meta_box(
        'ad_advanced_settings',
        'Cài Đặt Quảng Cáo Chi Tiết',
        'render_advanced_ad_settings',
        'ads_manager',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_comprehensive_ad_meta_boxes');

function render_advanced_ad_settings($post)
{
    wp_nonce_field('ad_settings_nonce', 'ad_settings_nonce');

    $ad_position = get_post_meta($post->ID, 'ad_position', true);
    $ad_expiry = get_post_meta($post->ID, 'ad_expiry', true);
    $ad_priority = get_post_meta($post->ID, 'ad_priority', true);
    $ad_target_url = get_post_meta($post->ID, 'ad_target_url', true);
    $ad_device_type = get_post_meta($post->ID, 'ad_device_type', true);
?>
    <div class="ad-settings-container">
        <table class="form-table">
            <tr>
                <th><label>Vị trí hiển thị:</label></th>
                <td>
                    <select name="ad_position" class="widefat">
                        <option value="top" <?php selected($ad_position, 'top'); ?>>Đầu bài viết</option>
                        <option value="bottom" <?php selected($ad_position, 'bottom'); ?>>Cuối bài viết</option>
                        <option value="after_paragraph" <?php selected($ad_position, 'after_paragraph'); ?>>Sau đoạn văn</option>
                        <option value="sidebar" <?php selected($ad_position, 'sidebar'); ?>>Sidebar</option>
                        <option value="popup" <?php selected($ad_position, 'popup'); ?>>Popup</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label>Ngày hết hạn:</label></th>
                <td>
                    <input type="date" name="ad_expiry" value="<?php echo esc_attr($ad_expiry); ?>" class="widefat">
                </td>
            </tr>
            <tr>
                <th><label>Độ ưu tiên:</label></th>
                <td>
                    <select name="ad_priority" class="widefat">
                        <option value="low" <?php selected($ad_priority, 'low'); ?>>Thấp</option>
                        <option value="medium" <?php selected($ad_priority, 'medium'); ?>>Trung bình</option>
                        <option value="high" <?php selected($ad_priority, 'high'); ?>>Cao</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label>Đường dẫn đích:</label></th>
                <td>
                    <input type="url" name="ad_target_url" value="<?php echo esc_url($ad_target_url); ?>" class="widefat" placeholder="https://example.com">
                </td>
            </tr>
            <tr>
                <th><label>Thiết bị mục tiêu:</label></th>
                <td>
                    <select name="ad_device_type[]" multiple class="widefat">
                        <option value="desktop" <?php echo in_array('desktop', (array)$ad_device_type) ? 'selected' : ''; ?>>Máy tính</option>
                        <option value="mobile" <?php echo in_array('mobile', (array)$ad_device_type) ? 'selected' : ''; ?>>Điện thoại</option>
                        <option value="tablet" <?php echo in_array('tablet', (array)$ad_device_type) ? 'selected' : ''; ?>>Máy tính bảng</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
<?php
}

// 3. Lưu và xác thực Meta Box Data
function save_advanced_ad_meta($post_id)
{
    // Kiểm tra nonce để bảo mật
    if (
        !isset($_POST['ad_settings_nonce']) ||
        !wp_verify_nonce($_POST['ad_settings_nonce'], 'ad_settings_nonce')
    ) {
        return;
    }

    // Kiểm tra quyền người dùng
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Lưu các trường meta
    $meta_fields = [
        'ad_position',
        'ad_expiry',
        'ad_priority',
        'ad_target_url',
        'ad_device_type'
    ];

    foreach ($meta_fields as $field) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta($post_id, $field, $_POST[$field]);
        }
    }
}
add_action('save_post_ads_manager', 'save_advanced_ad_meta');

// 4. Hiển thị quảng cáo thông minh
function display_smart_ads($content)
{
    if (!is_single()) return $content;

    // Lấy thiết bị người dùng
    $device_type = wp_is_mobile() ? 'mobile' : 'desktop';

    $ads = get_posts(array(
        'post_type' => 'ads_manager',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'ad_expiry',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE'
            ),
            array(
                'key' => 'ad_device_type',
                'value' => $device_type,
                'compare' => 'LIKE'
            )
        )
    ));

    foreach ($ads as $ad) {
        $position = get_post_meta($ad->ID, 'ad_position', true);
        $ad_content = sprintf(
            '<div class="custom-ad-container" data-ad-id="%d">
                <div class="ad-content">
                    %s
                    <div class="ad-content-text">
                        <h3>%s</h3>
                        <p>%s</p>
                        <a href="%s" class="ad-cta-button" onclick="trackAdClick(%d)">Xem Ngay</a>
                    </div>
                </div>
            </div>',
            $ad->ID,
            get_the_post_thumbnail($ad->ID, 'medium'), // Ảnh đại diện
            $ad->post_title, // Tiêu đề quảng cáo
            wp_trim_words($ad->post_content, 20), // Mô tả ngắn
            get_post_meta($ad->ID, 'ad_target_url', true) ?: get_permalink($ad->ID), // Ưu tiên link mục tiêu, nếu không có thì dùng link bài viết
            $ad->ID
        );

        switch ($position) {
            case 'top':
                $content = $ad_content . $content;
                break;
            case 'bottom':
                $content .= $ad_content;
                break;
            case 'after_paragraph':
                $content = insert_smart_ad_paragraph($ad_content, $content);
                break;
            case 'sidebar':
                // Tích hợp với hook sidebar của theme
                add_action('fastest-shop-wordpress-free-online-store-theme-Master', function () use ($ad_content) {
                    echo $ad_content;
                });
                break;
            case 'popup':
                add_action('wp_footer', function () use ($ad_content) {
                    echo '<div id="ad-popup" class="ad-popup">' . $ad_content . '</div>';
                });
                break;
        }
    }

    return $content;
}
add_filter('the_content', 'display_smart_ads');

// 5. Chèn quảng cáo thông minh hơn
function insert_smart_ad_paragraph($ad_insertion, $content, $paragraph_id = 3)
{
    $closing_p = '</p>';
    $paragraphs = explode($closing_p, $content);

    if (count($paragraphs) > $paragraph_id) {
        $paragraphs[$paragraph_id] .= $ad_insertion;
    }

    return implode($closing_p, $paragraphs);
}

// 6. Theo dõi và thống kê lượt click quảng cáo
function track_ad_clicks()
{
    if (isset($_GET['ad_click']) && is_numeric($_GET['ad_click'])) {
        $ad_id = intval($_GET['ad_click']);
        $click_count = get_post_meta($ad_id, 'ad_click_count', true);
        $click_count = $click_count ? $click_count + 1 : 1;
        update_post_meta($ad_id, 'ad_click_count', $click_count);
    }
}
add_action('init', 'track_ad_clicks');
