<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header><h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1></header>
			<?php the_post(); set_query_var('app', \Hitched\Hitched::instance()); get_template_part("pages/$post->post_name"); ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>
