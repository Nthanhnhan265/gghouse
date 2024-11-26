<?php

/**
 * Template Name: Special Products
 * 
 * Template dành cho trang sản phẩm đặc biệt
 * @package fastest-shop
 */

get_header();

// Lấy các tùy chọn từ theme
$layout = fastest_shop_get_option('blog_layout');
?>

<div class="special-products-container">
    <!-- Banner Section -->
    <div class="banner-section">
        <?php if (has_post_thumbnail()): ?>
            <div class="page-banner">
                <?php the_post_thumbnail('full', array('class' => 'banner-image')); ?>
                <div class="banner-content">
                    <h1><?php the_title(); ?></h1>
                    <?php if (get_field('page_subtitle')): ?>
                        <p class="subtitle"><?php echo get_field('page_subtitle'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="page-title-simple">
                <h1><?php the_title(); ?></h1>
            </div>
        <?php endif; ?>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="container">
            <div class="filter-wrapper">
                <div class="filter-group">
                    <label>Sắp xếp theo:</label>
                    <select class="product-sort">
                        <option value="date-desc">Mới nhất</option>
                        <option value="price-asc">Giá tăng dần</option>
                        <option value="price-desc">Giá giảm dần</option>
                        <option value="name-asc">Tên A-Z</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Danh mục:</label>
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                    ));
                    if ($categories):
                    ?>
                        <select class="category-filter">
                            <option value="">Tất cả danh mục</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo esc_attr($category->term_id); ?>">
                                    <?php echo esc_html($category->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="products-grid">
        <div class="container">
            <div class="row">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 12,
                    'paged' => $paged,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' => get_field('featured_categories') // Nếu bạn dùng ACF để chọn categories
                        )
                    ),
                    'meta_query' => array(
                        array(
                            'key' => '_featured',
                            'value' => 'yes'
                        )
                    )
                );

                $products_query = new WP_Query($args);

                if ($products_query->have_posts()) :
                    while ($products_query->have_posts()) : $products_query->the_post();
                        global $product;
                ?>
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="product-card">
                                <div class="product-image">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('woocommerce_thumbnail');
                                    }

                                    // Badge cho sản phẩm mới
                                    $newness_days = 30;
                                    $created = strtotime($product->get_date_created());
                                    if ((time() - (60 * 60 * 24 * $newness_days)) < $created) {
                                        echo '<span class="badge new-badge">New</span>';
                                    }

                                    // Badge cho sản phẩm giảm giá
                                    if ($product->is_on_sale()) {
                                        echo '<span class="badge sale-badge">Sale</span>';
                                    }
                                    ?>
                                </div>

                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>

                                    <div class="product-category">
                                        <?php echo wc_get_product_category_list($product->get_id(), ', '); ?>
                                    </div>

                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>

                                    <div class="product-actions">
                                        <?php
                                        echo sprintf(
                                            '<a href="%s" data-quantity="1" class="button add_to_cart_button %s" %s>%s</a>',
                                            esc_url($product->add_to_cart_url()),
                                            esc_attr(implode(' ', array_filter(array(
                                                'button',
                                                'product_type_' . $product->get_type(),
                                                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                                $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : ''
                                            )))),
                                            wc_implode_html_attributes(array(
                                                'data-product_id'  => $product->get_id(),
                                                'data-product_sku' => $product->get_sku(),
                                                'aria-label'       => $product->add_to_cart_description(),
                                                'rel'              => 'nofollow',
                                            )),
                                            esc_html($product->add_to_cart_text())
                                        );
                                        ?>
                                        <a href="<?php the_permalink(); ?>" class="view-details">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<div class="col-12"><p>Không tìm thấy sản phẩm nào.</p></div>';
                endif;
                ?>
            </div>

            <!-- Pagination -->
            <?php if ($products_query->max_num_pages > 1): ?>
                <div class="pagination-wrapper">
                    <?php
                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $products_query->max_num_pages,
                        'prev_text' => '&laquo; Trước',
                        'next_text' => 'Sau &raquo;',
                        'type' => 'list'
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    /* Banner Styles */
    .banner-section {
        position: relative;
        margin-bottom: 40px;
    }

    .page-banner {
        position: relative;
        height: 300px;
        overflow: hidden;
    }

    .banner-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .banner-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #fff;
        z-index: 1;
    }

    .banner-content h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .banner-content .subtitle {
        font-size: 1.2rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* Filter Styles */
    .filter-section {
        background: #f8f9fa;
        padding: 20px 0;
        margin-bottom: 30px;
    }

    .filter-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-group select {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: #fff;
    }

    /* Product Card Styles */
    .product-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        position: relative;
        padding-top: 100%;
    }

    .product-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: 600;
    }

    .new-badge {
        background: #28a745;
        color: #fff;
    }

    .sale-badge {
        background: #dc3545;
        color: #fff;
    }

    .product-info {
        padding: 15px;
    }

    .product-title {
        font-size: 1.1rem;
        margin-bottom: 10px;
    }

    .product-title a {
        color: #333;
        text-decoration: none;
    }

    .product-category {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 1.1rem;
        font-weight: 600;
        color: #e83e8c;
        margin-bottom: 15px;
    }

    .product-actions {
        display: flex;
        gap: 10px;
    }

    .add_to_cart_button,
    .view-details {
        flex: 1;
        padding: 8px 15px;
        text-align: center;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .add_to_cart_button {
        background: #007bff;
        color: #fff;
    }

    .view-details {
        background: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
    }

    .add_to_cart_button:hover {
        background: #0056b3;
    }

    .view-details:hover {
        background: #e9ecef;
    }

    /* Pagination Styles */
    .pagination-wrapper {
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .page-numbers {
        padding: 8px 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s;
    }

    .page-numbers.current {
        background: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .page-numbers:hover:not(.current) {
        background: #f8f9fa;
        border-color: #007bff;
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .banner-content h1 {
            font-size: 2rem;
        }

        .banner-content .subtitle {
            font-size: 1rem;
        }
    }

    @media (max-width: 767px) {
        .filter-wrapper {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-group {
            width: 100%;
        }

        .filter-group select {
            flex: 1;
        }

        .product-actions {
            flex-direction: column;
        }
    }
</style>

<script>
    jQuery(document).ready(function($) {
        // Xử lý sắp xếp sản phẩm
        $('.product-sort').change(function() {
            var sortValue = $(this).val();
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.searchParams.set('orderby', sortValue);
            window.location.href = url;
        });

        // Xử lý lọc theo danh mục
        $('.category-filter').change(function() {
            var categoryId = $(this).val();
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            if (categoryId) {
                url.searchParams.set('product_cat', categoryId);
            } else {
                url.searchParams.delete('product_cat');
            }
            window.location.href = url;
        });
    });
</script>

<?php
get_footer();
