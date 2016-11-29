<?php
namespace Hitched\Widgets;

class MailingListWidget extends BaseWidget {

	protected static $_name = 'mailinglist';
	protected static $_title = 'Mailing List Form';
	protected static $_description = 'Mailchimp mailing list form.';

	protected function getFieldSanitizers() {
		return [
			'title' => 'strip_tags',
		];
	}

	protected function getFormFields($instance) {
		return [
			'title' => $this->textFormField('title', empty($instance['title']) ? '' : $instance['title']),
		];
	}

}
