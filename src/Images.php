<?php

namespace WPEssential\Library;

if ( ! \defined( 'ABSPATH' ) )
{
	exit; // Exit if accessed directly.
}

final class Images
{
	protected $add_sizes    = [];
	protected $remove_sizes = [];
	protected $prefix;

	public function __construct ( $prefix = 'wpe' )
	{
		if ( $prefix )
		{
			$this->prefix = $prefix;
		}
	}

	public function init ()
	{
		$this->register();
		$this->unregister();
	}

	public function add ( $args = [] )
	{
		$this->add_sizes = array_merge( $this->add_sizes, $args );

		return $this;
	}

	public function remove ( $args = [] )
	{
		$this->remove_sizes = array_merge( $this->remove_sizes, $args );

		return $this;
	}

	public static function make ( ...$args )
	{
		return new self( ...$args );
	}

	protected function unregister ()
	{
		$images = apply_filters( 'wpe/library/images_remove_sizes', array_merge( $this->remove_sizes, [] ) );
		if ( ! empty( $images ) )
		{
			foreach ( $images as $image )
			{
				remove_image_size( "{$this->prefix}_{$image}" );
			}
		}
	}

	protected function register ()
	{
		$_images = array_merge( $this->add_sizes, [
			[
				'name'  => 'featured_image_1980x9999',
				'size'  => [ 'w' => 1980, 'h' => 9999 ],
				'croup' => true
			]
		] );

		if ( ! empty( $_images ) )
		{
			$images = [];
			foreach ( $_images as $_image )
			{
				$images[ $this->prefix . $_image[ 'name' ] ] = $_image;
			}

			$images = apply_filters( 'wpe/library/images_sizes_add', $images );

			foreach ( $images as $image )
			{
				add_image_size( "{$this->prefix}_{$image[ 'name' ]}", $image[ 'size' ][ 'w' ], $image[ 'size' ][ 'h' ], $image[ 'croup' ] );
			}
		}
	}
}
