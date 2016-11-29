<?php
namespace Hitched\Widgets;

class MailingListWidget extends BaseWidget {

	protected static $_name = 'mailing-list';
	protected static $_title = 'Mailing List Form';
	protected static $_description = 'Mailchimp mailing list form.';

	protected function getFormFields($instance) {
		return [
			'title' => $this->formField('title', $instance),
		];
	}

}
