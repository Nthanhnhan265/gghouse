<?php

/**
 * Fastest Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fastest-shop
 */
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/theme-core.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/class/class-header.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/class/class-body.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/class/class-footer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/class/class-template-tags.php';
require get_template_directory() . '/inc/class/class-post-related.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * TGM Plugins
 */
require get_template_directory() . '/inc/tgm/recommended-plugins.php';

require get_template_directory() . '/inc/customizer/customizer.php';


/**
 * Implement pro features.
 */
require get_template_directory() . '/inc/admin/admin-page.php';

if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}




// Include file quản lý quảng cáo
require_once get_template_directory() . '/ad-management.php';


function enqueue_ad_styles()
{
	wp_enqueue_style('ad-styles', get_template_directory_uri() . '/ad-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_ad_styles');


function ad_popup_script()
{
?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const popup = document.getElementById('ad-popup');
			const closeBtn = document.createElement('span');
			closeBtn.innerHTML = '&times;';
			closeBtn.classList.add('ad-popup-close');

			closeBtn.addEventListener('click', function() {
				popup.classList.remove('show');
			});

			if (popup) {
				popup.appendChild(closeBtn);

				// Hiển thị popup sau 5 giây
				setTimeout(() => {
					popup.classList.add('show');
				}, 5000);
			}
		});
	</script>
<?php
}
add_action('wp_footer', 'ad_popup_script');

function ad_click_tracking_script()
{
?>
	<script>
		function trackAdClick(adId) {
			// Gửi request tracking click
			fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'action=track_ad_click&ad_id=' + adId
			});
		}
	</script>
<?php
}
add_action('wp_footer', 'ad_click_tracking_script');

// Xử lý AJAX tracking
function handle_ad_click_tracking()
{
	if (isset($_POST['ad_id'])) {
		$ad_id = intval($_POST['ad_id']);
		$click_count = get_post_meta($ad_id, 'ad_click_count', true);
		$click_count = $click_count ? $click_count + 1 : 1;
		update_post_meta($ad_id, 'ad_click_count', $click_count);
		wp_send_json_success();
	}
	wp_send_json_error();
}
add_action('wp_ajax_track_ad_click', 'handle_ad_click_tracking');
add_action('wp_ajax_nopriv_track_ad_click', 'handle_ad_click_tracking');

// Thêm cột thống kê click trong admin
function add_ad_click_column($columns)
{
	$columns['ad_click_count'] = 'Số Lần Click';
	return $columns;
}
add_filter('manage_ads_manager_posts_columns', 'add_ad_click_column');

function display_ad_click_count($column, $post_id)
{
	if ($column == 'ad_click_count') {
		$click_count = get_post_meta($post_id, 'ad_click_count', true);
		echo $click_count ? $click_count : 0;
	}
}
add_action('manage_ads_manager_posts_custom_column', 'display_ad_click_count', 10, 2);

function fastest_shop_product_social_share()
{
	global $post;

	// Lấy URL và tiêu đề sản phẩm
	$share_url = get_permalink($post->ID);
	$share_title = get_the_title($post->ID);

	// Các nền tảng mạng xã hội
	$facebook_share = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($share_url);
	$twitter_share = 'https://twitter.com/intent/tweet?url=' . urlencode($share_url) . '&text=' . urlencode($share_title);
	$linkedin_share = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($share_url) . '&title=' . urlencode($share_title);

	echo '<div class="product-social-share">';
	echo '<span class="share-label">' . esc_html__('Share:', 'fastest-shop') . '</span>';
	echo '<ul class="social-share-icons">';
	echo '<li><a href="' . esc_url($facebook_share) . '" target="_blank"><i class="icofont-facebook"></i></a></li>';
	echo '<li><a href="' . esc_url($twitter_share) . '" target="_blank"><i class="icofont-twitter"></i></a></li>';
	echo '<li><a href="' . esc_url($linkedin_share) . '" target="_blank"><i class="icofont-linkedin"></i></a></li>';
	echo '</ul>';
	echo '</div>';
}
add_action('woocommerce_single_product_summary', 'fastest_shop_product_social_share', 50);
