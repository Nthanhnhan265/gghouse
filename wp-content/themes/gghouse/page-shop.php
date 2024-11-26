<!-- Use vietnamese for the code above, re-write it down below -->
<?php
get_header();
?>

<!-- Phần 1: Banner -->
<section id="banner" style="background-color: #4CAF50; color: white; text-align: center; background: url(<?php echo (get_theme_file_uri() . "/asset/images/shop-cay-canh-mini-khong-trong-dat-9x-garden-1") ?>); background-position: center;">
    <div style="width: 100%; height:100%; backdrop-filter: blur(5px) brightness(0.65);">
        <h1 style="font-size: 48px; font-weight: bold;">Green Garden House</h1>
        <p style="font-size: 20px; font-weight: 300; margin-top: 10px;">Cửa hàng một điểm đến cho mọi nhu cầu làm vườn của bạn! Cây cảnh, dụng cụ và đồ trang trí đẹp mắt được giao tận nhà.</p>
    </div>
</section>

<!-- Phần 2: Danh mục -->
<section id="categories" style="padding: 20px 20px; background-color: #f9f9f9;">
    <h2 style="text-align: center; font-size: 30px; font-weight: 100; margin-bottom: 20px; text-transform: uppercase">Danh mục</h2>
    <div class="category-container" style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 20px;">

        <?php
        // Lấy danh mục sản phẩm của WooCommerce
        $args = array(
            'taxonomy'   => 'product_cat',
            'orderby'    => 'name',
            'hide_empty' => false, // Loại trừ các danh mục trống
        );
        $terms = get_terms($args);

        if ($terms) {
            foreach ($terms as $term) {
                if ($term->slug !== 'uncategorized') {
                    // Lấy hình ảnh của danh mục
                    $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    echo '<div class="category" style="flex: 1 1 250px; text-align: center; max-width: 300px;">';
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($term->name) . '" style="width: 100%; height: auto; margin-bottom: 10px;"/>';
                    echo '<h3 style="font-size: 14px; font-weight: 200; text-transform:uppercase; margin-bottom: 25px;">' . esc_html($term->name) . '</h3>';
                    echo '<a href="' . esc_url(get_term_link($term)) . '" class="btn btn-primary" style="background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; opacity: 70%;">Xem thêm</a>';
                    echo '</div>';
                }
            }
        } else {
            echo '<p>Không có danh mục sản phẩm nào.</p>';
        }
        ?>

    </div>
</section>

<!-- Phần 3: Sản phẩm nổi bật -->
<section id="featured-products" style="padding: 20px 20px;">
    <h2 style="text-align: center; font-size: 30px; font-weight: 100; text-transform:uppercase; margin-bottom: 40px;opacity: .7;">Sản phẩm nổi bật</h2>
    <div class="product-container" style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 20px;">
        <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 6,
            'tax_query' => array( // Sử dụng 'tax_query' thay vì 'meta_query'
                array(
                    'taxonomy' => 'product_visibility', // Taxonomy của WooCommerce cho hiển thị sản phẩm
                    'field'    => 'name',
                    'terms'    => 'featured', // Term 'featured' dùng để đánh dấu sản phẩm nổi bật
                ),
            ),
        );


        $featured_products = new WP_Query($args);

        if ($featured_products->have_posts()) {
            while ($featured_products->have_posts()) {
                $featured_products->the_post();
                global $product;
        ?>


                <div class="product-item">
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?>
                    <a href="<?php echo get_permalink(); ?>" class="product-image-link">
                        <div class="add-to-cart-hover">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>
                    </a>
                    <h3><a href="<?php echo get_permalink(); ?>" style="font-size: 1rem; text-align: left; font-weight: 200; text-transform:uppercase; margin-bottom: 25px;"><?php the_title(); ?></a></h3>
                    <p class="price"><?php echo $product->get_price_html(); ?></p>
                    <a href="<?php echo get_permalink(); ?>" class="view-more">Xem thêm</a>
                </div>

        <?php
            }
        } else {
            echo '<p>Không có sản phẩm nổi bật nào.</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
</section>
<!-- Phần 4: Sản phẩm sale -->

<section id="sale-products" style="padding: 60px 20px; margin: 60px 0">
    <h2 style="text-align: center; font-size: 36px; font-weight: 100; text-transform: uppercase; opacity: .7; margin-bottom: 40px;">Sản phẩm khuyến mãi</h2>

    <!-- Banner sale -->
    <div style="text-align: center; margin-bottom: 40px;">
    </div>

    <div class="product-container" style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 20px;">
        <?php
        // Lấy sản phẩm đang sale
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 6, // Số lượng sản phẩm muốn hiển thị
            'meta_query'     => array(
                'relation' => 'OR',
                array(
                    'key'     => '_sale_price',
                    'value'   => '',
                    'compare' => '!=',
                ),
                array(
                    'key'     => '_sale_price_dates_from',
                    'value'   => time(),
                    'compare' => '<=',
                    'type'    => 'NUMERIC',
                ),
                array(
                    'key'     => '_sale_price_dates_to',
                    'value'   => time(),
                    'compare' => '>=',
                    'type'    => 'NUMERIC',
                ),
            ),
        );
        $sale_products = new WP_Query($args);

        if ($sale_products->have_posts()) {
            while ($sale_products->have_posts()) {
                $sale_products->the_post();
                global $product;
                $regular_price = (float) $product->get_regular_price();
                $sale_price = (float) $product->get_sale_price();

                // Tính phần trăm giảm giá
                if ($regular_price > 0 && $sale_price > 0) {
                    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                }
        ?>
                <div class="product-item" style="position: relative;">
                    <!-- Hiển thị nhãn On Sale nếu sản phẩm đang giảm giá -->
                    <?php if ($product->is_on_sale()) { ?>
                        <span style="position: absolute; top: 10px; left: 10px; background-color: red; color: white; padding: 5px 10px; font-size: 0.8rem;">
                            On Sale -<?php echo $discount_percentage; ?>%
                        </span>
                    <?php } ?>
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?>

                    <h3><a href="<?php echo get_permalink(); ?>" style="font-size: 1rem; text-align: left; font-weight: 200; text-transform:uppercase; margin-bottom: 25px;"><?php the_title(); ?></a></h3>
                    <div class="" style="display: flex;justify-content: space-between; align-items: center; ">

                        <p class="price">
                            <!-- Phần trăm giảm giá -->
                            <?php if (isset($discount_percentage)) { ?>
                                <span style=" background-color:yellow; color:red; padding: 5px 10px; width: 30px;  font-size: 0.8rem;">
                                    -<?php echo $discount_percentage; ?>%
                                </span>
                                <?php } ?><?php echo $product->get_price_html(); ?>

                        </p>
                        <a href="<?php echo get_permalink(); ?>" class="view-more" style="opacity:.9; background: rgb(173,223,173);
background: linear-gradient(159deg, rgba(173,223,173,1) 0%, rgba(50,205,50,1) 100%);">Xem thêm</a>
                    </div>
                </div>

        <?php
            }
        } else {
            echo '<p>Không có sản phẩm khuyến mãi nào.</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
</section>

<?php
get_footer();
?><!-- ... (Your existing code for banner, categories, featured products) ... -->

<!-- ... (Your existing code for testimonials and get_footer()) ... -->