<?php
ob_start();
require($_REQUEST['path'].'wp-load.php');
wp();
if (!current_user_can('edit_post', intval($_REQUEST['post']))) {
	header('HTTP/1.0 403 Forbidden');
	exit();
}
$message = new Flamingo_Inbound_Message($_REQUEST['post']);

$title = str_replace(' Submission', '', $message->subject);
extract(array_combine(
	array_map(function($key) { return str_replace('-', '_', $key); }, array_keys($message->fields)),
	array_values($message->fields)
));

require(sprintf('%s/templates/printable-forms/header.php', MU_PLUGINS_DIR));
require(sprintf('%s/templates/printable-forms/%s.php', MU_PLUGINS_DIR, implode('-', array_slice(explode('-', sanitize_title($message->subject)), 0, 2))));
require(sprintf('%s/templates/printable-forms/footer.php', MU_PLUGINS_DIR));
