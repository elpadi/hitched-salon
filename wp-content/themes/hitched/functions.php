<?php
function hitched_theme_setup() {
	register_nav_menus(array(
		'primary' => 'Main Menu',
		'secondary' => 'Pages Menu',
	));
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(960, 437, true);
}
add_action('after_setup_theme', 'hitched_theme_setup');

function hitched_assets() {
	wp_enqueue_style('hitched-css', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'hitched_assets');

function remove_wp_open_sans() {
	wp_deregister_style('open-sans');
	wp_register_style('open-sans', false);
}
add_action('wp_enqueue_scripts', 'remove_wp_open_sans');

add_filter('wp_nav_menu_args', function($args) {
	if (!in_array($args['theme_location'], ['primary','secondary']) && isset($args['menu']) && $args['menu']->slug === 'social-media') {
		$args['menu_class'] .= ' horizontal-list';
		$args['link_before'] .= '<span class="no-text single-background">';
		$args['link_after'] .= '</span>';
	}
	return $args;
});

add_filter('nav_menu_link_attributes', function($atts, $item, $args, $depth) {
	if (strpos($atts['href'], $_SERVER['HTTP_HOST']) === FALSE) {
		$atts['target'] = '_blank';
	}
	return $atts;
}, 10, 4);
