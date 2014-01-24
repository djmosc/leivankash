<div class="options clearfix">
	<div class="pagination">
	<?php
		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_text' => __('Previous'),
			'next_text' => __('Next')
		) );
		?>
		/ <a href="?view_all"><?php _e("View All", THEME_NAME); ?></a>
	</div>
	<div class="result-count">
		<?php
		$paged    = max( 1, $wp_query->get( 'paged' ) );
		$per_page = $wp_query->get( 'posts_per_page' );
		$total    = $wp_query->found_posts;
		$first    = ( $per_page * $paged ) - $per_page + 1;
		$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

		if ( 1 == $total ) {
			_e( 'Showing the single result', 'woocommerce' );
		} elseif ( $total <= $per_page ) {
			printf( __( 'Showing all %d results', 'woocommerce' ), $total );
		} else {
			printf( _x( 'Showing %1$d–%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
		}
		?>
	</div>
</div>