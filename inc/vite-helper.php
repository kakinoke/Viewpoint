<?php
/**
 * Viteのアセットを読み込むヘルパー関数
 */
define('VITE_SERVER', 'http://localhost:4321');
define('THEME_DIST_PATH', get_template_directory_uri() . '/dist');
define('THEME_DIST_DIR', get_template_directory() . '/dist');

function vite_enqueue_assets()
{
    // 開発環境の判定
    // IS_VITE_DEV定数が定義されている場合はそれを使用
    $is_dev = false;

    if (defined('IS_VITE_DEV')) {
        $is_dev = IS_VITE_DEV;
    }
    // WP_DEBUGやViteサーバーの接続確認は行わない（常に開発モード）

    if ($is_dev) {
        // 【開発時】Viteサーバーから直接読み込む (HMR用)

        // 1. Viteクライアント（head内で読み込む）
        wp_enqueue_script('vite-client', VITE_SERVER . '/@vite/client', [], null, false);

        // 2. JSエントリポイント（フッターで読み込む）
        wp_enqueue_script('vite-main-js', VITE_SERVER . '/src/ts/main.ts', [], null, true);

        // 3. CSSエントリポイント（開発時も明示的に読み込む）
        wp_enqueue_style('vite-main-css', VITE_SERVER . '/src/css/main.css', [], null);

    } else {
        // 【本番時】ビルドされたファイルを manifest.json から探して読み込む
        $manifest_path = THEME_DIST_DIR . '/.vite/manifest.json';

        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);

            // JSの読み込み
            if (isset($manifest['src/ts/main.ts']['file'])) {
                wp_enqueue_script('main-js', THEME_DIST_PATH . '/' . $manifest['src/ts/main.ts']['file'], [], null, true);
            }

            // CSSの読み込み
            // ※重要: ここのキーは vite.config.ts の input で指定したパスと完全に一致させる必要があります
            if (isset($manifest['src/css/main.css']['file'])) {
                wp_enqueue_style('style', THEME_DIST_PATH . '/' . $manifest['src/css/main.css']['file'], [], null);
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'vite_enqueue_assets');

// 【重要】Vite開発サーバーへのスクリプトタグに type="module" を付与する
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if (in_array($handle, ['vite-client', 'vite-main-js'])) {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}, 10, 3);