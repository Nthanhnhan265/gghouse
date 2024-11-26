

<?php get_header(); ?>

<div class="single-post container custom-container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <!-- Tiêu đề bài viết -->
        <h1 class="post-title"><?php the_title(); ?></h1>

        <!-- Ngày đăng và tác giả -->
        <div class="post-meta">
            <span class="post-date"><?php echo get_the_date(); ?></span>
            <span class="post-author">Bởi <?php the_author(); ?></span>

            <!-- Tính năng chia sẻ bài viết -->
            <div class="post-share">
                <span>Chia sẻ:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>

        <!-- Ảnh đại diện của bài viết -->
        <div class="post-thumbnail">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large' ); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="Cây cảnh" />
            <?php endif; ?>
        </div>

        <!-- Nội dung chi tiết của bài viết -->
        <div class="post-content">
            <?php the_content(); ?>
        </div>

        <!-- Phần bình luận hoặc reviews -->
        <div class="post-comments">
            <?php
                // Kiểm tra xem bình luận có được bật không
                if ( comments_open() ) {
                    comments_template();
                }
            ?>
        </div>

        <!-- Danh sách bài viết liên quan -->
        <div class="related-posts">
            <h3>Bài viết liên quan</h3>
            <?php
                $related_posts = get_related_posts(get_the_ID());
                if ( $related_posts && $related_posts->have_posts() ) {
                    echo '<div class="posts-grid">';
                    while ( $related_posts->have_posts() ) {
                        $related_posts->the_post();
                        get_template_part('template-parts/content', 'related');
                    }
                    echo '</div>';
                    wp_reset_postdata();
                }
            ?>
        </div>

        <!-- Điều hướng bài viết trước và sau -->
        <div class="post-navigation">
            <?php previous_post_link( '<div class="prev-post">%link</div>', 'Bài trước: %title' ); ?>
            <?php next_post_link( '<div class="next-post">%link</div>', 'Bài sau: %title' ); ?>
        </div>

    <?php endwhile; endif; ?>
</div>

<style>
    .custom-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .post-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .post-meta {
        color: #888;
        font-size: 14px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .post-share a {
        color: #28a745;
        margin-left: 10px;
        font-size: 16px;
    }

    .post-thumbnail img {
        width: 100%;
        height: auto;
        margin-bottom: 20px;
        object-fit: cover;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .post-content {
        font-size: 16px;
        line-height: 1.6;
        color: #333;
    }

    .related-posts {
        margin-top: 40px;
    }

    .related-posts h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .post-navigation {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }

    .prev-post, .next-post {
        font-size: 14px;
        color: #28a745;
        font-weight: bold;
        text-decoration: none;
    }
    /* Tùy chỉnh phần bình luận */
.post-comments {
    border-top: 3px solid #ddd;
    padding-top: 25px;
    margin-top: 40px;
    background-color: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
}

.post-comments .comment-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.post-comments .comment {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    display: flex;
    gap: 15px;
}
.comment img.avatar {
    border-radius: 50%;
    width: 60px;
    height: 60px;
    object-fit: cover;
}
/* .post-comments .comment-author img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
} */

.post-comments .comment-body {
    flex: 1;
}

.post-comments .comment-author {
    font-weight: 600;
    font-size: 1.1em;
    color: #2c3e50;
}

.post-comments .comment-meta {
    font-size: 0.85em;
    color: #95a5a6;
    margin-bottom: 5px;
}

.post-comments .comment-content {
    line-height: 1.7;
    color: #34495e;
}

.post-comments .comment-reply-link {
    font-size: 0.9em;
    color: #2980b9;
    text-decoration: none;
    border: 1px solid #2980b9;
    border-radius: 5px;
    padding: 5px 10px;
    display: inline-block;
    transition: background-color 0.3s, color 0.3s;
}

.post-comments .comment-reply-link:hover {
    background-color: #2980b9;
    color: #ffffff;
    text-decoration: none;
}
/* Tùy chỉnh thông tin về việc đã comment */
.comment-approved {
    background-color: #ecf9ec;
    color: #27ae60;
    padding: 10px;
    border-left: 5px solid #27ae60;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 0.95em;
}
/* Tùy chỉnh danh sách bài viết liên quan */
.related-posts {
    margin-top: 50px;
    padding-top: 20px;
}

.related-posts h3 {
    font-size: 1.8em;
    margin-bottom: 25px;
    color: #2c3e50;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.posts-grid .post-item {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.posts-grid .post-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.posts-grid .post-item img {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
    transition: transform 0.3s;
}

.posts-grid .post-item img:hover {
    transform: scale(1.05);
}

.posts-grid .post-title {
    padding: 15px;
    font-size: 1.3em;
    font-weight: 600;
    color: #2c3e50;
}

.posts-grid .post-title a {
    text-decoration: none;
    color: inherit;
    transition: color 0.3s;
}

.posts-grid .post-title a:hover {
    color: #2980b9;
}

.posts-grid .post-meta {
    padding: 0 15px 15px;
    font-size: 0.9em;
    color: #7f8c8d;
}
/* Tùy chỉnh phần textarea nhập bình luận */
.comment-form textarea {
    width: 100%;
    height: 150px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    font-size: 1em;
    line-height: 1.5;
    color: #2c3e50;
    transition: border 0.3s, box-shadow 0.3s;
}

.comment-form textarea:focus {
    border-color: #2980b9;
    box-shadow: 0 0 5px rgba(41, 128, 185, 0.5);
    outline: none;
}

/* Tùy chỉnh nút gửi bình luận */
.comment-form .submit {
    display: inline-block;
    background-color: #2980b9;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
    margin-top: 10px;
}

.comment-form .submit:hover {
    background-color: #1f6390;
    transform: translateY(-3px);
}

.comment-form .submit:active {
    transform: translateY(0);
}

/* Điều chỉnh phần form tổng thể */
.comment-form {
    margin-top: 20px;
}

.comment-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #2c3e50;
}


</style>
    
<?php get_footer(); ?>
