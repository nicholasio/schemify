<?php
/**
 * Theme integration points.
 *
 * @package Schemify
 */

namespace Schemify\Theme;

use Schemify\Core as Core;

/**
 * Register default post type support for Schemify.
 */
function register_post_type_support() {
	$post_types = array( 'post', 'page', 'attachment' );

	foreach ( $post_types as $post_type ) {
		add_post_type_support( $post_type, 'schemify' );
	}
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\register_post_type_support' );

/**
 * Set default Schemas for the default post types.
 *
 * @param string $schema    The schema to use for this post.
 * @param string $post_type The current post's post_type.
 * @param int    $post_id   The post ID.
 */
function set_default_schemas( $schema, $post_type, $post_id ) {
	switch ( $post_type ) {
		case 'post':
			$schema = 'BlogPosting';
			break;

		case 'attachment':
			$mime = Core\get_attachment_type( $post_id );

			if ( 'image' === $mime ) {
				$schema = 'ImageObject';
			} else {
				$schema = 'MediaObject';
			}
			break;
	}

	return $schema;
}
add_filter( 'schemify_schema', __NAMESPACE__ . '\set_default_schemas', 1, 3 );

/**
 * Appends the JSON+LD object to the footer of a singular post.
 */
function append_to_singular_footer() {
	if ( ! is_singular() || ! post_type_supports( get_post_type(), 'schemify' ) ) {
		return;
	}

	Core\get_json( get_the_ID() );
}
add_action( 'wp_footer', __NAMESPACE__ . '\append_to_singular_footer' );
