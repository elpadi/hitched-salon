<?php
namespace Hitched\Widgets;

class AppointmentSliderWidget extends BaseWidget {

	protected static $_name = 'appointment-slider';
	protected static $_title = 'Appointment Slider';
	protected static $_description = 'Slide-down widget with appointment forms.';

	public function __construct() {
		parent::__construct();
		add_filter('preprocess_widget_values', [$this, 'preprocessWidgetValues']);
	}

	public function preprocessWidgetValues($values) {
		if ($values['widget_name'] === static::$_title) {
			preg_match_all('/\[[^\]]*?\]/', htmlspecialchars_decode($values['forms']), $matches);
			$values['forms'] = array_map(function($shortcode) {
				return [
					'title' => preg_replace('/.*title="(.*?)".*/', '$1', $shortcode),
					'shortcode' => esc_attr($shortcode),
				];
			}, $matches[0]);
			$values['info'] = preg_replace_callback('/:( +)([0-9])/', function($matches) {
				return sprintf(':%s%s', str_repeat('&nbsp;', strlen($matches[1])), $matches[2]);
			}, $values['info']);
		}
		return $values;
	}

	protected function getFormFields($instance) {
		return [
			'title' => $this->formField('title', $instance),
			'info' => $this->formField('info', $instance, 'textarea'),
			'prompt' => $this->formField('forms_prompt', $instance),
			'forms' => $this->formField('forms', $instance, 'textarea'),
		];
	}

}
