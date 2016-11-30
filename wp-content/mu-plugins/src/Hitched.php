<?php
namespace Hitched;

class Hitched extends \App {

	protected static $SITE_PREFIX = 'hitched_';

	function siteInit() {
		add_action('widgets_init', [$this, 'widgetsInit']);
		add_action('wp_ajax_shortcode', [$this, 'ajaxShortcode']);
		add_action('wp_ajax_nopriv_shortcode', [$this, 'ajaxShortcode']);
	}

	function siteSettings() {
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

}
