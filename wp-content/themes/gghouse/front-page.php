<?php get_header(); ?>

<div class="homepage-banner">
    <div class="banner-content">
        <h1>Chào Mừng Bạn Đến Với Cửa Hàng Cây Cảnh & Phụ Kiện</h1>
        <p>Khám phá bộ sưu tập cây cảnh, chậu kiểng, tranh rêu và phụ kiện đa dạng</p>
        <a href="#products" class="btn btn-primary">Khám Phá Ngay</a>
    </div>
</div>

<div class="categories-section">
    <h2>Danh Mục Sản Phẩm</h2>
    <div class="categories">
        <?php
        // Lấy các danh mục sản phẩm
        $args = array(
            'taxonomy'   => 'product_cat', // WooCommerce category taxonomy
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => false,
        );
        $categories = get_terms($args);

        foreach ($categories as $category) {
        ?>
            <div class="category">
                <a href="<?php echo get_term_link($category); ?>">
                    <img src="https://via.placeholder.com/200x200" alt="<?php echo $category->name; ?>" />
                    <h3><?php echo $category->name; ?></h3>
                    <p><?php echo $category->description; ?></p>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<div id="products" class="products-section">
    <h2>Sản Phẩm Mới Nhất</h2>
    <div class="products-grid">
        <?php
        // Lấy 6 sản phẩm mới nhất
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 6, // Số lượng sản phẩm muốn hiển thị
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $loop = new WP_Query($args);

        while ($loop->have_posts()) : $loop->the_post();
            global $product;
        ?>
            <div class="product-item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wc_price($product->get_price()); ?></p>
                </a>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
    <a href="shop" class="btn btn-primary">Xem Tất Cả Sản Phẩm</a>
</div>

<div class="testimonial-section">
    <h2>Khách Hàng Nói Gì Về Chúng Tôi</h2>
    <div class="testimonials">
        <!-- Hiển thị các đánh giá của khách hàng (tuỳ chỉnh) -->
        <div class="testimonial">
            <p>"Chậu kiểng của cửa hàng rất đẹp và chất lượng tuyệt vời. Tôi đã mua một bộ cây cảnh và rất hài lòng!"</p>
            <strong>- Anh Minh</strong>
        </div>
        <div class="testimonial">
            <p>"Mua tranh rêu tại đây rất ưng ý. Hình ảnh sắc nét, rất dễ thương."</p>
            <strong>- Chị Lan</strong>
        </div>
    </div>
</div>

<?php get_footer(); ?>