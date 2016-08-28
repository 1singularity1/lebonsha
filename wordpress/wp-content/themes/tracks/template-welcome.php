<?php
/*
 * Template Name: Welcome template
 */
?>

<?php get_header(); ?>

<?php get_template_part( 'content/archive-header' ); ?>

<div id="loop-container" class="loop-container">
		<?php $args = array( 'category_name' => 'clothes', 'posts_per_page' => -1, 'meta_key'=>'soldout',  'orderby' => 'meta_value_num', 'order' => 'ASC' );
	//$query = new WP_Query('category_name=clothes&posts_per_page=-1'); 
	$query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1));
	?>
 	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<?php
// 				if (in_category('dresses')) {
					/* Include the Post-Format-specific template for the content.
				 	* If you want to overload this in a child theme then include a file
				 	* called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 	*/
				get_template_part( 'content', 'archive' );
		// 				}
			?>
		<?php endwhile; ?>
	<?php endif; ?>
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
