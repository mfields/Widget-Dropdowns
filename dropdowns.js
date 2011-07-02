jQuery( document ) .ready( function( $ ) {

	var config = {
		container : '#dropdown-widgets',
		dropdowns : '.dropdown',
		triggers  : '.widget-title'
	};

	var widgets = $( config.container );
	var parent  = widgets.parent();
	var titles  = widgets.find( config.triggers );
	var boxen   = widgets.find( config.dropdowns );
	var active  = null;
	var origin  = {
		top  : '-1599980px',
		left : '-1599980px'
	};

	var dropdowns = $( document.createElement( 'div' ) );
	dropdowns.attr( 'id', 'dropdowns' );

	$( document ).bind( 'dropdownsLoaded', function() {
		widgets.remove();
		parent.prepend( dropdowns );
	} );

	var triggers = [];
	titles.each( function ( i, e ) {
		var title = $( e );
		if ( '' === title.text().trim() ) {
			return;
		}

		var trigger = $( document.createElement( 'a' ) );
		trigger.text( title.text() );
		trigger.attr( 'href', '' );
		trigger.addClass( 'trigger' );
		trigger.appendTo( dropdowns );

		triggers.push( trigger );

		var widget = title.parent();
		title.remove();

		widget.appendTo( dropdowns );

		if ( i + 1 === titles.length ) {
			$( document ).trigger( 'dropdownsLoaded' );
		}
	} );

	/*
	 * Height of the container.
	 * This needs to be calculated after the container
	 * is repositioned.
	 */
	var height = dropdowns.outerHeight();

	$( window ).bind( 'resize', function ( e ) {
		if ( null === active ) {
			return;
		}

		/*
		 * Stick the active box to the bottom of the container.
		 */
		active.box.css( { top : dropdowns.outerHeight() } );
		height = dropdowns.outerHeight();

		/*
		 * The active box should not be cut-off when browser window shrinks.
		 */
		var boxPos = active.box.position();
		var triggerPos = active.trigger.position();
		var rightEdge = boxPos.left + active.box.outerWidth();

		if ( rightEdge > parent.innerWidth() ) {
			active.box.css( { left : ( parent.innerWidth() - active.box.outerWidth() ) + 'px' } );
		}

		/*
		if ( Math.floor( triggerPos.left ) !== boxPos.left ) {
			active.box.css( { left : Math.floor( triggerPos.left ) + 'px' } );
		}
		*/

	} );

	/* Reposition all boxen. */
	hideAllBoxen();

	$( document ).click( function( e ) {

		/*
		 * Primary mouse button pressed.
		 * @todo See how this works with touch screen devices.
		 */
		if ( 1 != e.which ) {
			return;
		}

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
				return false;
			}

			var css = {
				top : height + 'px'
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

			active = {};
			active.box = box;
			active.trigger = link;

			return false;
		}

		/*
		 * All boxen are hidden.
		 * There is no need to continue.
		 */
		if ( null === active ) {
			return;
		}

		/*
		 * A box is being displayed.
		 * Somewhere outside of the box was clicked.
		 * We need to hide all of the boxen.
		 */
		if ( 0 === link.closest( config.dropdowns ).length ) {
			hideAllBoxen();
			return;
		}

	} );

	function hideAllBoxen() {
		boxen.each( function( i, e ) {
			$( e ).css( origin );
		} );
		active = null;
	}
} );