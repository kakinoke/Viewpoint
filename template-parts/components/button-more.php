<?php
$data_card = $args['data_card'];

if ($data_card): ?>
    <div class="c-button-more" data-card="<?php echo esc_html($data_card); ?>">
    <?php else: ?>
        <div class="c-button-more">
        <?php endif; ?>
        <span></span>
        詳しくみる
        </div>