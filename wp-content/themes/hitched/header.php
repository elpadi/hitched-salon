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
		<a class="appointments-button no-underline uppercase tc fr" href="/appointments">Book Appointments</a>
	</header><!-- .site-header -->
	<?php wp_nav_menu(array(
		'theme_location' => 'primary',
		'container' => 'nav',
		'container_id' => 'main-menu',
		'container_class' => 'menu-container uppercase',
		'menu_class' => 'nav-menu horizontal-list',
	)); ?>
	<div id="content" class="site-content">
