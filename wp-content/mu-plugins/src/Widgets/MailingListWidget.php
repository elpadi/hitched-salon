<?php
namespace Hitched\Widgets;

class MailingListWidget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'mailinglist_widget', // Base ID
			'Mailing List Form', // Name
			array('description' => 'Adds the mailing list form.') // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		foreach ($instance as $key => $val) set_query_var($key, $val);
		foreach ($args as $key => $val) set_query_var($key, $val);
		set_query_var('widget', $this);
		get_template_part('widgets/mailinglist');
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		set_query_var('title', !empty($instance['title']) ? $instance['title'] : 'Mailing List Form');
		set_query_var('widget', $this);
		get_template_part('widgets/form','mailinglist');
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $instance;
	}

}
