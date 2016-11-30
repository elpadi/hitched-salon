<?php
echo $before_widget;
if (!empty($title)) {
	echo $before_title, $title, $after_title;
}
?>
<?php echo $info; ?>
<p><strong><?php echo $forms_prompt; ?></strong></p>
<div class="form-buttons">
	<?php foreach ($forms as $form): ?>
	<button data-shortcode="<?php echo $form['shortcode']; ?>"><?php echo $form['title']; ?></button>
	<?php endforeach; ?>
</div>
<?php echo $after_widget; ?>
