<?php
function getIconUri($name): string {
    return get_template_directory_uri() . "/assets/icon/" . $name;
}

$sns_items = [
    [
        "title" => "@blky3",
        "link" => "https://x.com/blky3",
        "icon" => getIconUri(name: "x.svg")
    ],
    [
        "title" => "note",
        "link" => "https://note.com/kakinoke",
        "icon" => getIconUri(name: "note.svg")
    ],
    [
        "title" => "Email",
        "link" => "mailto:blky@blky.me",
        "icon" => getIconUri(name: "email.svg")
    ],
];
?>
<footer class="ps-footer">
    <div class="l-container l-mx-auto">
        <div class="c-divider"></div>
    </div>
    <div class="ps-footer__title">VIEWPOINT</div>
    <div class="ps-footer__wrapper">
        <ul class="ps-footer__contact-items">
            <?php foreach ($sns_items as $sns_item): ?>
                <li class="ps-footer__contact-item">
                    <a href="<?php echo $sns_item['link']; ?>">
                        <?php echo $sns_item['title']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="ps-footer__copyright">
            © <?php bloginfo(show: 'title'); ?>
        </p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>