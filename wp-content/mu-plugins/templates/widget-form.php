<?php foreach ($fields as $key => $field): extract($field); ?>
<p>
	<label for="<?php echo $id; ?>"><?php echo $label; ?></label> 
	<?php switch ($type): case 'textarea': ?>
	<textarea class="widefat" id="<?php echo $id; ?>" name="<?php echo $name; ?>"><?php echo $value; ?></textarea>
	<?php break; default: ?>
	<input class="widefat" id="<?php echo $id; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>" value="<?php echo $value; ?>">
	<?php endswitch; ?>
</p>
<?php endforeach; ?>
