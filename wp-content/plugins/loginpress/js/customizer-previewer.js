/**
 * Customizer Previewer
 * @since 1.0.23
 */
( function ( wp, $ ) {
	"use strict";

	// Bail if the customizer isn't initialized
	if ( ! wp || ! wp.customize ) {
		return;
	}

	var api = wp.customize, OldPreview;

	// Custom Customizer Preview class (attached to the Customize API)
	api.myCustomizerPreview = {
		// Init
		init: function () {

				var $body = $( 'body'),
				$body_bg 	= $( '#login h1'),
				$form			= $( '#login form'),
				$document = $( document ); // Store references to the body and document elements

				// Append our button to the <body> element
				$body_bg.append( '<span class="loginpress-logo-partial loginpress-partial customize-partial-edit-shortcut" title="Change Logo"><button class="loginpress-event-button customize-partial-edit-shortcut-button" data-customizer-event="customize_logo_section"><span class="dashicons dashicons-edit"></span></button></span>' );

				$body.append( '<span class="loginpress-presets-partial loginpress-partial customize-partial-edit-shortcut" title="Change Template"><button class="loginpress-event-button customize-partial-edit-shortcut-button" data-customizer-event="customize_presets"><span class="dashicons dashicons-admin-appearance"></span></button></span>' );

				$body.append( '<span class="loginpress-background-partial loginpress-partial customize-partial-edit-shortcut" title="Change Background"><button class="loginpress-event-button customize-partial-edit-shortcut-button" data-customizer-event="section_background"><span class="dashicons dashicons-images-alt"></span></button></span>' );

				$body.append( '<span class="loginpress-footer-partial loginpress-partial customize-partial-edit-shortcut" title="Change Footer"><button class="loginpress-event-button customize-partial-edit-shortcut-button" data-customizer-event="section_fotter"><span class="dashicons dashicons-edit"></span></button></span>' );

				// $form.append( '<span class="loginpress-form-partial loginpress-partial customize-partial-edit-shortcut"><button class="loginpress-event-button customize-partial-edit-shortcut-button" data-customizer-event="section_form"><span class="dashicons dashicons-edit"></span></button></span>' );

				/**
				 * Listen for events on the LoginPress previewer button
				 */
				$document.on( 'touch click', '.loginpress-partial.customize-partial-edit-shortcut', function( e ) {

					var $el 		= $(this),
					$event 			= $el.children().data('customizer-event'),
					$title 			= ' .accordion-section-title',
					$panel 			= '#accordion-panel-loginpress_panel' + $title,
					$section 		= '#accordion-section-' + $event + $title,
					$customizer = parent.document;

						if( !$el.hasClass( "active" ) ) {

							$( $panel, $customizer ).trigger('click');
							$( $section, $customizer ).trigger('click');
						}

						$('.loginpress-partial.customize-partial-edit-shortcut').removeClass( 'active' );
						$el.addClass( 'active' );
				} );

				/**
				 * Prevent logo link for customizer
				 */
				$document.on( 'click touch', '.login h1 a', function( e ) {
					e.preventDefault();
				});

				/**
				 * Prevent Submit Button for customizer
				 */
				$document.on( 'click touch', '.submit', function( e ) {
					e.preventDefault();
				});
		}
	};

	/**
	 * Capture the instance of the Preview since it is private (this has changed in WordPress 4.0)
	 */
	OldPreview = api.Preview;
	api.Preview = OldPreview.extend( {
		initialize: function( params, options ) {
			// Store a reference to the Preview
			api.myCustomizerPreview.preview = this;

			// Call the old Preview's initialize function
			OldPreview.prototype.initialize.call( this, params, options );
		}
	} );

	// Document ready
	$( function () {
		// Initialize our Preview
		api.myCustomizerPreview.init();
	} );
} )( window.wp, jQuery );
