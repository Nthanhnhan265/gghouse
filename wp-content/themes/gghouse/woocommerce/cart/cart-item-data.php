<?php
<<<<<<< HEAD
=======

>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
/**
 * Cart item data (when outputting non-flat)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-item-data.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
<<<<<<< HEAD
 * maintain compatibility. We try to do this as little as possible, but it does
=======
 * maintain c																																																mpatibility. We try to do this as little as possible, but it does
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.4.0
 */
<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) {
=======
if (! defined('ABSPATH')) {
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
	exit;
}
?>
<dl class="variation">
<<<<<<< HEAD
	<?php foreach ( $item_data as $data ) : ?>
		<dt class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo wp_kses_post( $data['key'] ); ?>:</dt>
		<dd class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo wp_kses_post( wpautop( $data['display'] ) ); ?></dd>
	<?php endforeach; ?>
</dl>
=======
	test
	<?php foreach ($item_data as $data) : ?>
		<dt class="<?php echo sanitize_html_class('variation-' . $data['key']); ?>"><?php echo wp_kses_post($data['key']); ?>:</dt>
		<dd class="<?php echo sanitize_html_class('variation-' . $data['key']); ?>"><?php echo wp_kses_post(wpautop($data['display'])); ?></dd>
	<?php endforeach; ?>
</dl>
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
