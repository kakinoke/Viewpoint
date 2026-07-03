<?php

function custom_single_template($template) {
	$post_type = get_post_type();

	// 通常投稿の場合
	if ($post_type == 'post') {
		$new_template = locate_template('single/index.php');
		if ($new_template) return $new_template;
	}

	// カスタム投稿の場合
	$new_template = locate_template("single/{$post_type}.php");
	if ($new_template) return $new_template;

	return $template;
}

add_filter('single_template', 'custom_single_template');
