<?php
/**
 * Structured Data Class.
 *
 * Responsible for generating structured data.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Structure data class.
 */
class Structured_Data {
	/**
	 * Stores the structured data.
	 *
	 * @access private
	 * @since 1.0.0
	 * @var array $_data Array of structured data.
	 */
	private $_data = array();

	/**
	 * Class constructor.
	 */
	public function __construct() {
		// Generate structured data.
		add_action( 'smartdocs_breadcrumb', array( $this, 'generate_breadcrumblist_data' ), 10 );
		// Output structured data.
		add_action( 'wp_footer', array( $this, 'output_structured_data' ), 10 );
	}

	/**
	 * Sets data.
	 *
	 * @since 1.0.0
	 * @param  array $data  Structured data.
	 * @param  bool  $reset Unset data (default: false).
	 * @return bool
	 */
	public function set_data( $data, $reset = false ) {
		if ( ! isset( $data['@type'] ) || ! preg_match( '|^[a-zA-Z]{1,20}$|', $data['@type'] ) ) {
			return false;
		}

		if ( $reset && isset( $this->_data ) ) {
			unset( $this->_data );
		}

		$this->_data[] = $data;

		return true;
	}

	/**
	 * Gets data.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_data() {
		return $this->_data;
	}

	/**
	 * Structures and returns data.
	 *
	 * List of types available by default for specific request:
	 *
	 * 'breadcrumblist',
	 *
	 * @since 1.0.0
	 * @param  array $types Structured data types.
	 * @return array
	 */
	public function get_structured_data( $types ) {
		$data = array();

		// Put together the values of same type of structured data.
		foreach ( $this->get_data() as $value ) {
			$data[ strtolower( $value['@type'] ) ][] = $value;
		}

		// Wrap the multiple values of each type inside a graph... Then add context to each type.
		foreach ( $data as $type => $value ) {
			$data[ $type ] = count( $value ) > 1 ? array( '@graph' => $value ) : $value[0];
			$data[ $type ] = apply_filters( 'smartdocs_structured_data_context', array( '@context' => 'https://schema.org/' ), $data, $type, $value ) + $data[ $type ];
		}

		// If requested types, pick them up... Finally change the associative array to an indexed one.
		$data = $types ? array_values( array_intersect_key( $data, array_flip( $types ) ) ) : array_values( $data );

		if ( ! empty( $data ) ) {
			if ( 1 < count( $data ) ) {
				$data = apply_filters( 'smartdocs_structured_data_context', array( '@context' => 'https://schema.org/' ), $data, '', '' ) + array( '@graph' => $data );
			} else {
				$data = $data[0];
			}
		}

		return $data;
	}

	/**
	 * Get data types for pages.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	protected function get_data_type_for_page() {
		$types   = array();
		$types[] = 'breadcrumblist';

		return $types;
	}

	/**
	 * Sanitizes, encodes and outputs structured data.
	 *
	 * Hooked into `wp_footer` action hook.
	 *
	 * @since 1.0.0
	 */
	public function output_structured_data() {
		$types = $this->get_data_type_for_page();
		$data  = $this->get_structured_data( $types );

		if ( $data ) {
			echo '<script type="application/ld+json">' . $this->esc_json( wp_json_encode( $data ), true ) . '</script>'; // WPCS: XSS ok.
		}
	}

	/**
	 * Escape JSON for use on HTML or attribute text nodes.
	 *
	 * @since 1.0.0
	 * @param string $json JSON to escape.
	 * @param bool   $html True if escaping for HTML text node, false for attributes. Determines how quotes are handled.
	 * @return string Escaped JSON.
	 */
	protected function esc_json( $json, $html = false ) {
		return _wp_specialchars(
			$json,
			$html ? ENT_NOQUOTES : ENT_QUOTES, // Escape quotes in attribute nodes only.
			'UTF-8',                           // json_encode() outputs UTF-8 (really just ASCII), not the blog's charset.
			true                               // Double escape entities: `&amp;` -> `&amp;amp;`.
		);
	}

	/**
	 * Generates BreadcrumbList structured data.
	 *
	 * Hooked into `smartdocs_breadcrumb` action hook.
	 *
	 * @since 1.0.0
	 * @param SmartDocs\Breadcrumb $breadcrumbs Breadcrumb data.
	 */
	public function generate_breadcrumblist_data( $breadcrumbs ) {
		$crumbs = $breadcrumbs->get_breadcrumb();

		if ( empty( $crumbs ) || ! is_array( $crumbs ) ) {
			return;
		}

		$markup                    = array();
		$markup['@type']           = 'BreadcrumbList';
		$markup['itemListElement'] = array();

		foreach ( $crumbs as $key => $crumb ) {
			$markup['itemListElement'][ $key ] = array(
				'@type'    => 'ListItem',
				'position' => $key + 1,
				'item'     => array(
					'name' => $crumb[0],
				),
			);

			if ( ! empty( $crumb[1] ) ) {
				$markup['itemListElement'][ $key ]['item'] += array( '@id' => $crumb[1] );
			} elseif ( isset( $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'] ) ) {
				$current_url = set_url_scheme( 'http://' . wp_unslash( $_SERVER['HTTP_HOST'] ) . wp_unslash( $_SERVER['REQUEST_URI'] ) ); // @codingStandardsIgnoreLine.

				$markup['itemListElement'][ $key ]['item'] += array( '@id' => $current_url );
			}
		}

		$this->set_data( apply_filters( 'smartdocs_structured_data_breadcrumblist', $markup, $breadcrumbs ) );
	}
}
