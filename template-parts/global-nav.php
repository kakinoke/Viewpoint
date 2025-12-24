<?php
function createNavItem($title, $link): array
{

    return [
        "title" => $title,
        "link" => $link
    ];
}

$nav_items = [
    createNavItem(title: "ホーム", link: "/"),
    createNavItem(title: "制作したもの", link: "#p-work"),
    createNavItem(title: "わたしについて", link: "#aboutme"),
];
?>

<nav class="ps-nav">
    <ul class="ps-nav__items">
        <?php foreach ($nav_items as $nav_item): ?>
            <li class="ps-nav__item">
                <a href="<?php echo $nav_item["link"]; ?>">
                    <?php echo $nav_item["title"]; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>