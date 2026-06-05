<?php
$defaults = [
    'sub' => '',
    'heading' => '',
];

$args = wp_parse_args($args, $defaults);
?>
<div class="c-heading__h3-wrapper" data-sub="<?php echo esc_attr($args['sub']); ?>">
    <h3 class="c-heading__h3">
        <?php echo esc_html($args['heading']); ?>
    </h3>
</div>