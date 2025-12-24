<?php
// 制作実績カスタム投稿
function work_post()
{
    register_post_type(
        'work',
        [
            'public' => true,
            'labels' => [
                'name' => '制作実績',
                'all_items' => '制作実績一覧',
                'add_new' => '新規実績追加',
                'exclude_from_search' => false,
            ],
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'has_archive' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicon-admin-customizer',
        ]
    );
}

add_action('init', 'work_post');

// 制作実績カスタムタクソノミー
function work_taxonomy_tag()
{
    register_taxonomy(
        'work-tag',
        'work',
        [
            'label' => '制作実績タグ',
            'public' => true,
            'show_in_rest' => true,
        ]
    );
}

add_action('init', 'work_taxonomy_tag');

// 制作実績URLカスタムフィールドのメタボックス追加
function work_url_meta_box()
{
    add_meta_box(
        'work_url_meta_box',
        '実績URL',
        'work_url_meta_box_callback',
        'work',
        'normal',
        'high'
    );
}

add_action('add_meta_boxes', 'work_url_meta_box');

// メタボックスのコールバック関数
function work_url_meta_box_callback($post)
{
    wp_nonce_field('work_url_meta_box', 'work_url_meta_box_nonce');
    $work_url = get_post_meta($post->ID, '_work_url', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="work_url">実績URL</label></th>
            <td>
                <input type="url" id="work_url" name="work_url" value="<?php echo esc_attr($work_url); ?>"
                    style="width: 100%;" placeholder="https://example.com" />
                <p class="description">制作実績のURLを入力してください</p>
            </td>
        </tr>
    </table>
    <?php
}

// カスタムフィールドの保存処理
function work_url_save_meta_box($post_id)
{
    // 自動保存の場合は処理をスキップ
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // 権限チェック
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // ノンスチェック
    if (!isset($_POST['work_url_meta_box_nonce']) || !wp_verify_nonce($_POST['work_url_meta_box_nonce'], 'work_url_meta_box')) {
        return;
    }

    // カスタムフィールドの値を保存
    if (isset($_POST['work_url'])) {
        update_post_meta($post_id, '_work_url', sanitize_url($_POST['work_url']));
    } else {
        delete_post_meta($post_id, '_work_url');
    }
}

add_action('save_post_work', 'work_url_save_meta_box');