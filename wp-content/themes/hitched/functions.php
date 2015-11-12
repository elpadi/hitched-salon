<?php
function hitched_theme_setup() {
	register_nav_menus(array(
		'primary' => 'Main Menu',
		'secondary' => 'Pages Menu',
	));
}
add_action('after_setup_theme', 'hitched_theme_setup');

function hitched_assets() {
	wp_enqueue_style('twentyfifteen-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'hitched_assets');
