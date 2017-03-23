<form>
	<div class="flex-fields">
		<label>Name: <input type="text" name="maids-name" size="<?php echo strlen($maids_name); ?>" value="<?php echo $maids_name; ?>"></label>
		<label>Email: <input type="email" name="maids-email" size="<?php echo strlen($maids_email); ?>" value="<?php echo $maids_email; ?>"></label>
		<label>Street Address (no PO boxes): <input type="text" name="maids-street" size="<?php echo strlen($maids_street); ?>" value="<?php echo $maids_street; ?>"></label>
		<label>Apt./Unit #: <input type="text" name="maids-unit" size="<?php echo strlen($maids_unit); ?>" value="<?php echo $maids_unit; ?>"></label>
		<label>City: <input type="text" name="maids-city" size="<?php echo strlen($maids_city); ?>" value="<?php echo $maids_city; ?>"></label>
		<label>State: <input type="text" name="maids-state" size="<?php echo strlen($maids_state); ?>" value="<?php echo $maids_state; ?>"></label>
		<label>Zip: <input type="text" name="maids-zip" size="<?php echo strlen($maids_zip); ?>" value="<?php echo $maids_zip; ?>"></label>
		<label>Home Phone: <input type="tel" name="maids-home-phone placeholder:123-456-7890" size="<?php echo strlen($maids_home_phone); ?>" value="<?php echo $maids_home_phone; ?>"></label>
		<label>Cell Phone: <input type="tel" name="maids-cell-phone placeholder:123-456-7890" size="<?php echo strlen($maids_cell_phone); ?>" value="<?php echo $maids_cell_phone; ?>"></label>
		<label>Work Phone: <input type="tel" name="maids-work-phone placeholder:123-456-7890" size="<?php echo strlen($maids_work_phone); ?>" value="<?php echo $maids_work_phone; ?>"></label>
		<label>Bride's Name: <input type="text" name="brides-name" size="<?php echo strlen($brides_name); ?>" value="<?php echo $brides_name; ?>"></label>
	</div>

	<p>It is your responsibility to contact Hitched Maids should any of your contact information change.</p>

	<h3>Please select one:</h3>
	<p><label> <input type="radio" name="dress-delivery" value="pickup" <?php if ($dress_delivery[0] === 'pickup') echo 'checked'; ?>>I will pick up my dress in the store (you will pay <strong>6% DC sales tax</strong>)</p>
	<p><label> <input type="radio" name="dress-delivery" value="ship-dc"<?php if ($dress_delivery[0] === 'ship-dc') echo 'checked'; ?>>I would like my dress shipped to me at the District of Columbia address listed above (you will pay <strong>6% DC sales tax and a $25 shipping fee</strong>)</p>
	<p><label> <input type="radio" name="dress-delivery" value="ship-outside"<?php if ($dress_delivery[0] === 'ship-outside') echo 'checked'; ?>>I do not live in the District of Columbia and would like my dress shipped to me at the address listed above (you will pay a <strong>$25 shipping fee</strong>)</p>

	<p>The only time a bridesmaid will pay both the 6% sales tax &amp; the $25 shipping fee is if we are shipping the dress to an address within the District of Columbia.</p>

	<p>If we ship the dress to you, the package will require a signature. Although we strongly recommend shipping the dress with 'signature required', you may choose to waive this requirement by initialing here  <input type="text" name="signature-waiver-initials" size="<?php echo strlen($signature_waiver_initials); ?>" value="<?php echo $signature_waiver_initials; ?>"> and the package will be delivered at your door. <strong>Hitched Maids will not be responsible for packages left without a signature.</strong></p>

	<h3>Measurements:</h3>
	<p><label>Bust (fullest part of your bust while wearing a bra, with your arms at your sides: <input type="text" name="maids-bust" size="<?php echo strlen($maids_bust); ?>" value="<?php echo $maids_bust; ?>"></label></p>
	<p><label>Natural Waist (smallest part of your waist, a few inches above your belly button): <input type="text" name="maids-waist" size="<?php echo strlen($maids_waist); ?>" value="<?php echo $maids_waist; ?>"></label></p>
	<p><label>Hip (taken at the widest place on your hips including your butt!): <input type="text" name="maids-hip" size="<?php echo strlen($maids_hip); ?>" value="<?php echo $maids_hip; ?>"></label></p>

	<p>Please take all measurements in inches.</p>

	<div class="flex-fields">
		<label>Height: <input type="text" name="maids-height" size="<?php echo strlen($maids_height); ?>" value="<?php echo $maids_height; ?>"></label>
		<label>What size do you normally wear in street clothing? <input type="text" name="maids-street-size" size="<?php echo strlen($maids_street_size); ?>" value="<?php echo $maids_street_size; ?>"></label>
	</div>

	<p>You must select a size and provide your measurements above. Base your size selection on the designer’s size chart available through Hitched Maids. Please note that dresses are not made to measure and will require alterations.</p>

	<div class="flex-fields">
		<label>Dress Order Size: <input type="text" name="maids-dress-size" size="<?php echo strlen($maids_dress_size); ?>" value="<?php echo $maids_dress_size; ?>"></label>
		<label>Initial that you have used the corresponding designer's size chart: <input type="text" name="size-chart-initials" size="<?php echo strlen($size_chart_initials); ?>" value="<?php echo $size_chart_initials; ?>"></label>
	</div>

	<h3>Dress Information:</h3>
	<div class="flex-fields">
		<label>Designer: <input type="text" name="maids-dress-designer" size="<?php echo strlen($maids_dress_designer); ?>" value="<?php echo $maids_dress_designer; ?>"></label>
		<label>Dress Style Name/Number: <input type="text" name="maids-dress-style" size="<?php echo strlen($maids_dress_designer); ?>" value="<?php echo $maids_dress_designer; ?>"></label>
		<label>Material: <input type="text" name="maids-dress-material" size="<?php echo strlen($maids_dress_material); ?>" value="<?php echo $maids_dress_material; ?>"></label>
		<label>Color: <input type="text" name="maids-dress-color" size="<?php echo strlen($maids_dress_color); ?>" value="<?php echo $maids_dress_color; ?>"></label>
		<label>Extra Length? <input type="text" name="maids-dress-extra-length" size="<?php echo strlen($maids_dress_extra_length); ?>" value="<?php echo $maids_dress_extra_length; ?>"></label>
	</div>

	<p>Please note that if you are 5’8” or taller and ordering a full length dress, you may need extra length. It is your responsibility to contact Hitched Maids with questions and pricing information, and to note this modification on the line above. If left blank, the dress will be ordered with standard length.</p>

	<p>I have read and agree to the above information. I authorize Hitched Maids to place this order on my behalf upon payment in full for the total cost of the bridesmaids’ gown.</p>

	<div class="flex-fields">
		<label>Signature: <input type="text" name="maids-signature" size="<?php echo strlen($maids_signature); ?>" value="<?php echo $maids_signature; ?>"></label>
		<label>Date: <input type="date" name="signature-date" size="<?php echo strlen($signature_date); ?>" value="<?php echo $signature_date; ?>"></label>
	</div>

	<?php if (!empty($maid_comments)): ?>
	<h3 style="page-break-before: always;">Additional Comments:</h3>
	<p><?php echo nl2br($maid_comments); ?></p>
	<?php endif; ?>
</form>
