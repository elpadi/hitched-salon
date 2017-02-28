<?php
/**
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 */
get_header();
the_post();
$images = get_attached_media('image');
$titles = array_map(function($img) { return $img->post_title; }, $images);
array_multisort($titles, SORT_ASC, SORT_REGULAR, $images);
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php the_post_thumbnail('full'); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(['site-width']); ?>>
				<header>
					<h1 class="page-title screen-reader-text cursive light tc lowercase"><?php single_post_title(); ?></h1>
				</header>
				<div class="entry-content tc"><?php the_content(); ?></div><!-- .entry-content -->
<section id="home-gallery" class="slideshow">
	<div class="slideshow__images">
		<?php foreach (array_filter($images, function($img) { return strpos($img->post_title, 'Gallery') === 0; }) as $img): ?>
		<img class="slideshow__image" src="<?php echo $img->guid; ?>" alt="">
		<?php endforeach; ?>
	</div>
</section>
<section id="page-callouts" class="grid prox--light tc uppercase" data-col-count="3">
	<?php $i = 0; foreach (array_filter($images, function($img) { return strpos($img->post_title, 'Gallery') !== 0; }) as $img): ?>
	<article class="grid__item last-row">
		<div class="background single-background" style="background-image:url(<?php echo $img->guid; ?>);">&nbsp;</div>
		<a class="foreground" href="<?php echo home_url(get_post_meta($img->ID, '_wp_attachment_image_alt', true)); ?>">
			<div class="background overlay">&nbsp;</div>
			<span class="foreground"><?php echo $img->post_title; ?></span>
		</a>
	</article>
	<?php $i++; endforeach; ?>
</section>
			</article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer();