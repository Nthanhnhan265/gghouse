<?php
if (! defined('ABSPATH')) {
    exit; // Tránh truy cập trái phép
}

get_header('shop');
?>
<div class="shop-page">
    <?php
    if (have_posts()) :
        woocommerce_product_loop_start();
        while (have_posts()) : the_post();
            wc_get_template_part('content', 'product');
        endwhile;
        woocommerce_product_loop_end();
    else :
        wc_get_template('loop/no-products-found.php');
    endif;
    ?>
</div>

<?php
get_footer('shop');
?>