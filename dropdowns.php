<?php
/**
 * Dropdown Template Part.
 *
 * This file will renders a dropdown user interface.
 * The contents of the UI are determained by the theme features
 * currently activated by the user. The following interfaces will
 * may be generated - listed in precedence of lowest to highest:
 *
 * Page Menu.
 *
 * Renders hierarchical page navigation.
 * All published page title should be displayed.
 * This is the default and should be rendered the
 * first time that theme is activated for all users.
 *
 * Widget Area.
 *
 * In the event that a user has added one or more widgets
 * to the widget area labeld "Dropdowns" these widgets will
 * be used to create the dropdowns. The Widget's title will
 * be used as button text and the remains bits of the widget
 * will be rendered inside the dropdown. This will override
 * the "Page Menu" UI.
 *
 * Custom Menu
 *
 * In cases where the user has added a custom menu to the theme
 * location labeled "Dropdowns" the custom menu will be rendered
 * as the dropdown. This will override both the "Page Menu" and
 * "Widget Area" UIs.
 *
 * This template should be called using the following code:
 * <?php get_template_part( 'dropdowns' ); ?>
 */

$config = array(
	'after'  => '</span>',
	'before' => '<span>',
	'class'  => 'newDropdown',
	'id'     => 'dropdowns',
);
?>

<?php if ( has_nav_menu( $config['id'] ) ) : ?>

	<!-- Dropdowns: Nav Menu. -->
	<?php wp_nav_menu( array(
		'container_class' => $config['class'],
		'link_after'      => $config['after'],
		'link_before'     => $config['before'],
		'theme_location'  => $config['id'],
	) ); ?>

<?php elseif ( is_active_sidebar( $config['id'] ) ) : ?>

	<!-- Dropdowns: Widget Area. -->
	<?php dynamic_sidebar( $config['id'] ); ?>

<?php else : ?>

	<!-- Dropdowns: Page Menu. -->
	<?php wp_page_menu( array(
		'link_after'  => $config['after'],
		'link_before' => $config['before'],
		'menu_class'  => $config['class'],
	) ); ?>

<?php endif; ?>
