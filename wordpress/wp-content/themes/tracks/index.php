<?php get_header(); ?>

<?php get_template_part( 'content/archive-header' ); ?>

<div id="loop-container" class="loop-container">
		<?php
		if (is_home ()) {
			$query = new WP_Query ( array (
					'category_name' => 'accueil',
					'orderby' => 'menu_order',
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => - 1 
			) );
			if ($query->have_posts ()) :
				while ( $query->have_posts () ) :
					$query->the_post ();
					ct_tracks_get_content_template ();
				endwhile
				;
			endif;
		} else {
			if (have_posts ()) :
				while ( have_posts () ) :
					the_post ();
					ct_tracks_get_content_template ();
				endwhile
				;
			endif;
		}
		?>
	</div>

<?php

// include loop pagination except for on bbPress Forum root
if (function_exists ( 'is_bbpress' )) {
	if (! (is_bbpress () && is_archive ())) {
		the_posts_pagination ( array (
				'prev_text' => __ ( 'Previous', 'tracks' ),
				'next_text' => __ ( 'Next', 'tracks' ) 
		) );
	}
} else {
	the_posts_pagination ( array (
			'prev_text' => __ ( 'Previous', 'tracks' ),
			'next_text' => __ ( 'Next', 'tracks' ) 
	) );
}

get_footer ();