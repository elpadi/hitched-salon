<?php
namespace Hitched\Widgets;

class AppointmentSliderWidget extends BaseWidget {

	protected static $_name = 'appointment-slider';
	protected static $_title = 'Appointment Slider';
	protected static $_description = 'Slide-down widget with appointment forms.';

	protected function getFormFields($instance) {
		return [
			'title' => $this->formField('title', $instance),
			'info' => $this->formField('info', $instance, 'textarea'),
			'bride' => $this->formField('bridal-form', $instance),
			'maid' => $this->formField('maid-form', $instance),
		];
	}

}
