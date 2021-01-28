<?php
/**
 * Class to filter post content.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Template class.
 */
class Content {

	/**
	 * Post Content
	 *
	 * @var string $post_content.
	 */
	public $content = null;

	/**
	 * Toc Data
	 *
	 * @var array $toc_data.
	 */
	public $toc_data = array();

	/**
	 * Class constructor.
	 *
	 * Responsible for loading all the required methods and actions/filters
	 * in the class when it is instantiated.
	 */
	public function __construct() {
		add_action( 'template_redirect', array( $this, 'init_content' ) );
	}

	/**
	 * Init Content.
	 */
	public function init_content() {
		if ( \is_smartdocs_single() ) {
			global $post;

			$this->content = $post->post_content;
			$this->filter_content();
		}
	}

	/**
	 * Function to Filter the Single Doc Content.
	 *
	 * Use regex to filter the post content and extract headings from it & toc data.
	 */
	private function filter_content() {
		$show_anchor_link = get_theme_mod( 'smartdocs_single_doc_anchor_links', 'yes' );
		$show_toc = get_theme_mod( 'smartdocs_single_doc_toc', 'yes' );
		$toc_data = array();
		$tags = 'h1, h2, h3, h4, h5, h6';

		if ( 'no' === $show_anchor_link && 'no' === $show_toc ) {
			return $this->content;
		}

		$this->content = preg_replace_callback(
			'#<(h[' . $tags . '])(.*?)>(.*?)</\1>#si',
			function ( $matches ) use ( &$index, &$show_anchor_link, &$show_toc, &$toc_data ) {
				$index  = 0;
				$tag    = $matches[1];
				$title  = wp_strip_all_tags( $matches[3] );
				$has_id = preg_match( '/id=(["\'])(.*?)\1[\s>]/si', $matches[2], $matched_ids );
				$id     = $has_id ? $matched_ids[2] : sanitize_title( $title );

				$toc_data[] = '<a href="#' . $id . '" class="smartdocs-toc-link">' . $title . '</a>';

				if ( $has_id ) {
					return $matches[0];
				}

				$hash_link = '<a href="#' . $id . '" class="smartdocs-anchor-link">#</a>';

				if ( 'no' === $show_anchor_link ) {
					$hash_link = '';
				}

				// translators: %1$s Opening HTML tag, %2$s HTML attributes, %3$s HTML id attribute, %4$s title, %5$s anchor link, %6$s Closing HTML tag.
				$heading = sprintf( '<%1$s%2$s id="%3$s">%4$s%5$s</%6$s>', $tag, $matches[2], $id, $matches[3], $hash_link, $tag );

				if ( is_rtl() ) {
					// translators: %1$s Opening HTML tag, %2$s HTML attributes, %3$s HTML id attribute, %4$s anchor link, %5$s title,  %6$s Closing HTML tag.
					$heading = sprintf( '<%1$s%2$s id="%3$s">%4$s%5$s</%6$s>', $tag, $matches[2], $id, $hash_link, $matches[3], $tag );
				}

				return $heading;
			},
			$this->content
		);

		$this->toc_data = $toc_data;
	}

	/**
	 * Get Doc Content.
	 *
	 * @return string Long string of Post Content.
	 */
	public function get_the_content() {
		if ( empty( $this->content ) ) {
			$this->content = get_the_content();
			$this->filter_content();
		}
		return $this->content;
	}

	/**
	 * Get Toc Data.
	 *
	 * @return array Array of anchor links.
	 */
	public function get_toc_data() {
		return $this->toc_data;
	}
}
