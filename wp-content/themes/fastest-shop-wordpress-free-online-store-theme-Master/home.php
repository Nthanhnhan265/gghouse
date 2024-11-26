<?php 
/* Template Name: Blog */
get_header(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
  <a href="<?php echo home_url(); ?>">Trang chủ</a> > Trang blog</span>
</div>
<!-- Banner -->
<div class="banner">
  <img src="<?php echo get_template_directory_uri(); ?>/images/banner-bancaydep.jpg" alt="Cây cảnh" />
  <div class="banner-text">
    <h1>Tin tức và Kiến thức về Cây cảnh</h1>
    <p>Cập nhật những bài viết mới nhất về cách chăm sóc và lựa chọn cây cảnh.</p>
  </div>
</div>


<!-- Form tìm kiếm -->
<div class="search-container">
  <form role="search" method="get" action="<?php echo home_url('/'); ?>">
    <input type="text" name="s" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo get_search_query(); ?>">
    <button type="submit">
      <i class="fas fa-search"></i> Tìm kiếm
    </button>
  </form>
</div>

<!-- Bộ lọc kết quả -->
<div class="search-filters container">
  <div class="filter-options">
    <select id="sort-results">
      <option value="relevance">Sắp xếp theo độ liên quan</option>
      <option value="date">Mới nhất</option>
      <option value="views">Lượt xem cao nhất</option>
    </select>
  </div>
  <div class="filter-options">
    <select id="filter-category" onchange="updateSearchFilter()">
      <option value="">Chọn chuyên mục</option>
      <?php
      $categories = get_categories(array(
        'orderby' => 'name',
        'order' => 'ASC'
      ));
      foreach ($categories as $category) {
        echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
      }
      ?>
    </select>
  </div>


  <div class="filter-options">
    <select id="filter-length" name="length" onchange="updateSearchFilter()">
      <option value="">Độ dài bài viết</option>
      <option value="short">Ngắn (dưới 500 từ)</option>
      <option value="medium">Trung bình (500-1000 từ)</option>
      <option value="long">Dài (trên 1000 từ)</option>
    </select>
  </div>
  <div class="filter-options">
    <select id="filter-date" name="date" onchange="updateSearchFilter()">
      <option value="">Chọn khoảng thời gian</option>
      <option value="this_month">Tháng này</option>
      <option value="this_week">Tuần này</option>
      <option value="this_year">Năm nay</option>
    </select>
  </div>

</div>

<!-- Kết quả tìm kiếm -->
<div class="search-results container">
  <?php if (have_posts()) : ?>
    <div class="posts-grid">
      <?php while (have_posts()) : the_post(); ?>
        <article class="post-item">
          <!-- Ảnh đại diện -->
          <a href="<?php the_permalink(); ?>" class="post-thumbnail">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium'); ?>
            <?php else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/images/default-thumbnail.jpg" alt="<?php the_title(); ?>" />
            <?php endif; ?>
          </a>

          <!-- Thông tin bài viết -->
          <div class="post-content">
            <!-- Chuyên mục -->
            <div class="post-categories">
              <?php
              $categories = get_the_category();
              if ($categories) {
                foreach ($categories as $category) {
                  echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                }
              }
              ?>
            </div>

            <!-- Tiêu đề -->
            <h2 class="post-title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <!-- Mô tả ngắn -->
            <div class="post-excerpt">
              <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
            </div>

            <!-- Meta info -->
            <div class="post-meta">
              <span class="post-date">
                <i class="far fa-calendar"></i> <?php echo get_the_date(); ?>
              </span>
              <span class="post-views">
                <i class="far fa-eye"></i> <?php
                                            $views = get_post_views(get_the_ID());
                                            echo $views . ' lượt xem';
                                            ?>
              </span>
            </div>

            <a href="<?php the_permalink(); ?>" class="read-more-btn">Đọc thêm</a>
          </div>
        </article>
      <?php endwhile; ?>
    </div>

    <!-- Phân trang -->
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
        the_posts_navigation();
    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>

  <?php else : ?>
    <div class="no-results">
      <h2>Không tìm thấy kết quả</h2>
      <p>Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa của bạn. Vui lòng thử lại với từ khóa khác.</p>

      <!-- Gợi ý bài viết -->
      <div class="suggested-posts">
        <h3>Có thể bạn quan tâm</h3>
        <?php
        $args = array(
          'posts_per_page' => 3,
          'orderby' => 'rand'
        );
        $random_posts = new WP_Query($args);

        if ($random_posts->have_posts()) :
          echo '<div class="posts-grid">';
          while ($random_posts->have_posts()) : $random_posts->the_post();
            // Hiển thị bài viết tương tự như trên
            get_template_part('template-parts/content', 'search');
          endwhile;
          echo '</div>';
        endif;
        wp_reset_postdata();
        ?>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
<style>
  /* Container styles */
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }

  /* Breadcrumb styles */
  .breadcrumb {
    margin: 20px 0;
    font-size: 16px;
    color: #555;
    padding: 20px;
    background: linear-gradient(135deg, #28a745, #34d058);
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease;
  }

  .breadcrumb:hover {
    background: linear-gradient(135deg, #34d058, #28a745);
  }

  .breadcrumb a {
    text-decoration: none;
    color: #fff;
    font-weight: 700;
    transition: color 0.3s ease, text-decoration 0.3s ease, transform 0.3s ease;
  }

  .breadcrumb a:hover {
    color: #f4f4f4;
    text-decoration: underline;
    transform: scale(1.05);
  }

  .breadcrumb span {
    color: #fff;
    font-weight: 600;
  }


  /* Search form */
  .search-container {
    margin: 20px 0;
    text-align: center;
  }

  .search-container input[type="text"] {
    padding: 10px;
    width: 60%;
    max-width: 400px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  .search-container button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .search-container button:hover {
    background-color: #218838;
  }

  /* Results grid */
  .posts-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 50px 20px;
    margin-top: 20px;
  }

  /* Post item styles */
  .post-item {
    border: 1px solid #eaeaea;
    padding: 15px;
    background: #fff;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
  }

  .post-item:hover {
    transform: translateY(-10px);
    box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
  }

  .post-thumbnail img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .post-thumbnail img:hover {
    transform: scale(1.1);
  }

  .post-categories {
    margin: 15px 0 10px;
  }

  .post-categories a {
    color: #28a745;
    text-decoration: none;
    margin-right: 10px;
    font-size: 14px;
    transition: color 0.3s ease;
  }

  .post-categories a:hover {
    color: #218838;
  }

  .post-title {
    font-size: 20px;
    font-weight: 700;
    margin-top: 15px;
    transition: color 0.3s ease;
  }

  .post-title a {
    color: #333;
    text-decoration: none;
  }

  .post-title a:hover {
    color: #28a745;
  }

  .post-excerpt {
    font-size: 16px;
    color: #333;
    flex-grow: 1;
    opacity: 0.8;
    transition: opacity 0.3s ease;
    margin: 10px 0;
  }

  .post-item:hover .post-excerpt {
    opacity: 1;
  }

  .post-meta {
    display: flex;
    gap: 15px;
    font-size: 14px;
    color: #666;
    margin: 10px 0;
  }

  .post-meta i {
    margin-right: 5px;
    color: #28a745;
  }

  .read-more-btn {
    display: inline-block;
    margin-top: 10px;
    color: #28a745;
    font-weight: bold;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .read-more-btn:hover {
    color: #218838;
  }

  /* Pagination */
  .pagination {
    margin-top: 30px;
    text-align: center;
  }

  .pagination .page-numbers {
    display: inline-flex;
    padding: 8px 12px;
    margin: 5px 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
    list-style: none;
  }

  .pagination .current {
    background: #28a745;
    color: #fff;
    border-color: #28a745;
  }

  .pagination .page-numbers:hover:not(.current) {
    background: #f5f5f5;
    border-color: #28a745;
    color: #28a745;
  }

  /* No results */
  .no-results {
    text-align: center;
    padding: 3rem 0;
  }

  .no-results h2 {
    font-size: 1.8rem;
    margin-bottom: 1rem;
    color: #333;
  }

  .suggested-posts {
    margin-top: 3rem;
  }

  .suggested-posts h3 {
    text-align: center;
    margin-bottom: 2rem;
    color: #28a745;
  }

  /* Filter options */
  .search-filters.container {
    display: flex;
    gap: 15px;
    /* Khoảng cách giữa các bộ lọc */
    flex-wrap: wrap;
    /* Đảm bảo rằng các bộ lọc xuống hàng nếu không đủ không gian */
    margin-bottom: 20px;
    /* Khoảng cách dưới cùng */
  }

  .filter-options {
    flex: 1;
    /* Căn đều các bộ lọc */
    min-width: 150px;
    /* Đặt kích thước tối thiểu để không bị quá nhỏ */
  }

  select {
    width: 100%;
    /* Đặt chiều rộng của select để vừa với container */
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
  }

  /* Responsive design */
  @media (max-width: 991px) {
    .posts-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 600px) {
    .posts-grid {
      grid-template-columns: 1fr;
    }

    .banner-content h1 {
      font-size: 28px;
    }
  }

  /* Banner styles */
  .banner {
    position: relative;
    max-width: 100%;
    overflow: hidden;
  }

  .banner img {
    width: 100%;
    height: 500px;
    object-fit: cover;
  }

  .banner-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
    background: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 8px;
  }

  .banner-text h1 {
    font-size: 36px;
    margin-bottom: 10px;
  }

  .banner-text p {
    font-size: 18px;
  }
</style>
<script>
  // Thêm vào file script.js
  jQuery(document).ready(function($) {
    // Xử lý sắp xếp kết quả
    $('#sort-results').on('change', function() {
      const sortValue = $(this).val();
      const currentUrl = new URL(window.location.href);

      // Thêm hoặc cập nhật tham số sắp xếp
      currentUrl.searchParams.set('orderby', sortValue);

      // Chuyển hướng đến URL mới
      window.location.href = currentUrl.toString();
    });

    // Highlight từ khóa tìm kiếm trong kết quả
    const searchQuery = new URLSearchParams(window.location.search).get('s');
    if (searchQuery) {
      const regex = new RegExp(searchQuery, 'gi');
      $('.post-excerpt').each(function() {
        const text = $(this).text();
        $(this).html(text.replace(regex, '<mark>$&</mark>'));
      });
    }
  });
  function updateSearchFilter() {
    // Lấy giá trị từ các bộ lọc
    const sort = document.getElementById('sort-results').value;
    const category = document.getElementById('filter-category').value;
   
    const length = document.getElementById('filter-length').value;
    const date = document.getElementById('filter-date').value;
    console.log("Selected Date Filter: " + date); 
    // Tạo URL mới với các tham số lọc
    let query = new URLSearchParams(window.location.search);
    query.set('orderby', sort);
    if (category) query.set('category', category);
    if (length) {
        query.set('length', length);
    } else {
        query.delete('length');
    }
    if (date) query.set('date', date);
    // Cập nhật URL và tải lại trang
    window.location.search = query.toString();
}
</script>
<?php get_footer(); ?>