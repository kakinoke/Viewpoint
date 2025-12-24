<?php
$terms = get_the_terms($post->ID, 'work-tag');
$work_url = get_post_meta($post->ID, '_work_url', true);
?>
<?php get_header(); ?>
<main>
    <?php while (have_posts()) : the_post(); ?>
        <article class="p-single__work">
            <div class="l-container l-mx-auto">
                <div class="p-single__work__thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="l-grid">
                    <div class="p-single__work__inner">
                        <div class="p-single__work__meta">
                            <?php if ($terms): ?>
                                <ul class="p-single__work__tags">
                                    <?php foreach ($terms as $term): ?>
                                        <li>#<?php echo $term->name; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <h2 class="p-single__work__title"><?php the_title(); ?></h2>
                            <div class="p-single__work__url">
                                <a href="<?php echo esc_url($work_url); ?>">
                                    <?php echo esc_url($work_url); ?>
                                </a>
                            </div>
                        </div>
                        <div class="p-single__work__content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>