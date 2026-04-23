<?php
// テーマのCSS・JSを読み込む
function real_estate_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'real_estate_scripts');

// タイトルタグを有効化
add_theme_support('title-tag');

// アイキャッチ画像を有効化
add_theme_support('post-thumbnails');