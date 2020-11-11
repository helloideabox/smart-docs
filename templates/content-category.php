<div class="sd-archive-post">
	<a href="<?php echo esc_html( get_term_link( $t ) ); ?>" class="sd-sub-archive-categories-post">
		<h4 class="sd-archive-cat-title">
			<?php echo esc_html( $t->name ); ?>
		</h4>
		<p class="sd-archive-post-count">
			<?php
			// Checking if the Article is greter than 0 or 1.
			if ( 0 === $t->count ) {
				echo esc_html( $t->count ) . ' Article';
			} else {
				/* translators: %s: search term */
				$article = sprintf( _n( '%d Article', '%d Articles', wp_get_postcount( $t->term_id, $t->taxonomy ), 'smart-docs' ), number_format_i18n( wp_get_postcount( $t->term_id, $t->taxonomy ) ) );
				echo esc_html( $article );
			}
			?>
		</p>
	</a>
</div>
