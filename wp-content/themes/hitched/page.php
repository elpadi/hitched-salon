<?php get_header(); the_post(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php the_post_thumbnail('full'); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(['site-width']); ?>>
				<header>
					<h1 class="page-title cursive light tc lowercase"><?php single_post_title(); ?></h1>
				</header>
				<div class="entry-content tc"><?php the_content(); ?></div><!-- .entry-content -->
				<?php set_query_var('app', \Hitched\Hitched::instance()); get_template_part("pages/$post->post_name"); ?>
			</article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>
