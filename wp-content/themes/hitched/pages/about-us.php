<h2>Meet The Team</h2>
<?php foreach (get_posts(['post_type' => $app::prefix('team'), 'posts_per_page' => -1, 'order' => 'ASC']) as $person): ?>
<article class="team-member">
	<?php echo get_the_post_thumbnail($person->ID); ?>
	<section class="info"><?php echo apply_filters('the_content', $person->post_content); ?></section>
</article>
<?php endforeach; ?>
