yii2-thumbnails
===================

It is adapter for Yii2 based on [svsoft/thumbnails](https://github.com/svsoft/thumbnails) component for resize images on native php.

Creates thumbnails of pictures with various handlers: resize, crop, fill, watermark.
You can also create your handlers, and add them to the description of the thumbnail.


### Features:
* Supports different types of source image storage.
* Supports various types of thumbnail storage
* Ability to create your own storage types (ftp, Database, Http)
* Simple apply of new handlers In the previously described thumbnails
* Ability to create your own custom image handlers


In the library everywhere is used interfaces, you can implementation necessary logic in your classes

Installation
---

### Composer
add to composer.json
```json
{
	"require": {
  		"svsoft/yii2-thumbnails": "*"
	}
}
```
and run ```php composer.phar update```

Or
 
run ```php composer.phar require svsoft/yii2-thumbnails ```

Config
---
Add to config
```php
'components' => [
    // ....
    'thumbnails' => [
                'class' => \svsoft\yii\thumbnails\Thumbnails::class,
                // 
                'dirPath' => '@app/web/resize',
                'webDirPath' => '@web/resize',
                'thumbs' => [
                    // Short description thumbnail
                    'logo'=> [
                        // simple resize 200x40
                        'width'  => 200,
                        'height' => 40,
                    ],
                    'favicon'=> [
                        // Resize fixed size filled with transparent fields
                        'class'=> \svsoft\yii\thumbnails\handlers\ResizeFillingHandlerFactory::class,
                        'width'  => 40,
                        'height'  => 40,
                    ],
                    // Full description of thumbnail
                    'product'=>[
                        'class' => \svsoft\yii\thumbnails\ThumbFactory::class,
                        'handlers' => [
                            [
                                'class' => \svsoft\yii\thumbnails\handlers\ResizeCropHandlerFactory::class,
                                'width'  => 600,
                                'height' => 600,
                            ],
                            [
                                'class' => \svsoft\yii\thumbnails\handlers\WatermarkHandlerFactory::class,
                                'watermarkFilePath' => '@app/web/images/watermark.jpg',
                                'opacity' => 50,
                            ],
                        ],
                    ],
                    
                    // ...
                ]
            ],    // ....
],
```

#### Properties

- dirPath - Path to thumbnail file storage directory
- webDirPath - Public web path to thumbnail file storage directory
- thumbs - List of thumbnail configuration
- $imageStorage - Not required. Description of image storage. 
Now implementation only local image storage which is set by default set. (FTP, HTTP, DB NOT IMPLEMENTATION!)
- $thumbStorage - Not required. Description of thumb storage. 
Now implementation only local thumb storage which is set by default set. (FTP, HTTP, DB NOT IMPLEMENTATION!)


#### Handler classes
```
\svsoft\yii\thumbnails\handlers\ResizeCropHandlerFactory - fixed resize and crop 
\svsoft\yii\thumbnails\handlers\ResizeFillingHandlerFactory - fixed resize with filling fields
\svsoft\yii\thumbnails\handlers\ResizeHandlerFactory - resize to a certain size
\svsoft\yii\thumbnails\handlers\WatermarkHandlerFactory - watermark overlay
```
Each handler has its own settings, you can see them in the appropriate class/

You can add your handlers.

Using
---

How to get the component where it will be used depends on the application and developer. via service locator, singleton, container, etc.

Example output favicon
```html
    <link rel="shortcut icon" href="<?=Yii::$app->thumbnails->thumb('/var/www/site.ru/images/1.jpg', 'favicon') ?>" type="image/png">
```

Example output image of product in tag img 
```html
     <img src="<?=Yii::$app->thumbnails->thumb('/var/www/site.ru/images/product/product-1.jpg', 'product') ?>">
 ```
 
   
 