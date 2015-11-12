<?php
function hitched_theme_setup() {
	register_nav_menus(array(
		'primary' => 'Main Menu',
		'secondary' => 'Pages Menu',
	));
}
add_action('after_setup_theme', 'hitched_theme_setup');

function hitched_widgets_init() {
	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer',
		'description' => 'Footer widgets',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'hitched_widgets_init');

function hitched_assets() {
	wp_enqueue_style('twentyfifteen-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'hitched_assets');
