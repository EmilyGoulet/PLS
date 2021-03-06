<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business_Point
 */

if ( ! function_exists( 'business_point_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function business_point_posted_on() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ', ');
		if ( $categories_list && business_point_categorized_blog() ) {
			printf( '<span class="cat-links">%s</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'business_point_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function business_point_entry_footer() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'%s',
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		'%s',
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$date_meta = business_point_get_option( 'date_meta' );

	if ( 1 !== absint( $date_meta ) ) : 

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	endif; 

	$author_meta = business_point_get_option( 'author_meta' );

	if ( 1 !== absint( $author_meta ) ) : 

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	endif; 

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'business-point' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">%s</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	$comment_meta = business_point_get_option( 'comment_meta' );

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

		if ( 1 !== absint( $comment_meta ) ) : 

			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'No Comment<span class="screen-reader-text"> on %s</span>', 'business-point' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';

		endif; 
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'business-point' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function business_point_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'business_point_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'business_point_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so business_point_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so business_point_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in business_point_categorized_blog.
 */
function business_point_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Like, beat it. Dig?
	delete_transient( 'business_point_categories' );
}
add_action( 'edit_category', 'business_point_category_transient_flusher' );
add_action( 'save_post',     'business_point_category_transient_flusher' );

if ( ! function_exists( 'business_point_the_custom_logo' ) ) :

	/**
	 * Displays custom logo.
	 *
	 * @since 1.0.0
	 */
	function business_point_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

if ( ! function_exists( 'business_point_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function business_point_primary_navigation_fallback() {
		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'business-point' ) . '</a></li>';
		$args = array(
			'number'       => 4,
			'hierarchical' => false,
			);
		$pages = get_pages( $args );
		if ( is_array( $pages ) && ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				echo '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a></li>';
			}
		}
		echo '</ul>';

	}

endif;