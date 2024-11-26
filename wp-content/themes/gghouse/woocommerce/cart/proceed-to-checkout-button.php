<?php
<<<<<<< HEAD
=======

>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) {
=======
if (! defined('ABSPATH')) {
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
	exit; // Exit if accessed directly.
}
?>

<<<<<<< HEAD
<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
	<?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
</a>
=======
<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button button alt wc-forward<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
	<?php esc_html_e('Proceed to checkout', 'woocommerce'); ?>
</a>
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
