<?php
/**
 * Register Custom Widget Area.
 *
 * This function currently has a pretty ugly hack that
 * should be dealt with before publicly-release. The
 * "after_title" argument opens a div with a class attr
 * of "dropdown" which is then closed by the "after_widget"
 * argument. This is totally hack-tacular and was done
 * because I am lazy and just wanted to see this thing work.
 *
 * Patches welcome!
 */

function poc_widget_dropdowns_widgets_init() {
	register_sidebar( array(
		'name'          => 'Dropdowns',
		'id'            => 'dropdowns',
		'description'   => 'Dropdowns that appear at the top of the page on all views.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="trigger">',
		'after_title'   => '</h3><div class="dropdown">',
	) );
}
add_action( 'widgets_init', 'poc_widget_dropdowns_widgets_init' );

function poc_widget_dropdowns_scripts() {
	wp_enqueue_script(
		'dropdown-widgets',
		get_stylesheet_directory_uri() . '/dropdowns.js',
		array( 'jquery' ),
		'0.1',
		true
	);
}
add_action( 'wp_print_scripts', 'poc_widget_dropdowns_scripts' );