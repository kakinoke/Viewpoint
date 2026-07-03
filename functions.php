<?php

/**
 * Viteセットアップを読み込むヘルパー関数
 */
require_once get_template_directory() . '/inc/vite-helper.php';

// タイトルタグ
add_theme_support('title-tag');

// サムネイル機能を有効化
add_theme_support('post-thumbnails');

require_once get_template_directory() . '/inc/work-post.php';

// テンプレートファイルの階層化
require_once get_template_directory() . '/inc/single-template.php';
