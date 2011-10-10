<?php
/**
 * Dropdown Template [DEBUG].
 *
 * This template part will print each state of the dropdown
 * directly to the screen. It is useful only for debugging
 * purposes and should not be used in production.
 */

$config = array(
	'after'  => '</span>',
	'before' => '<span>',
	'class'  => 'newDropdown',
	'id'     => 'dropdowns',
);
?>

<h1>Widget Dropdowns</h1>

<h2>Widgetized Area</h2>

<div id="dropdown-widgets">
	<?php dynamic_sidebar( $config['id'] ); ?>
</div>

<h2>Custom Menu</h2>

<?php wp_nav_menu( array(
	'container_class' => $config['class'],
	'link_after'      => $config['after'],
	'link_before'     => $config['before'],
	'theme_location'  => $config['id'],
) ); ?>

<h2>Page Menu</h2>

<?php wp_page_menu( array(
	'link_after'  => $config['after'],
	'link_before' => $config['before'],
	'menu_class'  => $config['class'],
) ); ?>