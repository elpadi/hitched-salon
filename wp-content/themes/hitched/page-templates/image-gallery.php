<?php
/**
 * Template Name: Image Gallery
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 */
get_header();
the_post();
$images = array_filter(get_attached_media('image'), function($img) { return !empty($img->post_excerpt); });
$titles = array_map(function($img) { return $img->post_title; }, $images);
array_multisort($titles, SORT_ASC, SORT_REGULAR, $images);
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php the_post_thumbnail('full'); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(['site-width']); ?>>
				<header>
					<h1 class="page-title cursive light tc lowercase"><?php single_post_title(); ?></h1>
				</header>
				<div class="entry-content tc"><?php the_content(); ?></div><!-- .entry-content -->
				<div class="designers-gallery">
					<ul class="horizontal-list tc">
						<?php foreach ($images as $img): ?>
						<li><a class="no-underline no-color" target="_blank" href="<?php echo $img->post_excerpt; ?>"><img src="<?php echo $img->guid; ?>" alt=""><span><?php echo $img->post_title; ?></span></a></li>
						<?php endforeach; ?>
					</ul>
					<a class="scroll-button prox--light bold uppercase no-underline no-color" href="#content">Back to top</a>
				</div>
			</article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>
