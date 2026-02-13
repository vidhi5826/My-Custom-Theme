<?php get_header(); ?>

<main>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>
        <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="meta">
                Posted on <?php the_time('F j, Y'); ?> by <?php the_author(); ?>
            </div>
            <div class="content">
                <?php the_excerpt(); ?>
            </div>
        </article>
    <?php
        endwhile;
    else :
    ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>