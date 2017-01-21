<?php
namespace Hitched;

class Hitched extends \App {

	protected static $SITE_PREFIX = 'hitched_';

	protected function siteSettings() {
	}

	public function themeInit() {
		$this->registerPostType('team', $singular='Person', $plural='Team', ['editor'], ['menu_icon' => 'dashicons-groups']);
	}
	
	public function siteInit() {
	}

	public function themeSetup() {
		register_nav_menus(array(
			'primary' => 'Main Menu',
			'secondary' => 'Pages Menu',
		));
	}
		
	public function widgetsInit() {
		register_sidebar(array(
			'name' => 'Footer',
			'id' => 'footer',
			'description' => 'Footer widgets',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_widget('Hitched\\Widgets\\MailingListWidget');
	}

}
