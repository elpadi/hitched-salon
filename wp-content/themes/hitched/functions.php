<?php
use Hitched\Hitched as Site;

if (!defined('MINIFY_ASSETS')) define('MINIFY_ASSETS', !WP_DEBUG);

function hitched_theme_setup() {
	register_nav_menus(array(
		'primary' => 'Main Menu',
		'secondary' => 'Pages Menu',
	));
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(960, 437, true);
}
add_action('after_setup_theme', 'hitched_theme_setup');

function hitched_styles() {
	global $wp_the_query;
	$css_dir = get_stylesheet_directory_uri().'/css/src';
	$styles = [
		'base' => ['fonts','colors'],
		'layout' => ['menu','header','footer'],
		'sections' => ['slideshow','grid'],
		'pages' => ['home','about-us','accessories','bridal','careers','happenings','faq'],
	];
	foreach ($styles as $type => $files)
		foreach ($files as $file) wp_register_style(Site::prefix($file), "$css_dir/$type/$file.css", [], false);
	
	wp_register_style(Site::prefix('pages'), $css_dir.'/pages/main.css', [], false);
	wp_enqueue_style(Site::prefix('main'), $css_dir.'/base/main.css', array_map(['Hitched\Hitched','prefix'], array_merge($styles['base'], $styles['layout'])), false);
	$queue = [];
	if (is_front_page()) $queue = array_merge($queue, ['slideshow','grid','home']);
	elseif (is_page()) {
		$queue[] = 'pages';
		wp_enqueue_style(Site::prefix($wp_the_query->query['pagename']));
	}
	foreach ($queue as $style) wp_enqueue_style(Site::prefix($style));
}
function hitched_scripts() {
	$js_dir = get_stylesheet_directory_uri().'/js/src';
	wp_register_script(Site::prefix('stdlib'), $js_dir.'/inc/stdlib.js', [], false);
	wp_register_script(Site::prefix('hitched'), $js_dir.'/hitched/hitched.js', [Site::prefix('stdlib')], false);
	wp_enqueue_script(Site::prefix('main'), $js_dir.'/main.js', [Site::prefix('hitched')], false);
}
function hitched_assets() {
	if (MINIFY_ASSETS) {
		wp_enqueue_style('hitched-css', get_stylesheet_uri());
	}
	else {
		hitched_styles();
		hitched_scripts();
	}
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

add_filter('dynamic_sidebar_params', function($params) {
	if ($params[0]['id'] === 'footer') {
		$params[0]['before_title'] = str_replace('class="', 'class="cursive ', $params[0]['before_title']);
		if ($params[0]['widget_name'] === 'Text') {
			$params[0]['before_widget'] = str_replace('class="', 'class="serif ', $params[0]['before_widget']);
		}
	}
	return $params;
});
