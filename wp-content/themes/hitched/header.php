<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="site-width"><a class="appointments-button no-underline uppercase tc fr" href="/appointments">Book Appointment</a></div>
	</header><!-- .site-header -->
	<a id="logo" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Hitched Salon"></a>
	<div class="menu-container"><?php wp_nav_menu(array(
		'theme_location' => 'primary',
		'container' => 'nav',
		'container_id' => 'main-menu',
		'container_class' => 'site-width uppercase',
		'menu_class' => 'nav-menu horizontal-list',
	)); ?></div>
	<div id="content" class="site-content site-width">
