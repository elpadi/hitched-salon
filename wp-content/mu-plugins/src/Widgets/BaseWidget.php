<?php
namespace Hitched\Widgets;

abstract class BaseWidget extends \WP_Widget {

	protected static $_name;
	protected static $_title;
	protected static $_description;

	abstract protected function getFieldSanitizers();
	abstract protected function getFormFields($instance);

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			static::$_name.'_widget',
			static::$_title,
			['description' => static::$_description]
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
		extract($args);
		extract($instance);
		$widget = $this;
		require(sprintf('%s/templates/widget-%s.php', MU_PLUGINS_DIR, static::$_name));
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		$fields = $this->getFormFields($instance);
		require(sprintf('%s/templates/widget-form.php', MU_PLUGINS_DIR));
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
		$sanitizers = $this->getFieldSanitizers();
		foreach ($new_instance as $key => $val) if (isset($sanitizers[$key])) $instance[$key] = call_user_func($sanitizers[$key], $val);
		return $instance;
	}

	protected function textFormField($name, $value) {
		return [
			'id' => $this->get_field_id($name),
			'name' => $this->get_field_name($name),
			'label' => _e(ucwords($name)),
			'value' => esc_attr($value),
		];
	}

}
