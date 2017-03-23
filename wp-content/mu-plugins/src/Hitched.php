<?php
namespace Hitched;

use MustUsePlugin\App;

class Hitched extends App {

	protected static $SITE_PREFIX = 'hitched_';

	function siteInit() {
		add_action('widgets_init', [$this, 'widgetsInit']);
		add_action('wp_ajax_shortcode', [$this, 'ajaxShortcode']);
		add_action('wp_ajax_nopriv_shortcode', [$this, 'ajaxShortcode']);
	}

	function siteSettings() {
		$flamingo_meta = array(
			'id' => 'view-as-form',
			'title' => __('View As Printable Form', 'textdomain'),
			'callback' => array($this, 'viewFormMetabox'),
		);
		if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'edit') add_action('current_screen', function ($current_screen) use ($flamingo_meta) {
			if ($current_screen->base === 'flamingo_page_flamingo_inbound' && ctype_digit($_REQUEST['post'])) {
				extract($flamingo_meta);
				add_meta_box($id, $title, $callback, null, 'side', 'core');
			}
		});
	}

	function themeInit() {
		$this->registerPostType('team', $singular='Person', $plural='Team', ['editor'], ['menu_icon' => 'dashicons-groups']);
	}

	function themeSetup() {
		register_nav_menus(array(
			'primary' => 'Main Menu',
			'secondary' => 'Pages Menu',
		));
	}
		
	public function ajaxShortcode() {
		$shortcode = $_POST['shortcode'];
		echo do_shortcode(str_replace('\"', '"', $shortcode));
		wp_die();
	}

	function widgetsInit() {
		register_widget('Hitched\\Widgets\\MailingListWidget');
		register_widget('Hitched\\Widgets\\AppointmentSliderWidget');
	}

	public function viewFormMetabox($post) {
		/* TODO:
			If subject is form not supported, do not show button.
		 */
		printf('<div class="wp-clearfix nav-tab-wrapper"><a target="_blank" href="%s?post=%d&path=%s" class="alignright button-primary">View Form</a></div>',
			plugins_url('Actions/pdf-form.php', __FILE__),
			$post->id,
			urlencode(ABSPATH)
		);
	}

}
