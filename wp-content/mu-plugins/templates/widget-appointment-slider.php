<?php
echo $before_widget;
if (!empty($title)) {
	echo $before_title, $title, $after_title;
}
?>
<?php echo $info; ?>
<?php echo $after_widget; ?>
