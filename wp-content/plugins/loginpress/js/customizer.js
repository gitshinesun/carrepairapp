/**
 * Customizer Communicator
 *
 * @since 1.0.23
 */
( function ( exports, $ ) {
	"use strict";

	var api = wp.customize, OldPreviewer;

	// Custom Customizer Previewer class (attached to the Customize API)
	api.myCustomizerPreviewer = {
		// Init
		init: function () {
			var self = this; // Store a reference to "this" in case callback functions need to reference it

			// Listen to the "customize-section-back" event for removing 'active' class from customize-partial-edit-shortcut.

			$(document).on( 'click', '.customize-section-back', function() {
				$('#customize-preview iframe').contents().find('.loginpress-partial.customize-partial-edit-shortcut').each( function(){
					$(this).removeClass('active');
				} );
			} );
		}
	};


	/**
	 * Capture the instance of the Preview since it is private (this has changed in WordPress 4.0)
	 */
	OldPreviewer = api.Previewer;
	api.Previewer = OldPreviewer.extend( {
		initialize: function( params, options ) {
			// Store a reference to the Previewer
			api.myCustomizerPreviewer.preview = this;

			// Call the old Previewer's initialize function
			OldPreviewer.prototype.initialize.call( this, params, options );
		}
	} );

	// Document Ready
	$( function() {
		// Initialize our Previewer
		api.myCustomizerPreviewer.init();
	} );
} )( wp, jQuery );
