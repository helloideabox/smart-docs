<?php
namespace SmartDocs;

/**
 * Dynamic CSS Class.
 *
 * Responsible for creating dynamic styles.
 *
 * @since 1.0.0
 * @package SmartDocs\Classes
 */

defined( 'ABSPATH' ) || exit;

class Dynamic_CSS {
	protected $breakpoints = array(
		'tablet' => 0,
		'mobile' => 0,
	);

	protected $styles = array(
		'desktop' 	=> array(),
		'tablet'	=> array(),
		'mobile'	=> array()
	);

	public function __construct() {
		$this->breakpoints = array(
			'tablet' => $this->get_mod( 'breakpoint_medium', 1024 ),
			'mobile' => $this->get_mod( 'breakpoint_small', 768 ),
		);
	}

	public function get_mod( $key, $default = false ) {
		return get_theme_mod( "smartdocs_$key", $default );
	}

	private function add_rule( $selector, $props, $device = 'desktop' ) {
		if ( ! isset( $this->styles[ $device ][ $selector ] ) ) {
			$this->styles[ $device ][ $selector ] = array();
		}

		foreach ( $props as $prop => $value ) {
			$this->styles[ $device ][ $selector ][ $prop ] = $value;
		}
	}

	public function build_hero_section_style() {
		$bg_type                 = $this->get_mod( 'hero_bg_type', 'color' );
		$bg_color                = $this->get_mod( 'hero_background_color' );
		$bg_image                = $this->get_mod( 'hero_bg_image' );
		$bg_image_overlay_color  = $this->get_mod( 'hero_bg_image_overlay_color' );
		$title_color             = $this->get_mod( 'hero_title_color' );
		$description_color       = $this->get_mod( 'hero_description_color' );

		if ( 'color' === $bg_type && ! empty( $bg_color ) ) {
			$this->add_rule( '.smartdocs-header', array(
				'background-color' => esc_attr( $bg_color ),
			) );
		}
		if ( 'image' === $bg_type && ! empty( $bg_image ) ) {
			$bg_image = esc_url( $bg_image );

			$this->add_rule( '.smartdocs-header', array(
				'background-image' => "url($bg_image)",
				'background-repeat' => 'no-repeat',
				'background-size' => 'cover',
				'background-position' => 'center'
			) );

			// Background overlay.
			$this->add_rule( '.smartdocs-header:before', array(
				'content'	=> '',
				'position' 	=> 'absolute',
				'top' 		=> '0px',
				'left' 		=> '0px',
				'width' 	=> '100%',
				'height' 	=> '100%',
				'background-color' => esc_attr( $bg_image_overlay_color )
			) );
		}
		if ( ! empty( $title_color ) ) {
			$this->add_rule( '.smartdocs-header .smartdocs-hero-title', array(
				'color' => esc_attr( $title_color )
			) );
		}
		if ( ! empty( $description_color ) ) {
			$this->add_rule( '.smartdocs-header p', array(
				'color' => esc_attr( $description_color )
			) );
		}
	}

	public function build_categories_grid_style() {
		$gap 						= $this->get_mod( 'archive_columns_gap' );
		$title_font_size 			= $this->get_mod( 'archive_category_title_font_size' );
		$title_font_size_tablet 	= $this->get_mod( 'archive_category_title_font_size_tablet' );
		$title_font_size_mobile 	= $this->get_mod( 'archive_category_title_font_size_mobile' );
		$title_color 				= $this->get_mod( 'archive_category_title_color' );
		$description_font_size 		= $this->get_mod( 'archive_category_description_font_size' );
		$description_font_size_tablet = $this->get_mod( 'archive_category_description_font_size_tablet' );
		$description_font_size_mobile = $this->get_mod( 'archive_category_description_font_size_mobile' );
		$description_color 			= $this->get_mod( 'archive_category_description_color' );
		$action_font_size 			= $this->get_mod( 'archive_category_action_font_size' );
		$action_font_size_tablet 	= $this->get_mod( 'archive_category_action_font_size_tablet' );
		$action_font_size_mobile 	= $this->get_mod( 'archive_category_action_font_size_mobile' );
		$action_color 				= $this->get_mod( 'archive_category_action_color' );
		$action_bg_color 			= $this->get_mod( 'archive_category_action_bg_color' );
		$action_border_color 		= $this->get_mod( 'archive_category_action_border_color' );

		if ( false !== $gap ) {
			$this->add_rule( '.smartdocs-categories', array(
				'gap' => "{$gap}px"
			) );
		}

		// Title.
		if ( ! empty( $title_font_size ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-category-title', array(
				'font-size' => "{$title_font_size}px"
			) );
		}
		if ( ! empty( $title_font_size_tablet ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-category-title', array(
				'font-size' => "{$title_font_size_tablet}px"
			), 'tablet' );
		}
		if ( ! empty( $title_font_size_mobile ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-category-title', array(
				'font-size' => "{$title_font_size_mobile}px"
			), 'mobile' );
		}
		if ( ! empty( $title_color ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-category-title', array(
				'color' => esc_attr( $title_color )
			) );
		}

		// Description.
		if ( ! empty( $description_font_size ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-category-description', array(
				'font-size' => "{$description_font_size}px"
			) );
		}
		if ( ! empty( $description_font_size_tablet ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-category-description', array(
				'font-size' => "{$description_font_size_tablet}px"
			), 'tablet' );
		}
		if ( ! empty( $description_font_size_mobile ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-category-description', array(
				'font-size' => "{$description_font_size_mobile}px"
			), 'mobile' );
		}
		if ( ! empty( $description_color ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-category-description', array(
				'color' => esc_attr( $description_color )
			) );
		}

		// Action.
		if ( ! empty( $action_font_size ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-posts-info', array(
				'font-size' => "{$action_font_size}px"
			) );
		}
		if ( ! empty( $action_font_size_tablet ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-posts-info', array(
				'font-size' => "{$action_font_size_tablet}px"
			), 'tablet' );
		}
		if ( ! empty( $action_font_size_mobile ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-posts-info', array(
				'font-size' => "{$action_font_size_mobile}px"
			), 'mobile' );
		}
		if ( ! empty( $action_color ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-posts-info a', array(
				'color' => esc_attr( $action_color )
			) );
		}
		if ( ! empty( $action_bg_color ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-posts-info', array(
				'background-color' => esc_attr( $action_bg_color )
			) );
		}
		if ( ! empty( $action_border_color ) ) {
			$this->add_rule( '.smartdocs-categories .smartdocs-posts-info', array(
				'border-top-color' => esc_attr( $action_border_color )
			) );
		}

		// Columns CSS.
		for ( $i = 1; $i <= 12; $i++ ) {
			$this->add_rule( ".smartdocs-categories.col-lg--$i", array(
				'grid-template-columns' => "repeat($i, 1fr)"
			) );

			$this->add_rule( ".smartdocs-categories.col-md--$i", array(
				'grid-template-columns' => "repeat($i, 1fr)"
			), 'tablet' );

			$this->add_rule( ".smartdocs-categories.col-sm--$i", array(
				'grid-template-columns' => "repeat($i, 1fr)"
			), 'mobile' );
		}
	}

	public function render_styles() {
		if ( ! empty( $this->styles['desktop'] ) || ! empty( $this->styles['tablet'] ) || ! empty( $this->styles['mobile'] ) ) {
			?>
			<style type="text/css">
				<?php
				foreach ( $this->styles as $device => $rules ) {
					if ( 'tablet' === $device ) {
						echo "@media only screen and (max-width: {$this->breakpoints['tablet']}px) {";		
					} elseif ( 'mobile' === $device ) {
						echo "@media only screen and (max-width: {$this->breakpoints['mobile']}px) {";
					}

					foreach ( $rules as $selector => $props ) {
						if ( empty( $props ) ) {
							continue;
						}

						echo "$selector { ";
							foreach ( $props as $prop => $value ) {
								if ( 'content' === $prop && empty( $value ) ) {
									echo 'content: " ";';
								} else {
									echo "$prop: $value;";
								}
							}
						echo " } ";
					}

					if ( 'tablet' === $device ) {
						echo "}";		
					} elseif ( 'mobile' === $device ) {
						echo "}";
					}
				}
				?>
			</style>
			<?php
		}
	}
}
