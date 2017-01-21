<?php
namespace Hitched;

class Hitched extends \MustUsePlugin\App {

	protected static $SITE_PREFIX = 'hitched_';

	protected function siteSettings() {
	}

	public function themeInit() {
		$this->registerPostType('team', $singular='Person', $plural='Team', ['editor'], ['menu_icon' => 'dashicons-groups']);
	}
	
	public function siteInit() {
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
