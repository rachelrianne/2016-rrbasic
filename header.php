<!DOCTYPE html>

<!--[if lt IE 7]> 
<html id="lt-ie7" lang="en"> 
<![endif]-->
<!--[if IE 7]>
<html id="ie7" lang="en">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" lang="en">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) ]><!--> 
<html lang="en"> 
<!--<![endif]-->
	<head>
	  <meta charset="utf-8">
	  <!-- PAGE TITLE -->		
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link rel="icon" type="image/png" href="http://EXAMPLE.com/favicon.png" />
		<!-- CSS -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/stylesheets/css/screen.css"/>
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie.css">
		<![endif]-->
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<!-- IE Fix (JS) for HTML5 Tags -->
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
		<div id="wrapper">
			<header id="site-header" class="row">
				<h1 id="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>

				<nav class="main-nav" role="navigation">
					<?php wp_nav_menu(array('theme_location' => 'main_nav', 'container' => false)); ?>
				</nav><!-- #main-nav -->
			</header>