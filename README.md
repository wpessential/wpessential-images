# WPEssential Images
WPEssential Images helping for the images registry in WordPress.

`composer require wpessential-images`

Add the images to WordPress registry

```php
use WPEssential\Library\Images;

$prefix ='wpe';
$images = Images::make( $prefix );
$images->add([
	'name'  => 'featured_image_1980x9999',
	'size'  => [ 'w' => 1980, 'h' => 9999 ],
	'croup' => true
]);
$images->init();
```

Remove the images from WordPress registry

```php
use WPEssential\Library\Images;

$prefix ='wpe';
$images = Images::make( $prefix );
$images->remove('featured_image_1980x9999');
$images->init();
```
