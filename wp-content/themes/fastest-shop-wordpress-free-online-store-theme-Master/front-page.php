<?php

/**
 * Template Name: Front Page for Plant E-commerce Website
 * Description: Custom front page layout for WooCommerce plant store
 */
get_header();
?>
<style>
    /* CSS Reset và Base Styles */
    :root {
        --primary-color: #2e8b57;
        --secondary-color: #f0f6f0;
        --text-color: #333;
        --white: #ffffff;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        background-color: var(--white);
        color: var(--text-color);
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Responsive Typography */
    h1 {
        font-size: clamp(2rem, 5vw, 2.5rem);
    }

    h2 {
        text-align: center;
        margin-bottom: 2rem;
        color: var(--primary-color);
    }

    /* Hero Section */
    .hero {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        align-items: center;
        padding: 3rem 0;
    }

    .hero-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .hero-image img {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .btn {
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: var(--white);
    }

    .btn-secondary {
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        background-color: transparent;
    }

    /* Product Sections Grid */
    .product-categories,
    .best-sellers,
    .new-products,
    .special-offers {
        padding: 3rem 0;
    }

    .categories-grid,
    .sellers-grid,
    .new-products-grid,
    .offers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .category-item,
    .seller-item,
    .new-product-item,
    .offer-item {
        background-color: var(--white);
        border-radius: 10px;
        padding: 1.25rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .category-item:hover,
    .seller-item:hover,
    .new-product-item:hover {
        transform: scale(1.05);
    }

    .category-item img,
    .seller-item img,
    .new-product-item img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
    }

    .seller-item {
        position: relative;
    }

    .new-product-item {
        position: relative;
    }

    .new-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background-color: var(--primary-color);
        color: var(--white);
        padding: 0.5rem;
        border-radius: 20px;
    }

    .offer-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .offer-image {
        width: 150px;
    }

    .offer-image img {
        width: 100%;
        border-radius: 10px;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {

        .hero,
        .categories-grid,
        .sellers-grid,
        .new-products-grid,
        .offers-grid {
            grid-template-columns: 1fr;
        }

        .hero {
            text-align: center;
        }

        .hero-buttons {
            justify-content: center;
        }

        .offer-item {
            flex-direction: column;
            text-align: center;
        }
    }

    .slick-prev,
    .slick-next {
        background: transparent;
        border: none;
        font-size: 20px;
        color: #333;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
    }

    .slick-prev {
        left: -30px;
    }

    .slick-next {
        right: -30px;
    }

    .slick-prev:hover,
    .slick-next:hover {
        color: #007bff;
    }

    .slick-prev i,
    .slick-next i {
        font-size: 24px;
    }
</style>
</head>

<body>
    <div class="container custom-container">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Vườn Cây Xanh</h1>
                <p>Khám phá vẻ đẹp thiên nhiên với bộ sưu tập cây cảnh độc đáo của chúng tôi. Mỗi cây đều được chăm sóc và nuôi trồng với tình yêu.</p>
                <div class="hero-buttons">
                    <a href="/shop" class="btn btn-primary">Xem Sản Phẩm</a>
                    <a href="/contact" class="btn btn-secondary">Liên Hệ</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://sanvuontrucxinh.com/upload/thiet-ke-san-vuon-dep-me-ly-min.jpg" alt="Cây Cảnh">
            </div>
        </section>

        <!-- Danh Mục Sản Phẩm -->
        <section class="product-categories">
            <h2>Danh Mục Sản Phẩm</h2>
            <div class="categories-slider">
                <?php
                // Lấy danh sách các danh mục sản phẩm
                $categories = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                ]);

                foreach ($categories as $category) {
                    // Lấy ID ảnh đại diện của danh mục
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = wp_get_attachment_url($thumbnail_id);
                    $category_link = get_term_link($category); // Lấy liên kết đến trang danh mục sản phẩm
                ?>
                    <div class="category-item">
                        <a href="<?php echo esc_url($category_link); ?>">
                            <img src="<?php echo esc_url($image_url ?: 'https://via.placeholder.com/200x200'); ?>" alt="<?php echo esc_attr($category->name); ?>">
                            <h3><?php echo esc_html($category->name); ?></h3>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>

        <!-- Sản Phẩm Bán Chạy -->
        <section class="best-sellers">
            <h2>Sản Phẩm Bán Chạy</h2>
            <div class="sellers-grid">
                <?php
                $best_sellers = wc_get_products([
                    'status' => 'publish',
                    'limit' => 6,
                    'orderby' => 'popularity',
                ]);

                foreach ($best_sellers as $product) {
                ?>
                    <div class="seller-item">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id(), 'medium') ?: 'https://via.placeholder.com/400x300'); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" style="border-radius: 50%;">
                        <h3 style="font-size: 1.2em; color: #333; margin: 15px 0;"><?php echo esc_html($product->get_name()); ?></h3>
                        <p style="font-size: 1em; color: #777; margin-bottom: 15px;"><?php echo esc_html(wp_trim_words($product->get_short_description(), 20)); ?></p>
                        <div class="seller-price" style="margin-top: 10px;">
                            <?php if ($product->is_on_sale()) : ?>
                                <span class="price" style="font-size: 1.2em; color: #e74c3c; font-weight: bold; text-decoration: line-through;"><?php echo wc_price($product->get_regular_price()); ?></span>
                                <span class="sale-price" style="font-size: 1.2em; color: #27ae60; font-weight: bold;"><?php echo wc_price($product->get_sale_price()); ?></span>

                                <?php
                                // Tính phần trăm giảm giá
                                $regular_price = $product->get_regular_price();
                                $sale_price = $product->get_sale_price();
                                if ($regular_price > 0) {
                                    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                                    echo '<span class="discount-percentage" style="position: absolute; top: 10px; right: 10px; font-size: 1.2em; color: #f39c12; font-weight: bold; background-color: rgba(0, 0, 0, 0.5); padding: 5px 10px; border-radius: 5px;">-' . $discount_percentage . '%</span>';
                                }
                                ?>
                            <?php else : ?>
                                <span class="price" style="font-size: 1.2em; color: #e74c3c; font-weight: bold;"><?php echo wc_price($product->get_price()); ?></span>
                            <?php endif; ?>
                            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="buy-btn" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #2e8b57   ; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; text-transform: uppercase;">Xem Chi Tiết</a>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </section>

        <!-- Sản Phẩm Mới -->
        <section class="new-products">
            <h2>Sản Phẩm Mới</h2>
            <div class="new-products-grid">
                <?php
                $new_products = wc_get_products([
                    'status' => 'publish',
                    'limit' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ]);

                foreach ($new_products as $product) {
                ?>
                    <div class="new-product-item">
                        <span class="new-badge">Mới</span>
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id(), 'medium') ?: 'https://via.placeholder.com/400x300'); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                        <h3><?php echo esc_html($product->get_name()); ?></h3>
                        <p><?php echo esc_html(wp_trim_words($product->get_short_description(), 20)); ?></p>
                        <div class="seller-price">
                            <?php if ($product->is_on_sale()) : ?>
                                <span class="price" style="font-size: 1.2em; color: #e74c3c; font-weight: bold; text-decoration: line-through;"><?php echo wc_price($product->get_regular_price()); ?></span>
                                <span class="sale-price" style="font-size: 1.2em; color: #27ae60; font-weight: bold;"><?php echo wc_price($product->get_sale_price()); ?></span>

                                <?php
                                // Tính phần trăm giảm giá
                                $regular_price = $product->get_regular_price();
                                $sale_price = $product->get_sale_price();
                                if ($regular_price > 0) {
                                    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                                    echo '<span class="discount-percentage" style="position: absolute; top: 10px; left: 10px; font-size: 1.2em; color: #f39c12; font-weight: bold; background-color: rgba(0, 0, 0, 0.5); padding: 5px 10px; border-radius: 5px;">-' . $discount_percentage . '%</span>';
                                }
                                ?>
                            <?php else : ?>
                                <span class="price" style="font-size: 1.2em; color: #e74c3c; font-weight: bold;"><?php echo wc_price($product->get_price()); ?></span>
                            <?php endif; ?>
                            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="buy-btn" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #2e8b57   ; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; text-transform: uppercase;">Xem Chi Tiết</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>

        <!-- Ưu Đãi Đặc Biệt -->
        <section class="special-offers">
            <h2>Ưu Đãi Đặc Biệt</h2>
            <div class="offers-grid">
                <?php
                $sale_products = wc_get_products([
                    'status' => 'publish',
                    'limit' => 6,
                    'meta_query' => [
                        [
                            'key' => '_sale_price',
                            'value' => 0,
                            'compare' => '>',
                            'type' => 'NUMERIC',
                        ],
                    ],
                ]);

                foreach ($sale_products as $product) {
                ?>
                    <div class="offer-item">
                        <div class="offer-image">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id(), 'medium') ?: 'https://via.placeholder.com/200x200'); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                        </div>
                        <div class="offer-content">
                            <h3><?php echo esc_html($product->get_name()); ?></h3>
                            <p>Giá khuyến mãi: <?php echo wc_price($product->get_sale_price()); ?></p>
                            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn btn-primary">Mua Ngay</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.categories-slider').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                prevArrow: '<button type="button" class="slick-prev"><</button>',
                nextArrow: '<button type="button" class="slick-next">></button>',
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
    </script>


</body>

</html>

<?php get_footer(); ?>