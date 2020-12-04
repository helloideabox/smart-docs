<?php
/**
 * Includes all essential functions required for common tasks.
 *
 * @package SmartDocs
 */

/**
 * Add script to the page.
 *
 * @param string $script_name Name of the script's handle.
 * @param string $file_name Name of the file as in folder.
 * @param array  $script_dependencies An array of dependencies for the enqueued script. Default is an empty array.
 */
function get_script_depends( $script_name, $file_name, $script_dependencies = array() ) {

	wp_enqueue_script(
		$script_name,
		SMART_DOCS_URL . 'assets/js/' . $file_name . '.js',
		$script_dependencies,
		'1.0.0',
		true
	);
}

/**
 * Add script to the page.
 *
 * @param string $style_name Name of the style handle.
 * @param string $file_name Name of the file in the folder.
 * @param array  $style_dependencies An array of all the dependencies required for the style.
 */
function get_style_depends( $style_name, $file_name, $style_dependencies = array() ) {

	wp_enqueue_style(
		$style_name,
		SMART_DOCS_URL . 'assets/css/' . $file_name . '.css',
		$style_dependencies,
		'1.0.0',
		false
	);
}

/**
 * Get Post Count of a Category.
 *
 * Includes Post Count of category children as well.
 *
 * @since 1.0.0
 *
 * @param integer $id Category ID.
 * @param string  $taxonomy_type Taxonomy Type of the Category.
 */
function wp_get_postcount( $id, $taxonomy_type ) {

	$cat      = get_term( $id, $taxonomy_type );
	$count    = (int) $cat->count;
	$taxonomy = $taxonomy_type;

	$args      = array(
		'child_of' => $id,
	);
	$tax_terms = get_terms( $taxonomy, $args );

	foreach ( $tax_terms as $tax_term ) {
		$count += $tax_term->count;
	}
	return $count;
}

/**
 * Get Settings.
 *
 * Fetch requested settings or return their default values if not found.
 *
 * @param string $setting_key Unique key of the setting.
 */

 function console( $output ) { 
	 
	if (is_array($output))
	$output = implode(',', $output);

	 ?>
	<script>
		(function(){
			console.log('<?php print_r( $output )?>');
		})()
	</script>
<?php }



function smartdocs_get_template_part( $slug, $name = '' ) {
	$template = false;

	if ( ! empty( $name ) ) {
		$template = locate_template(
			array(
				"{$slug}-{$name}.php",
				"templates/{$slug}-{$name}.php"
			)
		);

		if ( ! $template ) {
			$fallback = SMART_DOCS_PATH . "templates/{$slug}-{$name}.php";
			$template = file_exists( $fallback ) ? $fallback : '';
		}
	}

	if ( empty( $template ) ) {
		$template = locate_template( array(
			"{$slug}.php",
			"templates/{$slug}.php"
		) );

		if ( ! $template ) {
			$fallback = SMART_DOCS_PATH . "templates/{$slug}.php";
			$template = file_exists( $fallback ) ? $fallback : '';
		}
	}

	if ( $template ) {
		load_template( $template, false );
	}
}

function smartdocs_get_template( $template_name, $args = array() ) {
	$template = locate_template(
		array(
			"{$template_name}.php",
			"templates/{$template_name}.php"
		)
	);

	if ( empty( $template ) ) {
		$fallback = SMART_DOCS_PATH . "templates/{$template_name}.php";
		$template = file_exists( $fallback ) ? $fallback : '';
	}

	if ( ! empty( $template ) ) {
		extract( $args ); // @codingStandardsIgnoreLine

		include $template;
	}
}

function smartdocs_list_categories( $args, $count ) {
	global $post;

	$current_terms = $post ? wp_get_post_terms( $post->ID, 'smartdocs_category', array( 'fields' => 'slugs' ) ) : array();
	$args['parent'] = 0;
	$parent_cats = get_categories( $args );
	?>
	<ul>
	<?php
	if ( ! empty( $parent_cats ) ) {
		foreach ( $parent_cats as $parent_cat ) {
			$child_cat_args = $args;
			$child_cat_args['parent'] = $parent_cat->term_id;
			$child_cats = get_categories( $child_cat_args );
			?>
			<li class="cat-item cat-item-<?php echo $parent_cat->term_id; ?><?php echo in_array( $parent_cat->slug, $current_terms ) ? ' active' : ''; ?>">
				<a href="<?php echo get_term_link( $parent_cat->term_id ); ?>">
					<span class="cat-label"><?php echo $parent_cat->name; ?></span>
					<?php if ( $count ) { ?>
					<span class="cat-count"><?php echo $parent_cat->count; ?></span>
					<?php } ?>
				</a>
				<?php if ( ! empty( $child_cats ) ) { ?>
					<ul class="children">
						<?php foreach ( $child_cats as $child_cat ) {
							$grandchild_cat_args = $child_cat_args;
							$grandchild_cat_args['parent'] = $child_cat->term_id;
							$grandchild_cats = get_categories( $grandchild_cat_args );
							?>
							<li class="cat-item cat-item-<?php echo $child_cat->term_id; ?><?php echo in_array( $child_cat->slug, $current_terms ) ? ' active' : ''; ?>">
								<a href="<?php echo get_term_link( $child_cat->term_id ); ?>">
									<span class="cat-label"><?php echo $child_cat->name; ?></span>
									<?php if ( $count ) { ?>
									<span class="cat-count"><?php echo $child_cat->count; ?></span>
									<?php } ?>
								</a>
								<?php if ( ! empty( $grandchild_cats ) ) { ?>
									<ul class="children">
										<?php foreach ( $grandchild_cats as $grandchild_cat ) { ?>
										<li class="cat-item cat-item-<?php echo $grandchild_cat->term_id; ?><?php echo in_array( $grandchild_cat->slug, $current_terms ) ? ' active' : ''; ?>">
											<a href="<?php echo get_term_link( $grandchild_cat->term_id ); ?>">
												<span class="cat-label"><?php echo $grandchild_cat->name; ?></span>
												<?php if ( $count ) { ?>
												<span class="cat-count"><?php echo $grandchild_cat->count; ?></span>
												<?php } ?>
											</a>
										</li>
										<?php } ?>
									</ul>
								<?php } ?>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</li>
			<?php
		}
	}
	?>
	</ul>
	<?php
}