<?php

namespace svsoft\yii\thumbnails;

use svsoft\thumbnails\ImageLocalStorage;

/**
 * Class ImageLocalStorageFactory
 * @package svsoft\yii\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ImageLocalStorageFactory extends AbstractFactory
{
    /**
     * @return object
     */
    public function create()
    {
        return new ImageLocalStorage();
    }
}