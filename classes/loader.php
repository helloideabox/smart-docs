<?php

/**
 * Responsible for setting up constants, classes and templates.
 *
 * @author  IdeaBox
 * @package EasyDoc/Loader
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All function loads from this class Easy_Doc_Loader.
 */
class  Easy_Doc_Loader {

	/**
	 * Custom post type variable for registering taxonomy.

	 * @var post_type
	 */
	public $cpt_name = 'easy-doc';

	/**
	 * For automatically loading action and filters.
	 */
	public function __construct() {

		// Action to include script.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Function to enque scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		global $post_type;

		if ( 'easy-doc' === $post_type ) {
			wp_enqueue_style( 'ed-style', EASY_DOCS_URL . 'assets/css/style.css', array(), '1.0.0', false );

			// condition to check for live search enabled.
			if ( get_option( 'ed_enable_live_search' ) ) {
				wp_enqueue_script( 'ed-searchbox-script', EASY_DOCS_URL . 'assets/js/search-script.js', array(), '1.0.0', true );

				wp_localize_script(
					'ed-searchbox-script',
					'ed_ajax_url',
					array(
						'url'        => admin_url( 'admin-ajax.php' ),
						'ajax_nonce' => wp_create_nonce( 'docs_search' ),
					)
				);
			}
		}
	}

	
}

$easydoc = new Easy_Doc_Loader();
