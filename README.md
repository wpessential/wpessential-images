# WPEssential Images
Help to register the images in WordPress.

`composer require wpessential-images`

Add the single image to WordPress registry

```php
$prefix ='wpe';
$images = \WPEssential\Library\Images::make( $prefix );
$images->add([
	'size'  => [ 'w' => 1980, 'h' => 9999 ],
	'croup' => true
]);
$images->init();
```

Add the multiple images to WordPress registry

```php
$prefix ='wpe';
$images = \WPEssential\Library\Images::make( $prefix );
$images->add([
	[
		'size'  => [ 'w' => 1920, 'h' => 1080 ],
		'croup' => true
	],
	[
		'size'  => [ 'w' => 1980, 'h' => 9999 ],
		'croup' => true
	]
]);
$images->init();
```

Remove the single image from WordPress registry

```php
$prefix ='wpe';
$images = \WPEssential\Library\Images::make( $prefix );
$images->remove('1920x1080');
$images->init();
```

Remove the multiple image from WordPress registry

```php
$prefix ='wpe';
$images = \WPEssential\Library\Images::make( $prefix );
$images->remove(['1920x1080']);
$images->init();
```
