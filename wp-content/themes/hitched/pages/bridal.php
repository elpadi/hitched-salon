<?php
$images = array_filter(get_attached_media('image'), function($img) { return !empty($img->post_excerpt); });
$titles = array_map(function($img) { return $img->post_title; }, $images);
array_multisort($titles, SORT_ASC, SORT_REGULAR, $images);
?>
<div class="designers-gallery">
	<ul class="horizontal-list tc">
		<?php foreach ($images as $img): ?>
		<li><a class="no-underline no-color" target="_blank" href="<?php echo $img->post_excerpt; ?>"><img src="<?php echo $img->guid; ?>" alt=""><span><?php echo $img->post_title; ?></span></a></li>
		<?php endforeach; ?>
	</ul>
	<a class="scroll-button prox--light bold uppercase no-underline no-color" href="#content">Back to top</a>
</div>
