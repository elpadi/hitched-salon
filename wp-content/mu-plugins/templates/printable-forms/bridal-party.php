<form>
	<h3>Bride's Information</h3>

	<div class="flex-fields">
		<label>Name: <input type="text" name="bride-name" size="<?php echo strlen($bride_name); ?>" value="<?php echo $bride_name; ?>"></label>
		<label>Date: <input type="text" name="bride-wedding-date" size="<?php echo strlen($bride_wedding_date); ?>" value="<?php echo $bride_wedding_date; ?>"></label>
		<label>Cell Phone: <input type="tel" name="bride-cell-phone placeholder:123-456-7890" size="<?php echo strlen($bride_cell_phone); ?>" value="<?php echo $bride_cell_phone; ?>"></label>
		<label>Work Phone: <input type="tel" name="bride-work-phone placeholder:123-456-7890" size="<?php echo strlen($bride_work_phone); ?>" value="<?php echo $bride_work_phone; ?>"></label>
		<label>Email: <input type="email" name="bride-email" size="<?php echo strlen($bride_email); ?>" value="<?php echo $bride_email; ?>"></label>
		<label>Bridal Gown Designer: <input type="text" name="bride-designer" size="<?php echo strlen($bride_designer); ?>" value="<?php echo $bride_designer; ?>"></label>
	</div>
	<p>Did you purchase your gown at hitched? <label><input type="checkbox" name="purchased-at-hitched" value="yes" <?php if ($purchased_at_hitched) echo 'checked'; ?>> Check if yes</label></p>

	<h3>Bridesmaid Dress Order Information</h3>

	<div class="flex-fields">
		<label>Designer: <input type="text" name="bridesmaid-designer" size="<?php echo strlen($bridesmaid_designer); ?>" value="<?php echo $bridesmaid_designer; ?>"></label>
		<label>Color &amp; Fabric: <input type="text" name="bridesmaid-material" size="<?php echo strlen($bridesmaid_material); ?>" value="<?php echo $bridesmaid_material; ?>"></label>
		<label>No. Of Bridesmaids: <input type="text" name="bridesmaid-count" size="<?php echo strlen($bridesmaids_count); ?>" value="<?php echo $bridesmaids_count; ?>"></label>
		<label>Style / Description: <input type="text" name="bridesmaid-description" size="<?php echo strlen($bridesmaids_description); ?>" value="<?php echo $bridesmaids_description; ?>"></label>
	</div>

	<p>If the details of your order change (number or names of bridesmaids in your party, color, dress style selection, etc.), it is your responsibility to update Hitched Maids in writing.</p>

	<?php if (!empty($maid_comments)): ?>
	<h3>Additional Comments:</h3>
	<p><?php echo nl2br($maid_comments); ?></p>
	<?php endif; ?>

	<h3 style="page-break-before: always;">Bridesmaid Information</h3>

	<table>
		<thead><tr>
			<th>Bridesmaid's Name</th>
			<th>Style</th>
			<th>Color</th>
			<th>Size</th>
			<th>Extra Length?</th>
			<th>Shipping/Pick up</th>
			<th>Comments</th>
		</tr></thead>
		<tbody>
			<?php foreach (explode(',', $bridesmaids_names) as $i => $bridesmaid_name): ?>
			<tr><td><div><input type="text" name="bridesmaid-name-<?php echo $i; ?>" size="<?php echo strlen($bridesmaid_name); ?>" value="<?php echo $bridesmaid_name; ?>"></div></td>
				<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			</tr>
			<?php endforeach; ?>
			<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
		</tbody>
	</table>

	<p><sup>*</sup>All gowns and merchandise are sent to Hitched Maids and can be picked up at the boutique. Bridesmaids that live outside the District of Columbia can have the dress shipped to them for a flat fee of $25 and will not be charged DC sales tax. If a bridesmaid decides not to pick up her dress at Hitched Maids after we have placed the order, we are happy to ship the dress to her for the $25 shipping fee, but cannot refund the sales tax. Likewise, if she chooses to change the order by picking up the dress instead of having it shipped, in advance of shipping it, we can accommodate the change, but cannot refund the shipping.</p>
</form>
