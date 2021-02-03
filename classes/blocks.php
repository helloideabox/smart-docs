<?php
/**
 * Blocks class is responsible for registering the Gutenberg Blocks.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Blocks class.
 */
class Blocks {
	/**
	 * Holds the Blocks category slug.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string $block_category_slug
	 */
	public $block_category_slug = 'smart-docs';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'block_categories', array( $this, 'add_block_categories' ) );
		add_action( 'init', array( $this, 'register_blocks' ) );
	}

	/**
	 * Register custom categories.
	 *
	 * @since 1.0.0
	 * @param array $categories Array of categories.
	 *
	 * @return array Categories with new one.
	 */
	public function add_block_categories( $categories ) {
		$category_slugs = wp_list_pluck( $categories, 'slug' );
		return in_array( $this->block_category_slug, $category_slugs, true ) ? $category_slugs :
			array_merge(
				$categories,
				array(
					array(
						'slug'  => $this->block_category_slug,
						'title' => __( 'Smart Blocks', 'smart-blocks' ),
					),
				)
			);
	}

	/**
	 * Register blocks.
	 *
	 * @since 1.0.0
	 */
	public function register_blocks() {
		$dir = SMART_DOCS_PATH;

		$script_asset_path = "$dir/assets/blocks/index.asset.php";
		if ( ! file_exists( $script_asset_path ) ) {
			throw new Error(
				'You need to run `npm start` or `npm run build` for the smart-docs block first.'
			);
		}
		$index_js     = 'assets/blocks/index.js';
		$script_asset = require( $script_asset_path );
		wp_register_script(
			'smartdocs-blocks-editor',
			SMART_DOCS_URL . $index_js,
			$script_asset['dependencies'],
			$script_asset['version']
		);
		wp_set_script_translations( 'smartdocs-block-editor', 'smart-docs' );

		$editor_css = 'assets/blocks/index.css';
		wp_register_style(
			'smartdocs-blocks-editor',
			SMART_DOCS_URL . $editor_css,
			array(),
			filemtime( "$dir/$editor_css" )
		);

		$style_css = 'assets/blocks/style-index.css';
		wp_register_style(
			'smartdocs-blocks',
			SMART_DOCS_URL . $style_css,
			array(),
			filemtime( "$dir/$style_css" )
		);

		$this->register_block_type( 'notice' );
	}

	/**
	 * Register block type.
	 *
	 * @since 1.0.0
	 *
	 * @param string $block Name of the block.
	 * @param array $args Array of arguments.
	 * @access private
	 *
	 * @return void
	 */
	private function register_block_type( $block, $args = array() ) {
		register_block_type(
			'smartdocs/' . $block,
			array_merge(
				array(
					'editor_script' => 'smartdocs-blocks-editor',
					'editor_style'  => 'smartdocs-blocks-editor',
					'style'         => 'smartdocs-blocks',
				),
				$args
			)
		);
	}
}
