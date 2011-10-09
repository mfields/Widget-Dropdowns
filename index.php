<?php

/**
 * Widget Dropdowns.
 *
 * @todo Move all "positioning" and "sizing" styles into js.
 */

?><!doctype html>
<html lang="en">
	<head>
		<title>Widget Dropdowns</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php print get_stylesheet_uri(); ?>" media="all">
		<?php wp_head(); ?>
	</head>
	<body>

		<div id="container">

			<h1>Widget Dropdowns</h1>

			<h2>Widgetized Area</h2>

			<div id="dropdown-widgets">
				<?php  #dynamic_sidebar( 'dropdowns' ); ?>
			</div>

			<h2>Custom Menu</h2>

			<?php wp_nav_menu( array(
				'container_class' => 'newDropdown',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'theme_location'  => 'primary',
			) ); ?>

			<h2>Page Menu</h2>

			<?php wp_page_menu( array(
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'menu_class'  => 'newDropdown',
			) ); ?>

		</div>

		<?php wp_footer(); ?>

	</body>
</html>