<?php
/*
 * The template for displaying archive pages
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php if (have_posts()) : ?>

      <header class="page-header">
        <?php
          the_archive_title('<h1 class="page-title">', '</h1>');
          the_archive_description('<div class="archive-description">', '</div>');
        ?>
      </header>

      <div class="plant-grid">
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('plant-item'); ?>>
            <a href="<?php the_permalink(); ?>" class="plant-link">
              <?php if (has_post_thumbnail()) : ?>
                <div class="plant-image"><?php the_post_thumbnail('medium'); ?></div>
              <?php endif; ?>
              <div class="plant-content">
                <h2 class="plant-title"><?php the_title(); ?></h2>
                <div class="plant-price"><?php echo get_post_meta(get_the_ID(), 'plant_price', true); ?></div>
                <div class="plant-description"><?php echo get_post_meta(get_the_ID(), 'plant_description', true); ?></div>
              </div>
            </a>
          </article>
        <?php endwhile; ?>
      </div>

      <?php the_posts_navigation(); ?>

    <?php else : ?>
      <?php get_template_part('template-parts/content', 'none'); ?>
    <?php endif; ?>

  </main>
</div>
<style>
    /* CSS Styles for Custom Plant Archive Page */
.plant-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 30px;
  margin-top: 40px;
}

.plant-item {
  background-color: #fff;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  border-radius: 5px;
  overflow: hidden;
}

.plant-link {
  display: block;
  color: inherit;
  text-decoration: none;
}

.plant-link:hover {
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.plant-image img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.plant-content {
  padding: 1.5rem;
}

.plant-title {
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
}

.plant-price {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 0.5rem;
}

.plant-description {
  line-height: 1.4;
}
</style>
<?php get_footer(); ?>