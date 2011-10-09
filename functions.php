<?php


/**
 * Register Custom Widget Area.
 */
function poc_widget_dropdowns_widgets_init() {
	register_sidebar( array(
		'name'          => 'Dropdowns',
		'id'            => 'dropdowns',
		'description'   => 'Dropdowns that appear at the top of the page on all views.',
		'before_widget' => '<div id="%1$s" class="dropdown widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'poc_widget_dropdowns_widgets_init' );


/**
 * Javascript.
 */
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


/**
 * Menu.
 */
register_nav_menu( 'primary', 'Primary' );