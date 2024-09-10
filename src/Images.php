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
		$this->add_sizes[] = $args;

		return $this;
	}

	public function adds ( $args = [] )
	{
		foreach ( $args as $arg )
		{
			$this->add_sizes[] = $arg;
		}

		return $this;
	}

	public function remove ( $key = '' )
	{
		$this->remove_sizes[] = $key;

		return $this;
	}

	public function removes ( $keyes = [] )
	{
		foreach ( $keyes as $key )
		{
			$this->remove_sizes[] = $key;
		}

		return $this;
	}

	public static function make ( ...$args )
	{
		return new static( ...$args );
	}

	protected function unregister ()
	{
		$images = apply_filters( 'wpe/library/images_remove_sizes', $this->remove_sizes );
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
		$this->add_sizes[] = [
			[
				'name'  => 'featured_image_1980x9999',
				'size'  => [ 'w' => 1980, 'h' => 9999 ],
				'croup' => true
			]
		];

		if ( ! empty( $this->add_sizes ) )
		{
			$images = apply_filters( 'wpe/library/images_sizes_add', $this->add_sizes );

			foreach ( $images as $image )
			{
				$w    = $image[ 'w' ] ?? 'auto';
				$h    = $image[ 'h' ] ?? 'auto';
				$name = "{$this->prefix}_{$w}x{$h}";

				add_image_size( $name, ( $image[ 'size' ][ 'w' ] ?? 0 ), ( $image[ 'size' ][ 'h' ] ?? 0 ), ( $image[ 'croup' ] ?? false ) );
			}
		}
	}
}
