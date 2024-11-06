<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header( 'shop' );
?>

<div class="cart-page">
    <?php
    woocommerce_cart();
    ?>
</div>

<?php get_footer( 'shop' ); ?>
