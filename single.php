<?php
$terms = get_the_terms($post->ID, 'work-tag');
$work_url = get_post_meta($post->ID, '_work_url', true);
?>
<?php get_header(); ?>
<main>
    <?php while (have_posts()) : the_post(); ?>
        <article class="p-single__work">
            <div class="l-container l-mx-auto">
                <div class="p-single__work-thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="l-grid">
                    <div class="p-single__work-inner">
                        <div class="p-single__work-meta">
                            <?php if ($terms): ?>
                                <ul class="p-single__work-tags">
                                    <?php foreach ($terms as $term): ?>
                                        <li>#<?php echo $term->name; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <h2 class="p-single__work-title"><?php the_title(); ?></h2>
                            <div class="p-single__work-url">
                                <a href="<?php echo esc_url($work_url); ?>" class="c-button-exlink" target="_blank">
                                    <?php echo esc_url($work_url); ?>
                                </a>
                            </div>
                        </div>
                        <div class="p-single__work-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>