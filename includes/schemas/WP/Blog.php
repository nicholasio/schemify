<?php
/**
 * A representation of a WordPress Blog.
 *
 * @package Schemify
 * @link    http://schema.org/Organization
 */

namespace Schemify\Schemas\WP;

use Schemify\Schemas as Schemas;

class Blog extends Schemas\Organization {

	use WP_Schema;

	/**
	 * Get the blog's description.
	 *
	 * @param int $blog_id The blog ID. This parameter isn't actually used, but is required so the
	 *                     method signature matches that of Thing::getName().
	 * @return string The blog name.
	 */
	public function getDescription( $blog_id ) {
		return get_bloginfo( 'description' );
	}

	/**
	 * Get the blog's site icon.
	 *
	 * @param int $blog_id The blog ID.
	 * @return string The blog's site icon.
	 */
	public function getImage( $blog_id ) {
		return get_site_icon_url( null, null, $blog_id );
	}

	/**
	 * Get the blog's name.
	 *
	 * @param int $blog_id The blog ID. This parameter isn't actually used, but is required so the
	 *                     method signature matches that of Thing::getName().
	 * @return string The blog name.
	 */
	public function getName( $blog_id ) {
		return get_bloginfo( 'name' );
	}

	/**
	 * Get the blog's URL.
	 *
	 * @param int $blog_id The blog ID. This parameter isn't actually used, but is required so the
	 *                     method signature matches that of Thing::getUrl().
	 * @return string The blog URL.
	 */
	public function getUrl( $blog_id ) {
		return get_bloginfo( 'url' );
	}
}