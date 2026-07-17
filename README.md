# VIEWPOINT

カキザカイユウのポートフォリオサイト用 WordPress カスタムテーマです。
Vite によるフロントエンドビルド、カスタム投稿タイプ「制作実績」、FLOCSS ベースの CSS 設計を採用しています。

## 特徴

- **Vite** による TypeScript / CSS のビルド（開発時は HMR 対応）
- 制作実績を管理する **カスタム投稿タイプ `work`**（タクソノミー `work-tag`、カスタムフィールド「実績URL」付き）
- **FLOCSS ライクな CSS 設計**（foundation / layouts / components / utilities / projects）
- 投稿タイプ別にテンプレートを出し分けるカスタムテンプレート階層

## 動作要件

- PHP / WordPress（テーマとして `wp-content/themes/` 配下に配置して使用）
- Node.js（Vite 7 系が動作するバージョン）

## セットアップ

```bash
# フロントエンド依存関係のインストール
npm install
```

## 開発

```bash
npm run dev
```

`vite.config.ts` の設定により、`http://localhost:4321` で Vite の開発サーバーが起動します。

WordPress 側で開発モードの資産（HMR 対応）を読み込むには、`wp-config.php` などで以下の定数を定義してください。

```php
define('IS_VITE_DEV', true);
```

この定数が未定義、または `false` の場合は本番ビルド（`dist/`）を読み込みます（[inc/vite-helper.php](inc/vite-helper.php)）。

## ビルド

```bash
npm run build
```

`dist/` 以下に本番用アセットと `manifest.json` が出力されます。本番時はこの manifest を元に `wp_enqueue_script` / `wp_enqueue_style` でアセットが読み込まれます。

## ディレクトリ構成

```
.
├── functions.php              # テーマのエントリーポイント（各 inc/ の読み込み）
├── header.php / footer.php    # 共通ヘッダー・フッター
├── index.php                  # トップページ（hero / works / aboutme を組み立て）
├── inc/
│   ├── vite-helper.php        # Vite アセットの読み込み制御（開発/本番の出し分け）
│   ├── work-post.php          # カスタム投稿タイプ「work」・タクソノミー・実績URLメタボックス
│   └── single-template.php    # 投稿タイプ別の single テンプレート振り分け
├── single/
│   ├── index.php              # 通常投稿の single テンプレート
│   └── work.php               # work 投稿の single テンプレート
├── template-parts/
│   ├── global-nav.php         # グローバルナビゲーション
│   ├── hero.php                # トップのヒーローセクション
│   ├── components/            # 見出し・ボタンなどの再利用コンポーネント
│   └── sections/               # works（制作実績一覧）・aboutme（プロフィール）セクション
├── src/
│   ├── ts/main.ts             # フロントエンドの挙動（ハンバーガーメニュー、スクロールアニメーション等）
│   └── css/
│       ├── foundation/        # リセット・CSS変数などの土台
│       ├── layouts/           # ヘッダー・フッター・グリッドなどのレイアウト
│       ├── components/        # ボタン・見出し等の汎用コンポーネント（c- prefix）
│       ├── utilities/         # 単機能のユーティリティクラス（u- prefix）
│       └── projects/          # ページ固有のスタイル（p- prefix）
├── dist/                      # ビルド成果物（npm run build の出力先、Git管理外）
├── vite.config.ts             # Vite の設定（エントリーポイント、出力先、devサーバー）
├── postcss.config.js          # PostCSS の設定（import / custom-media / nesting / autoprefixer）
└── composer.json              # WordPress スタブ（開発時の型補完用）
```

## カスタム投稿タイプ「制作実績」（work）

[inc/work-post.php](inc/work-post.php) で以下を登録しています。

- 投稿タイプ `work`：タイトル・本文（エディタ）・アイキャッチ画像をサポート、REST API 対応
- タクソノミー `work-tag`：実績を分類するためのタグ
- カスタムフィールド「実績URL」（`_work_url`）：制作実績の外部リンクを保存するメタボックス

トップページの [template-parts/sections/works.php](template-parts/sections/works.php) で一覧表示、[single/work.php](single/work.php) で詳細表示を行います。

## CSS 設計

`src/css/main.css` から以下の順序で各レイヤーを読み込んでいます（[src/css/main.css](src/css/main.css)）。

1. `foundation` — CSS変数・ベーススタイル
2. `layouts` — `l-` プレフィックスのレイアウト用クラス
3. `components` — `c-` プレフィックスの汎用コンポーネント
4. `utilities` — `u-` プレフィックスの単機能クラス
5. `projects` — `p-` プレフィックスのページ固有スタイル

CSS変数（ブレークポイント・フォントサイズ・スペーシング・カラーパレット等）は [src/css/foundation/_variables.css](src/css/foundation/_variables.css) にまとめられています。フォントは `@fontsource/poppins`、`@fontsource/dm-mono` を使用しています。
