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
		<div class="site-width uppercase tc"><a class="appointments-button filo--lin no-underline" href="mailto:info@hitchedsalon.com">Book Appointment</a></div>
	</header><!-- .site-header -->
	<a id="logo" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Hitched Salon"></a>
	<div class="menu-container wide"><?php wp_nav_menu(array(
		'theme_location' => 'primary',
		'container' => 'nav',
		'container_id' => 'main-menu',
		'container_class' => 'site-width uppercase filo--lin',
		'menu_class' => 'nav-menu horizontal-list',
	)); ?></div>
	<div class="menu-container narrow"><button class="burger clean-button no-text single-background classnameToggler" data-target="burger-menu" data-classname="visible">Toggle menu</button></div>
	<?php wp_nav_menu(array(
		'theme_location' => 'primary',
		'container' => 'nav',
		'container_id' => 'burger-menu',
		'container_class' => 'uppercase tc filo--lin',
		'menu_class' => 'nav-menu',
	)); ?>
	<div id="content" class="site-content">
