<?php
/**
 * Includes all essential functions required for common tasks.
 *
 * @package SmartDocs\Functions
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get template part (for templates like the archive, single).
 *
 * @param mixed  $slug Template slug.
 * @param string $name Template name (default: '').
 */
function smartdocs_get_template_part( $slug, $name = '' ) {
	$template = false;

	if ( ! empty( $name ) ) {
		$template = locate_template(
			array(
				"smart-docs/{$slug}-{$name}.php",
			)
		);

		if ( ! $template ) {
			$fallback = SMART_DOCS_PATH . "templates/{$slug}-{$name}.php";
			$template = file_exists( $fallback ) ? $fallback : '';
		}
	}

	if ( empty( $template ) ) {
		$template = locate_template( array(
			"smart-docs/{$slug}.php"
		) );

		if ( ! $template ) {
			$fallback = SMART_DOCS_PATH . "templates/{$slug}.php";
			$template = file_exists( $fallback ) ? $fallback : '';
		}
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'smartdocs_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}

/**
 * Get other templates (e.g. header, search form, etc.) passing attributes and including the file.
 *
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 */
function smartdocs_get_template( $template_name, $args = array() ) {
	$template = locate_template(
		array(
			"smart-docs/{$template_name}.php"
		)
	);

	if ( empty( $template ) ) {
		$fallback = SMART_DOCS_PATH . "templates/{$template_name}.php";
		$template = file_exists( $fallback ) ? $fallback : '';
	}

	// Allow 3rd party plugin filter template file from their plugin.
	$filter_template = apply_filters( 'smartdocs_get_template', $template, $template_name, $args );

	if ( $filter_template !== $template && file_exists( $filter_template ) ) {
		$template = $filter_template;
	}

	if ( ! empty( $template ) ) {
		extract( $args ); // @codingStandardsIgnoreLine

		include $template;
	}
}

/**
 * Cached version of wp_get_post_terms().
 * This is a private function (internal use ONLY).
 *
 * @since  1.0.0
 * @param  int    $doc_id 	Doc ID.
 * @param  string $taxonomy Taxonomy slug.
 * @param  array  $args     Query arguments.
 * @return array
 */
function _smartdocs_get_doc_terms( $doc_id, $taxonomy, $args = array() ) {
	$cache_key   = 'smartdocs_' . $taxonomy . md5( wp_json_encode( $args ) );
	$cache_group = 'smartdocs_post_' . $doc_id;
	$terms 		 = wp_cache_get( $cache_key, $cache_group );

	if ( false !== $terms ) {
		return $terms;
	}

	$terms = wp_get_post_terms( $doc_id, $taxonomy, $args );

	wp_cache_add( $cache_key, $terms, $cache_group );

	return $terms;
}

/**
 * See if current page is SmartDocs post type archive or not.
 *
 * @return boolean
 */
function is_smartdocs_archive() {
	return is_post_type_archive( 'smart-docs' );
}

/**
 * See if current page is SmartDocs post type single or not.
 *
 * @return boolean
 */
function is_smartdocs_single() {
	return is_singular( 'smart-docs' );
}

/**
 * See if current page is SmartDocs taxonomy or not.
 *
 * @param object $term Taxonomy term.
 * @return boolean
 */
function is_smartdocs_category( $term = '' ) {
	return is_tax( 'smartdocs_category', $term );
}

/**
 * Get current post terms or current term's parent.
 *
 * @return array
 */
function smartdocs_get_current_terms() {
	$current_terms = array();

	if ( is_singular( SmartDocs\Plugin::instance()->cpt->post_type ) ) {
		global $post;
		$current_terms = get_the_terms(
			$post,
			'smartdocs_category'
		);
		if ( ! is_wp_error( $current_terms ) && is_array( $current_terms ) && ! empty( $current_terms ) ) {
			$current_terms = wp_list_pluck( $current_terms , 'slug' );
		}
	} elseif ( is_tax( 'smartdocs_category' ) ) {
		$current_term = get_queried_object();
		$current_terms[] = $current_term->slug;
		if ( $current_term->parent ) {
			$parent_term = get_term_by( 'id', $current_term->parent, 'smartdocs_category' );
			if ( $parent_term ) {
				$current_terms[] = $parent_term->slug;
			}
		}
	}

	if ( ! is_array( $current_terms ) ) {
		$current_terms = array();
	}

	return $current_terms;
}

/**
 * Post class for docs.
 *
 * @param string $class CSS class names.
 */
function smartdocs_post_class( $class = '' ) {
	echo $class;
}

/**
 * Get the smart-docs cpt name.
 */
function smartdocs_get_post_type() {
	return SmartDocs\Plugin::instance()->cpt->post_type;
}

/**
 * Get docs page link based on SmartDocs template setting.
 *
 * @return string
 */
function smartdocs_get_docs_page_link() {
	$use_built_in = get_option( 'smartdocs_use_built_in_doc_archive' );
	$docs_page_id = get_option( 'smartdocs_custom_doc_page' );

	if ( ! $use_built_in && ! empty( $docs_page_id ) ) {
		$docs_page    	= get_post( $docs_page_id );
		$permalink 		= $docs_page ? get_permalink( $docs_page ) : '';
	}

	if ( ! isset( $permalink ) || empty( $permalink ) ) {
		$permalink = get_post_type_archive_link( 'smart-docs' );
	}

	return $permalink;
}

/**
 * Get support page link from SmartDocs setting.
 *
 * @return string
 */
function smartdocs_get_support_page_link() {
	return get_option( 'smartdocs_support_page_url', '#' );
}

/**
 * Get category thumbnail URL.
 *
 * @param int $term_id Taxonomy term ID.
 * @return string
 */
function smartdocs_get_category_thumbnail_url( $term_id ) {

	$thumb_id     = get_term_meta( $term_id, 'thumbnail_id', true );
	$thumbnail_id = get_term_meta( $term_id, 'taxonomy_thumbnail_id', true );

	if ( empty( $thumb_id ) ) {
		$thumb_id = $thumbnail_id;
	}

	$image = wp_get_attachment_image_src( $thumb_id, 'thumbnail' );

	if ( ! is_array( $image ) || empty( $image ) ) {
		return apply_filters( 'smartdocs_category_placeholder_image_src', SMART_DOCS_URL . 'assets/images/placeholder.png' );
	}

	return $image[0];
}

/**
 * Fetch and list the articles from the given term.
 *
 * @param object $term Taxonomy term object.
 */
function smartdocs_list_docs( $term ) {
	$post_type = SmartDocs\Plugin::instance()->cpt->post_type;

	if ( ! is_singular( $post_type ) ) {
		return;
	}

	$current_post_id = get_the_ID();
	$posts = get_posts( array(
		'post_type' 	=> $post_type,
		'numberposts' 	=> -1,
		'tax_query' 	=> array(
			array(
				'taxonomy' => 'smartdocs_category',
				'field' => 'term_id',
				'terms' => $term->term_id,
				'include_children' => false,
			),
		),
	) );

	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $doc ) {
			?>
			<li class="<?php echo $current_post_id === $doc->ID ? 'active' : ''; ?>">
				<a href="<?php echo get_permalink( $doc ); ?>"><?php echo get_the_title( $doc ); ?></a>
			</li>
			<?php
		}
	}
}

/**
 * Fetch and list the categories in hierarchy.
 *
 * @param array 	$args 	Query arguments.
 * @param boolean 	$count 	Whether to include post count or not.
 *
 * @see smartdocs_get_current_terms()
 * @see smartdocs_list_docs()
 */
function smartdocs_list_categories( $args, $count ) {
	$args['parent'] = 0;
	$parent_cats = get_categories( $args );
	$current_terms = smartdocs_get_current_terms();

	if ( ! empty( $parent_cats ) ) {
		foreach ( $parent_cats as $parent_cat ) {
			$child_cat_args = $args;
			$child_cat_args['parent'] = $parent_cat->term_id;
			$child_cats = get_categories( $child_cat_args );
			?>
			<li class="cat-item cat-item-<?php echo esc_html( $parent_cat->term_id ); ?><?php echo in_array( $parent_cat->slug, $current_terms, true ) ? ' active' : ''; ?>">
				<a href="<?php echo get_term_link( $parent_cat->term_id ); ?>">
					<span class="cat-label"><?php echo esc_html( $parent_cat->name ); ?></span>
					<?php if ( $count ) { ?>
					<span class="cat-count"><?php echo esc_html( $parent_cat->count ); ?></span>
					<?php } ?>
				</a>
				<?php if ( in_array( $parent_cat->slug, $current_terms, true ) && $parent_cat->count && ! $child_cats ) { ?>
					<ul class="has-posts">
						<?php smartdocs_list_docs( $parent_cat ); ?>
					</ul>
				<?php } ?>
				<?php if ( ! empty( $child_cats ) ) { ?>
					<ul class="children">
						<?php foreach ( $child_cats as $child_cat ) {
							$grandchild_cat_args = $child_cat_args;
							$grandchild_cat_args['parent'] = $child_cat->term_id;
							$grandchild_cats = get_categories( $grandchild_cat_args );
							?>
							<li class="cat-item cat-item-<?php echo $child_cat->term_id; ?><?php echo in_array( $child_cat->slug, $current_terms, true ) ? ' active' : ''; ?>">
								<a href="<?php echo get_term_link( $child_cat->term_id ); ?>">
									<span class="cat-label"><?php echo esc_html( $child_cat->name ); ?></span>
									<?php if ( $count ) { ?>
									<span class="cat-count"><?php echo esc_html( $child_cat->count ); ?></span>
									<?php } ?>
								</a>
								<?php if ( in_array( $child_cat->slug, $current_terms, true ) && $child_cat->count && ! $grandchild_cats ) { ?>
									<ul class="has-posts">
										<?php smartdocs_list_docs( $child_cat ); ?>
									</ul>
								<?php } ?>
								<?php if ( ! empty( $grandchild_cats ) ) { ?>
									<ul class="children">
										<?php foreach ( $grandchild_cats as $grandchild_cat ) { ?>
										<li class="cat-item cat-item-<?php echo esc_html( $grandchild_cat->term_id ); ?><?php echo in_array( $grandchild_cat->slug, $current_terms, true ) ? ' active' : ''; ?>">
											<a href="<?php echo get_term_link( $grandchild_cat->term_id ); ?>">
												<span class="cat-label"><?php echo esc_html( $grandchild_cat->name ); ?></span>
												<?php if ( $count ) { ?>
												<span class="cat-count"><?php echo esc_html( $grandchild_cat->count ); ?></span>
												<?php } ?>
											</a>
											<?php if ( in_array( $grandchild_cat->slug, $current_terms, true ) && $grandchild_cat->count ) { ?>
												<ul class="has-posts">
													<?php smartdocs_list_docs( $grandchild_cat ); ?>
												</ul>
											<?php } ?>
										</li>
										<?php } ?>
									</ul>
								<?php } ?>
							</li>
						<?php } // End foreach(). ?>
					</ul>
				<?php } // End if(). ?>
			</li>
			<?php
		} // End foreach().
	} // End if().
}

/**
 * Get related articles.
 * 
 * @param int $post_id ID of the current post.
 */
function smartdocs_query_related_articles( $post_id ) {

	$posts = array();
	$terms = get_the_terms( $post_id, 'smartdocs_category' );

	if ( is_wp_error( $terms ) || ! is_array( $terms ) ) {
		return $posts;
	}

	$terms_list = wp_list_pluck( $terms, 'term_id' );

	// Create a new WP_Query.
	$args = array(
		'post_type' => smartdocs_get_post_type(),
		'tax_query' => array(
			array(
				'taxonomy' => 'smartdocs_category',
				'field'    => 'term_id',
				'terms'    => $terms_list,
			),
		),
		'numberposts' => 10,
		'post__not_in' => array( $post_id ),
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		$posts = $query->posts;
	}

	return $posts;
}

/**
 * Get all the docs in a term id.
 *
 * @param int $term_id ID of the smartdocs_category category.
 */
function smartdocs_category_articles( $term_id ) {
	$args = array(
		'post_type' => smartdocs_get_post_type(),
		'tax_query' => array(
			array(
				'taxonomy' => 'smartdocs_category',
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		),
		'numberposts' => 10,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		?>
		<ul class="smartdocs-category-articles">
		<?php
		foreach ( $query->posts as $post ) {
			?>
			<li class="smartdocs-category-article doc-<?php echo esc_html( $post->ID ); ?>">
				<a href="<?php echo esc_url( get_post_permalink( $post ) ); ?>">
					<?php echo esc_html( $post->post_title ); ?>
				</a>
			</li>
			<?php
		}
		?>
		</ul>
		<?php
	}
}

/**
 * Add anchor links to headings on single doc.
 * 
 * @param string $content Mixed string of Post Data.
 */
function smartdocs_anchor_links( $content ) {
	$tags = 'h1, h2, h3, h4, h5, h6';

	$content = preg_replace_callback(
		'#<(h[' . $tags . '])(.*?)>(.*?)</\1>#si',
		function ( $matches ) use ( &$index ) {
			$index  = 0;
			$tag    = $matches[1];
			$title  = wp_strip_all_tags( $matches[3] );
			$has_id = preg_match( '/id=(["\'])(.*?)\1[\s>]/si', $matches[2], $matched_ids );
			$id     = $has_id ? $matched_ids[2] : sanitize_title( $title );

			if ( $has_id ) {
				return $matches[0];
			}

			$hash_link = '<a href="#' . $id . '" class="smartdocs-anchor-link">#</a>';

			// translators: %1$s Opening HTML tag, %2$s HTML attributes, %3$s HTML id attribute, %4$s title, %5$s anchor link, %6$s Closing HTML tag.
			$heading = sprintf( '<%1$s%2$s id="%3$s">%4$s%5$s</%6$s>', $tag, $matches[2], $id, $matches[3], $hash_link, $tag );

			if ( is_rtl() ) {
				// translators: %1$s Opening HTML tag, %2$s HTML attributes, %3$s HTML id attribute, %4$s anchor link, %5$s title,  %6$s Closing HTML tag.
				$heading = sprintf( '<%1$s%2$s id="%3$s">%4$s%5$s</%6$s>', $tag, $matches[2], $id, $hash_link, $matches[3], $tag );
			}

			return $heading;
		},
		$content
	);

	return $content;
}

/**
 * Generate TOC HTML.
 *
 * @param array $toc_data Array containg toc data.
 */
function smartdocs_generate_toc( $toc_data ) {
	$last_level = 0;
	$toc_html   = '';

	foreach ( $toc_data as $toc_item ) {

		$id    = $toc_item['id'];
		$title = $toc_item['title'];
		$level = $toc_item['level'];
		$tag   = $toc_item['tag'];

		if ( $level > $last_level ) {
			$toc_html .= "<ol class='smartdocs-toc-level-$level'>";
		} else {
			$toc_html .= str_repeat( '</li></ol>', $last_level - $level );
			$toc_html .= '</li>';
		}

		$toc_html .= "<li><a href='#{$id}'>{$title}</a>";

		$last_level = $level;
	}
	$toc_html .= str_repeat( '</li></ol>', $last_level );

	return $toc_html;
}

