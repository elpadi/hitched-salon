<?php
use Hitched\Hitched as Site;

if (!defined('MINIFY_ASSETS')) define('MINIFY_ASSETS', !WP_DEBUG);

function hitched_theme_setup() {
	register_nav_menus(array(
		'primary' => 'Main Menu',
		'secondary' => 'Pages Menu',
	));
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(960, 437, true);
	foreach (range(2,4) as $x) add_image_size("{$x}x", 960 * $x);
}
add_action('after_setup_theme', 'hitched_theme_setup');


add_action('widgets_init', function() {
	register_sidebar([
		'name'          => 'Header',
		'id'            => 'header-widgets',
		'description'   => 'Header widgets',
		'before_widget' => '<section id="%1$s" class="widget header-widget %2$s"><div class="site-width"><button class="close-button">close</button>',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="uppercase sushi-green">',
		'after_title'   => '</h2>',
	]);
	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer',
		'description' => 'Footer widgets',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
});

function hitched_styles() {
	global $wp_the_query;
	$css_dir = get_stylesheet_directory_uri().'/css/src';
	$root = dirname(WP_CONTENT_DIR);
	$styles = [];
	foreach (glob(get_stylesheet_directory()."/css/src/*", GLOB_ONLYDIR) as $dir) {
		$dirname = basename($dir);
		foreach (glob("$dir/*.css") as $file) {
			$handle = Site::prefix(basename($file, '.css'));
			if ($handle === Site::prefix('main')) continue;
			$styles[$dirname][] = $handle;
			$parts = explode('/src/', $file);
			wp_register_style($handle, "$css_dir/".end($parts), [], false);
		}
	}
	
	wp_register_style(Site::prefix('lightbox'), $css_dir.'/../dist/vendor/lightbox.css', [], false);
	wp_register_style(Site::prefix('pages'), $css_dir.'/pages/main.css', [], false);

	if (is_page('sample-sale')) wp_enqueue_style(Site::prefix('lightbox'));
	wp_enqueue_style(Site::prefix('main'), $css_dir.'/base/main.css', array_merge($styles['base'], $styles['layout']), false);

	$queue = [];
	if (is_front_page()) $queue = array_merge($queue, ['slideshow','grid','home']);
	elseif (is_page()) {
		$queue[] = 'pages';
		wp_enqueue_style(Site::prefix($wp_the_query->query_vars['pagename']));
		if ($wp_the_query->query_vars['pagename'] === 'maids') wp_enqueue_style(Site::prefix('bridal'));
		if (strpos($wp_the_query->query_vars['pagename'], 'form')) wp_enqueue_style(Site::prefix('forms'));
	}
	foreach ($queue as $style) wp_enqueue_style(Site::prefix($style));
	wp_enqueue_style(Site::prefix('768'), $css_dir.'/responsive/768vw.css', [], false, '(min-width: 768px)');
	wp_enqueue_style(Site::prefix('980'), $css_dir.'/responsive/980vw.css', [], false, '(min-width: 980px)');
}
function hitched_scripts() {
	$js_dir = get_stylesheet_directory_uri().'/js/src';
	$deps = [Site::prefix('stdlib')];

	wp_register_script(Site::prefix('stdlib'), $js_dir.'/inc/stdlib.js', [], false, true);
	wp_register_script(Site::prefix('slideshow'), $js_dir.'/inc/slideshow.js', [], false, true);
	wp_register_script(Site::prefix('hitched'), $js_dir.'/hitched/hitched.js', [], false, true);
	wp_register_script(Site::prefix('lightbox'), $js_dir.'/../dist/vendor/lightbox-plus-jquery.min.js', [], false, true);

	if (is_page('sample-sale')) $deps[] = Site::prefix('lightbox');
	if (is_front_page()) $deps[] = Site::prefix('slideshow');

	$deps[] = Site::prefix('hitched');
	wp_enqueue_script(Site::prefix('main'), $js_dir.'/main.js', $deps, false, true);
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

add_filter('the_content', function($s) {
	if (is_page('happily-ever-hitched')) {
		$parts = explode('<hr />', $s);
		if (count($parts) > 1) {
			return implode('', array_map(function($part) { return '<div class="column">'.$part.'</div>'; }, $parts));
		}
	}
	return $s;
});

function the_split_content($head) {
	$content = apply_filters('the_content', get_the_content());
	$parts = explode('<hr />', $content);
	echo $parts[!$head && count($parts) > 1 ? 1 : 0];
}

add_filter('max_srcset_image_width', function($w) { return 0; });

add_filter('esc_html', function($safe, $raw) {
	if (strpos($raw, 'pay') && strpos($raw, 'strong')) {
		return $raw;
	}
	return $safe;
}, 10, 2);
