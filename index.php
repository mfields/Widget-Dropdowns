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
		<link rel="stylesheet" src="<?php print get_stylesheet_uri(); ?>">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		
		<style>
		body {
			padding:0;
			margin:0;
		}
		#dropdowns {
			font-family:arial,sans-serif;
			background:#333;
			position:relative;
			z-index:1;
			margin:0;
			padding:0;
			color:#ccc;
			float:left;
		}
		#dropdowns ul,
		#dropdowns ol {
			list-style-position:inside;
			padding:0 0 0 .5em;
			margin:0;
		}
		#dropdowns .dropdown {
			position:absolute;
			z-index:0;
			background:#555;
			width:200px;
			padding:.5em 1em 1em;
		}
		#dropdowns .widget,
		#dropdowns .widget h3 {
			float:left;
		}
		#dropdowns .widget h3 {
			background: #222;
			height:20px;
			margin:0;
			padding:15px; 10px;
			cursor:pointer;
		}
		#dropdowns .widget h3::selection {
			background: transparent; /* Safari */
		}
		#dropdowns .widget h3::-moz-selection {
			background: transparent; /* Firefox */
		}
		</style>
	</head>
	<body>

	<div id="dropdowns">
		<?php dynamic_sidebar( 'dropdowns' ); ?>
		<div style="clear:both;"></div>
	</div>

	<script>
		jQuery( document ) .ready( function( $ ) {
			var dropdowns = $( '#dropdowns' );			
			var links     = dropdowns.find( '.trigger' );
			var boxen     = dropdowns.find( '.dropdown' );
			var status    = 'closed';
			var origin    = {
				top  : '-1599980px',
				left : '-1599980px'
			};
			
			/* Reposition all boxen. */
			hideAllBoxen();
			
			$( document ).click( function( e ) {

				var link = $( e.target );
				
				if ( link.hasClass( 'trigger' ) ) {
					var box = link.next();
					var boxPosition = {
						top  : box.css( 'top' ),
						left : box.css( 'left' )
					};
					var linkPosition = link.position();

					/*
					 * Each time a link is clicked we need to
					 * reposition all of the boxen. This enables
					 * the box currently on display to be hidden
					 * when a user is clicking from link to link.
					 */
					hideAllBoxen();

					/*
					 * Toggle effect.
					 * This enables a single link to be clicked
					 * once to show a box and then clicked again
					 * to hide the box.
					 */
					if ( origin.top !== boxPosition.top && origin.left !== boxPosition.left ) {
						hideAllBoxen();
						return;
					}

					var css = {
						top : dropdowns.height() + 'px'
					};
					
					box.rightEdge = Math.ceil( box.outerWidth() + linkPosition.left );
					
					if ( box.rightEdge > dropdowns.innerWidth() ) {
						css.left = Math.ceil( dropdowns.outerWidth() - box.outerWidth() ) + 'px';
					}
					else {
						css.left = Math.ceil( parseInt( linkPosition.left ) ) + 'px';
					}
					
					/*
					 * Show box.
					 * Positions the requested box directly under
					 * the dropdowns div, left-aligned with the link.
					 */
					box.css( css );

					status = 'active';
					return;
				}

				/*
				 * All boxen are hidden.
				 * There is no need to continue.
				 */
				if ( 'closed' === status ) {
					return;
				}

				/*
				 * A box is being displayed.
				 * Somewhere outside of the box was clicked.
				 * We need to hide all of the boxen.
				 */
				if ( 0 === link.closest( '.box' ).length ) {
					hideAllBoxen();
					return;
				}

			} );
			
			function hideAllBoxen() {
				boxen.each( function( i, e ) {
					$( e ).css( origin );
				} );
				status = 'closed';
			}
		} );
		</script>
	</body>
</html>




















