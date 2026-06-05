<?php
$defaults = [
    'sub' => '',
    'heading' => '',
];

$args = wp_parse_args($args, $defaults);
?>
<div class="c-heading__h2-wrapper">
    <h2 class="c-heading__h2" data-sub="<?php echo esc_attr($args['sub']); ?>">
        <?php echo esc_html($args['heading']); ?>
    </h2>
</div>