<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header( 'shop' );
?>

<div class="checkout-page">
    <?php
    woocommerce_checkout();
    ?>
</div>

<?php get_footer( 'shop' ); ?>
