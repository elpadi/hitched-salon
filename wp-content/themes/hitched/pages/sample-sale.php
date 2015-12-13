<?php
use Hitched\Hitched as H;
$ids = array_map(function($img) { return $img->ID; }, array_filter(get_attached_media('image'), function($img) { return !empty($img->post_excerpt); }));
$images = H::instance()->customPostsQuery($ids, ['text' => ['_wp_attachment_metadata']]);
$titles = array_map(function($img) { return $img->post_title; }, $images);
array_multisort($titles, SORT_ASC, SORT_REGULAR, $images);
?>
<h1 class="page-title cursive light tc lowercase">Gowns</h1>
<div class="designers-gallery">
	<?php for ($colcount = 3; $colcount > 1; $colcount--): ?><ul class="horizontal-list tc col-<?php echo $colcount; ?>">
		<?php foreach ($images as $i => $img): $metadata = unserialize($img->_wp_attachment_metadata); $thumbnail = str_replace(wp_basename($metadata['file']), $metadata['sizes']['medium']['file'], $img->guid); ?>
		<li data-col-index="<?php echo $i % $colcount; ?>" class="<?php echo $metadata['width'] / $metadata['height'] > 1 ? 'landscape' : 'portrait'; ?>"><a class="no-underline no-color" data-lightbox="sample-sale" data-title="<?php echo $img->post_excerpt; ?>" href="<?php echo $img->guid; ?>"><img src="<?php echo $thumbnail; ?>" alt=""><span><?php echo $img->post_title; ?><br><?php echo $img->post_excerpt; ?><br>(<?php echo $img->post_content; ?>)</span></a></li>
		
		<?php if ($i % $colcount === $colcount - 1) echo '<li class="break">&nbsp;</li>'; endforeach; ?>
		<?php /* $i = 0; $cp = count($by_size['portrait']); $cl = count($by_size['landscape']); while ($cp > 0 || $cl > 0): if (($i !== 1 && $cl > 0) || ($i === 1 && $cp > 0)): $img = array_shift($by_size[$i === 1 ? 'portrait' : 'landscape']); ?>
		<li data-col-index="<?php echo $i; ?>"><a class="no-underline no-color" data-lightbox="sample-sale" data-title="<?php echo $img->post_excerpt; ?>" href="<?php echo $img->guid; ?>"><img src="<?php echo $img->thumbnail; ?>" alt=""><span><?php echo $img->post_title; ?><br><?php echo $img->post_excerpt; ?><br>(<?php echo $img->post_content; ?>)</span></a></li>
		<?php if ($i === 2): ?><li class="break">&nbsp;</li><?php endif; endif; ?>
		<?php $i = ($i + 1) % 3; $cp = count($by_size['portrait']); $cl = count($by_size['landscape']); endwhile; */ ?>
	</ul><?php endfor; ?>
	<a class="scroll-button prox--light bold uppercase no-underline no-color" href="#content">Back to top</a>
</div>
