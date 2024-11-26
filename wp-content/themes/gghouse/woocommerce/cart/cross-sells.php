<?php
<<<<<<< HEAD
=======

>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

<<<<<<< HEAD
defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) : ?>

	<div class="cross-sells">
		<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
=======
defined('ABSPATH') || exit;

if ($cross_sells) : ?>

	<div class="cross-sells">
		<?php
		$heading = apply_filters('woocommerce_product_cross_sells_products_heading', __('You may be interested in&hellip;', 'woocommerce'));

		if ($heading) :
		?>
			<h2><?php echo esc_html($heading); ?></h2>
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
		<?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

<<<<<<< HEAD
			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>
=======
		<?php foreach ($cross_sells as $cross_sell) : ?>

			<?php
			$post_object = get_post($cross_sell->get_id());

			setup_postdata($GLOBALS['post'] = &$post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

			wc_get_template_part('content', 'product');
			?>

		<?php endforeach; ?>
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b

		<?php woocommerce_product_loop_end(); ?>

	</div>
<<<<<<< HEAD
	<?php
=======
<?php
>>>>>>> c88a009dac2684aff072d10bee91726ed7f3dc4b
endif;

wp_reset_postdata();
