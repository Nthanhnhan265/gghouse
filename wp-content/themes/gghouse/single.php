<?php get_header(); ?>

<div class="single-post" style="margin: 0 20px;">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', 'single');
            the_content();
        endwhile;
    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>
</div>

<?php get_footer(); ?>