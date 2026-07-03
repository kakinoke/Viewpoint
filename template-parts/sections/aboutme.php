<?php
$heading_args = ["sub" => "About me", "heading" => "わたしについて"];
$about_page_id = get_page_by_path('about');
$about_page = get_post($about_page_id);
$about_content = $about_page->post_content;
$about_title = $about_page->post_title;
$about_thumbnail = get_the_post_thumbnail_url($about_page);

function createSkillCard(string $name, string $caption) {
    return [
        "name" => $name,
        "caption" => $caption
    ];
}

function createSkill(string $dataset, array $heading, string $description, array $skills) {
    return [
        "dataset" => $dataset,
        "heading" => $heading,
        "description" => $description,
        "skills" => $skills
    ];
}

$design_heading_args = [
    "sub" => "Design",
    "heading" => "デザイン"
];

$design_desc = "単なる装飾ではなく、情報設計に基づいた「使いやすく、迷わない」デザインを心がけています。Figmaを用いたカンプ作成から、ユーザーの行動フローを意識したUI設計まで一貫して対応可能です。";

$skill_designs = [
    createSkillCard("Illustrator", "ロゴ・印刷物の作成"),
    createSkillCard("Photoshop", "画像の補正・編集 / 写真のレタッチ"),
    createSkillCard("Lightroom", "写真の現像・編集"),
    createSkillCard("Figma", "Webデザインカンプ作成")
];

$dev_heading_args = [
    "sub" => "Development",
    "heading" => "開発・実装"
];

$dev_desc = "HTML/CSSをはじめ、React・Next.js・Astro・WordPressなど幅広い技術でWebサイトを構築します。静的サイトから動的な注文フォーム、テーマ開発まで柔軟に対応可能です。
複雑な要件も、UI設計と実装の両面から最適化し、軽量で高速・保守しやすいサイトとして仕上げます。フロントエンドからバックエンドまで一括対応できる点が強みです。";

$skill_dev = [
    createSkillCard("HTML/CSS", "基本的なHTML/CSSのマークアップ、SassやTailwindcssを使ったスタイルの定義が可能です。"),
    createSkillCard("PHP/WordPress", "Wordpressテーマを1から作成ができます。また、メールフォームのバックエンドの実装も可能です。"),
    createSkillCard("Javascript/Typescript", "UIの制御やフォーム機能など、ユーザー体験を高める動きを実装します。
TypeScriptを活用した堅牢で保守性の高いコード記述が可能です。"),
    createSkillCard("React/Next.js/Astro", "モダンなフレームワークを用いた高速なサイト構築を得意としています。
静的生成（SSG）で読み込み速度を最大化したサイトや、複雑な入力フォームなどの実装も対応可能。
要件に応じて最適な技術選定を行い、長く使えるプロダクトを目指します。"),
];

$writing_heading_args = [
    "sub" => "Writing",
    "heading" => "ライティング"
];

$writing_desc = "ユーザーに必要な情報が自然と伝わる、読みやすい文章を意識してライティングを行います。サービスや商品の魅力が正しく届くように、構成の整理から文体の最適化まで対応。
Webデザイン・UIと合わせて文章面からも体験価値を高めるコンテンツ制作を心がけています。";

$skills = [
    createSkill("design", $design_heading_args, $design_desc, $skill_designs),
    createSkill("development", $dev_heading_args, $dev_desc, $skill_dev),
];
?>
<article id="aboutme" class="p-aboutme">
    <?php get_template_part("template-parts/components/heading", "h2", $heading_args); ?>
    <div class="p-aboutme__items">
        <section class="p-aboutme__profile">
            <h3 class="sr-only"><?php echo $about_title; ?>のプロフィール</h3>
            <figure class="p-aboutme__image u-scroll-fadein">
                <img src="<?php echo $about_thumbnail; ?>" alt="柿境 裕のプロフィール写真">
            </figure>
            <div class="p-aboutme__meta u-scroll-fadein">
                <h4 class="p-aboutme__profile-name"><?php echo $about_title; ?></h4>
                <div class="p-aboutme__profile-desc"><?php echo $about_content; ?></div>
            </div>
        </section>
        <div class="p-aboutme__skills">
            <?php foreach ($skills as $skill) : ?>
                <section class="p-aboutme__skill u-scroll-fadein">
                    <?php get_template_part("template-parts/components/heading", "h3", $skill["heading"]); ?>
                    <p class="p-aboutme__skill-desc"><?php echo esc_html($skill["description"]); ?></p>
                    <div class="p-aboutme__skill-more">
                        <?php get_template_part("template-parts/components/button", "more", ["data_card" => $skill["dataset"]]); ?>
                    </div>
                    <ul class="u-card p-aboutme__skill-cards" data-card="<?php echo esc_html($skill['dataset']); ?>">
                        <?php foreach ($skill["skills"] as $s) : ?>
                            <li class="p-aboutme__skill-card">
                                <p class="p-aboutme__skill-name">
                                    <?php echo esc_html($s["name"]); ?>
                                </p>
                                <p class="p-aboutme__skill-caption"><?php echo esc_html($s["caption"]); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endforeach; ?>
            <!-- design / development -->
            <div class="p-aboutme__skill u-scroll-fadein">
                <?php get_template_part("template-parts/components/heading", "h3", $writing_heading_args); ?>
                <p class="p-aboutme__skill-desc"><?php echo esc_html($writing_desc); ?></p>
                <ul class="p-aboutme__skill-links">
                    <li><a class="c-button-exlink" target="_blank" href="https://blky.me">ENHANCE（ブログ）</a></li>
                    <li><a class="c-button-exlink" target="_blank" href="https://note.com/kakinoke">note</a></li>
                </ul>
            </div>
            <!-- writing -->
        </div>
    </div>
</article>
