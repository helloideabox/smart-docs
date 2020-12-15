<?php
	/**
	 * Render Frontend Styles
	 *
	 * @return void
	 */
function render_frontend_styles() {

	$breakpoint_medium = get_option( 'smartdocs_breakpoint_medium', 1024 );
	$breakpoint_small  = get_option( 'smartdocs_breakpoint_small', 768 );

	$archive_title_color                = get_theme_mod( 'smartdocs_hero_title_color' );
	$smartdocs_hero_description_color   = get_theme_mod( 'smartdocs_hero_description_color', '#cecece' );
	$archive_item_list_title_color      = get_theme_mod( 'smartdocs_archive_list_item_title_color' );
	$archive_item_list_post_count_color = get_theme_mod( 'smartdocs_archive_list_item_post_count_color' );
	$archive_list_item_bg_color         = get_theme_mod( 'smartdocs_archive_list_item_bg_color' );

	/**
	 * Header Styles.
	 */
	$background_type                = get_theme_mod( 'smartdocs_hero_bg_type' );
	$background_color               = get_theme_mod( 'smartdocs_hero_background_color', '#cecece' );
	$background_image               = get_theme_mod( 'smartdocs_hero_bg_image' );
	$background_image_overlay_color = get_theme_mod( 'smartdocs_hero_bg_image_overlay_color' );

	/**
	 * Grid Layout
	 */
	$grid_columns        = get_theme_mod( 'smartdocs_archive_columns', 3 );
	$grid_columns_tablet = get_theme_mod( 'smartdocs_archive_columns_tablet', 2 );
	$grid_columns_mobile = get_theme_mod( 'smartdocs_archive_columns_mobile', 1 );

	/**
	 * Grid Layout Items
	 */
	$cat_title_font_size        = get_theme_mod( 'smartdocs_archive_list_item_title_font_size', '16' );
	$cat_title_font_size_tablet = get_theme_mod( 'smartdocs_archive_list_item_title_font_size_tablet', '16' );
	$cat_title_font_size_mobile = get_theme_mod( 'smartdocs_archive_list_item_title_font_size_mobile', '16' );

	$cat_title_font_color = get_theme_mod( 'smartdocs_archive_list_item_title_color', '#c0c0c0' );
	$cat_title_bg_color   = get_theme_mod( 'smartdocs_archive_list_item_title_bg_color' );

	$cat_description_font_size        = get_theme_mod( 'smartdocs_archive_list_item_description_font_size', '16' );
	$cat_description_font_size_tablet = get_theme_mod( 'smartdocs_archive_list_item_description_font_size_tablet', '14' );
	$cat_description_font_size_mobile = get_theme_mod( 'smartdocs_archive_list_item_description_font_size_mobile', '12' );

	$cat_descrtipion_font_color = get_theme_mod( 'smartdocs_archive_list_item_description_color', '#c0c0c0' );

	$cat_info_font_size        = get_theme_mod( 'smartdocs_archive_list_item_post_info_font_size', '14' );
	$cat_info_font_size_tablet = get_theme_mod( 'smartdocs_archive_list_item_post_info_font_size_tablet', '14' );
	$cat_info_font_size_mobile = get_theme_mod( 'smartdocs_archive_list_item_post_info_font_size_mobile', '14' );

	$cat_info_text_color    = get_theme_mod( 'smartdocs_archive_category_info_text_color' );
	$cat_info_bg_color      = get_theme_mod( 'smartdocs_archive_category_info_bg_color' );
	$cat_info_divider_color = get_theme_mod( 'smartdocs_archive_list_item_info_divider_color' );

	$cat_item_padding        = json_decode(
		get_theme_mod(
			'smartdocs_archive_item_padding',
			json_encode(
				array(
					'top'    => 15,
					'right'  => 15,
					'bottom' => 15,
					'left'   => 15,
				)
			)
		)
	);
	$cat_item_padding_tablet = json_decode(
		get_theme_mod(
			'smartdocs_archive_item_padding_tablet',
			json_encode(
				array(
					'top'    => 15,
					'right'  => 15,
					'bottom' => 15,
					'left'   => 15,
				)
			)
		)
	);
	$cat_item_padding_mobile = json_decode(
		get_theme_mod(
			'smartdocs_archive_item_padding_mobile',
			json_encode(
				array(
					'top'    => 15,
					'right'  => 15,
					'bottom' => 15,
					'left'   => 15,
				)
			)
		)
	);

	$grid_gap = get_theme_mod( 'smartdocs_archive_columns_gap' );
	?>
		<style type="text/css" class="smartdocs-archive-dynamic-css">
			/**
			 * Header style.
			 */
			.smartdocs-header .smartdocs-inner {
			<?php if ( 'color' === $background_type ) : ?>
					background-color: <?php echo esc_attr( $background_color ); ?>;
				<?php elseif ( 'image' === $background_type ) : ?>
					background-image: url('<?php echo esc_html( $background_image ); ?>');
					background-repeat: no-repeat;
					background-size: cover;
					background-position: center;
				<?php endif; ?>
					padding: 20px;
					position: relative;
			}

			<?php if ( 'image' === $background_type ) : ?>
			.smartdocs-header .smartdocs-inner::before {
					position: absolute;
					left: 0;
					top: 0;
					width: 100%;
					height: 100%;
					background-color: <?php echo $background_image_overlay_color; ?>;
			}
			<?php endif; ?>

			.smartdocs-hero-title {
			<?php if ( ! empty( $archive_title_color ) ) { ?>
					color: <?php echo esc_attr( $archive_title_color ); ?>;
				<?php } ?>
					display: flex;
					align-items: center;
					justify-content: center;
					padding-top: 25px;
					padding-bottom: 25px;
			}
			.smartdocs-header p {
				color: <?php echo esc_attr( $smartdocs_hero_description_color ); ?>;
				text-align: center;
			}
			.smartdocs-archive-cat-title {
			<?php if ( ! empty( $archive_item_list_title_color ) ) { ?>
					color: <?php echo esc_attr( $archive_item_list_title_color ); ?>;
				<?php } ?>
			}
			.smartdocs-archive-post-count {
			<?php if ( ! empty( $archive_item_list_post_count_color ) ) { ?>
					color: <?php echo esc_attr( $archive_item_list_post_count_color ); ?>;
				<?php } ?>
			}
			a.smartdocs-sub-archive-categories-post {
			<?php if ( ! empty( $archive_list_item_bg_color ) ) { ?>
					background-color: <?php echo esc_attr( $archive_list_item_bg_color ); ?>;
				<?php } ?>
			}

			/**
			 * Grid Styles
			 */
			.smartdocs-categories {
				gap: <?php echo empty( $grid_gap ) ? '20px' : ( $grid_gap . 'px' ); ?>;
				width: 100% !important;
			}

			/**
			 * Single Category Item Styles
			 */

			 .smartdocs-category-info {
				background-color: <?php echo esc_html( $cat_title_bg_color ); ?>;
			 }

			.smartdocs-category-title {
				 font-size: <?php echo esc_html( $cat_title_font_size ); ?>px;
				 color: <?php echo esc_html( $cat_title_font_color ); ?>;
			 }

			 .smartdocs-categories .smartdocs-category-text .smartdocs-category-description {
				 font-size: <?php echo esc_html( $cat_description_font_size ); ?>px;
				 color: <?php echo esc_html( $cat_descrtipion_font_color ); ?>;
			 }

			 div.smartdocs-categories .smartdocs-posts-info {
				 font-size: <?php echo esc_html( $cat_info_font_size ); ?>px;
				 background-color: <?php echo esc_html( $cat_info_bg_color ); ?>;
				 border-top-color: <?php echo empty( $cat_info_divider_color ) ? esc_html( $cat_info_bg_color ) : esc_html( $cat_info_divider_color ); ?>;
			 }

			div.smartdocs-categories .smartdocs-posts-info .smartdocs-category-view-all,
			div.smartdocs-categories .smartdocs-posts-info .smartdocs-posts-count {
				color: <?php echo esc_html( $cat_info_text_color ); ?>;
			}

			div.smartdocs-categories .smartdocs-category-info {
				padding: <?php echo $cat_item_padding->top; ?>px <?php echo $cat_item_padding->right; ?>px <?php echo $cat_item_padding->bottom; ?>px <?php echo $cat_item_padding->left; ?>px ;
			 }
			
			div.smartdocs-categories .smartdocs-posts-info {
				padding-right: <?php echo $cat_item_padding->right; ?>px ;
				padding-left: <?php echo $cat_item_padding->left; ?>px ;
			}

			@media only screen and (max-width:<?php echo esc_html( $breakpoint_medium ); ?>px) and (min-width:<?php echo esc_html( $breakpoint_small ); ?>px) {

				<?php
				for ( $x = 1; $x <= 12; $x++ ) {
					?>
					.col-md--<?php echo $x; ?> {
						grid-template-columns: repeat(<?php echo $x; ?>, 1fr);
					}
					<?php
				}
				?>

				/**
				* Grid Styles Medium || Tablet
				*/
				.smartdocs-categories {
					grid-template-columns: repeat(<?php echo $grid_columns_tablet; ?>, 1fr);
				}

				div.smartdocs-categories .smartdocs-category-info {
					padding: <?php echo $cat_item_padding_tablet->top; ?>px <?php echo $cat_item_padding_tablet->right; ?>px <?php echo $cat_item_padding_tablet->bottom; ?>px <?php echo $cat_item_padding_tablet->left; ?>px ;
				}

				div.smartdocs-categories .smartdocs-posts-info {
					padding-right: <?php echo $cat_item_padding_tablet->right; ?>px ;
					padding-left: <?php echo $cat_item_padding_tablet->left; ?>px ;
				}

				.smartdocs-category-title {
				 font-size: <?php echo esc_html( $cat_title_font_size_tablet ); ?>px;
				}

				.smartdocs-categories .smartdocs-category-text .smartdocs-category-description {
				 font-size: <?php echo esc_html( $cat_description_font_size_tablet ); ?>px;
			 }
				
				div.smartdocs-categories .smartdocs-posts-info {
					font-size: <?php echo esc_html( $cat_info_font_size_tablet ); ?>px;
				}

			}

			@media only screen and (max-width:<?php echo esc_html( $breakpoint_small - 1 ); ?>px) {

				<?php
				for ( $x = 1; $x <= 12; $x++ ) {
					?>
					.col-sm--<?php echo $x; ?> {
						grid-template-columns: repeat(<?php echo $x; ?>, 1fr);
					}
					<?php
				}
				?>

				/**
				* Grid Styles Small
				*/
				.smartdocs-categoroies {
					grid-template-columns: repeat(<?php echo $grid_columns_mobile; ?>, 1fr);
				}

				div.smartdocs-categories .smartdocs-category-info {
					padding: <?php echo $cat_item_padding_mobile->top; ?>px <?php echo $cat_item_padding_mobile->right; ?>px <?php echo $cat_item_padding_mobile->bottom; ?>px <?php echo $cat_item_padding_mobile->left; ?>px ;
				}

				div.smartdocs-categories .smartdocs-posts-info {
					padding-right: <?php echo $cat_item_padding_mobile->right; ?>px ;
					padding-left: <?php echo $cat_item_padding_mobile->left; ?>px ;
				}

				.smartdocs-category-title {
				 font-size: <?php echo esc_html( $cat_title_font_size_mobile ); ?>px;
				}

				.smartdocs-categories .smartdocs-category-text .smartdocs-category-description {
				 font-size: <?php echo esc_html( $cat_description_font_size_mobile ); ?>px;
			 }

				div.smartdocs-categories .smartdocs-posts-info {
					font-size: <?php echo esc_html( $cat_info_font_size_mobile ); ?>px;
				}
			}

			/**Grid template columns classes for Desktop*/
			<?php
			for ( $x = 1; $x <= 12; $x++ ) {
				?>
				.col-lg--<?php echo $x; ?> {
					grid-template-columns: repeat(<?php echo $x; ?>, 1fr);
				}
				<?php
			}
			?>
		</style>
		<?php
}

render_frontend_styles();
