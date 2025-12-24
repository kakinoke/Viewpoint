<?php
$query = new WP_Query([
    'post_type' => 'work',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC',
]);

$heading_args = ["sub" => "About Works", "heading" => "制作したもの"];
$index = 1;

?>
<section id="p-work" class="p-work">
    <?php get_template_part("template-parts/components/heading", "h2", $heading_args); ?>
    <div class="p-work__inner">
        <?php if ($query->have_posts()): ?>
            <div class="p-work__items">
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <article class="p-work__item">
                        <?php
                        $permalink = get_permalink();
                        $work_url = get_post_meta(get_the_ID(), '_work_url', true);
                        $terms = get_the_terms($post->ID, 'work-tag');
                        ?>
                        <div class="p-work__item__header u-scroll-fadein">
                            <span class="p-work__item__index"><?php echo sprintf('%02d', $index) . "."; ?></span>
                            <ul class="p-work__item__tags">
                                <?php foreach ($terms as $term) : ?>
                                    <li class="p-work__item__tag">#<?php echo $term->name; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <a href="<?php echo esc_url($permalink); ?>" class="p-work__item__link">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="p-work__item__image">
                                    <div class="u-scroll-slidein">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <h3 class="p-work__item__title u-scroll-fadein"><?php the_title(); ?></h2>
                        </a>
                        <?php if ($work_url): ?>
                            <a class="p-work__item__src u-scroll-fadein" href="<?php echo esc_url($work_url); ?>"><?php echo esc_url($work_url); ?></a>
                        <?php endif; ?>
                        <p><?php $work_url; ?></p>
                    </article>
                <?php $index += 1;
                endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- end p-work__inner -->
</section>