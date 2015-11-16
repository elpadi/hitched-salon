	</div><!-- .site-content -->
	<?php wp_nav_menu(array(
		'theme_location' => 'secondary',
		'container' => 'nav',
		'container_id' => 'pages-menu',
		'container_class' => 'menu-container uppercase tc',
		'menu_class' => 'nav-menu horizontal-list',
	)); ?>
	<footer id="colophon" class="site-footer uppercase tc" role="contentinfo">
		<div class="site-width"><?php dynamic_sidebar('footer'); ?></div>
	</footer><!-- .site-footer -->
</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>
