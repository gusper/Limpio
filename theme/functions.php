<?php

/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list && is_category() == FALSE ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// // Translators: used between list items, there is a space after the comma.
	// $tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	// if ( $tag_list ) {
	// 	echo '<span class="tags-links">' . $tag_list . '</span>';
	// }

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}

function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

/**
 * Modify the footer credits for JetPack Inifite Scroll
 **/
add_filter('infinite_scroll_credit','lc_infinite_scroll_credit');
function lc_infinite_scroll_credit(){
 $content = 'Copyright &copy; 2000-2016 Gus Perez';
 return $content;
}

?>