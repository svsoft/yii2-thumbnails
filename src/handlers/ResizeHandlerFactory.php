<?php

namespace svsoft\yii\thumbnails\handlers;

use svsoft\yii\thumbnails\AbstractFactory;

/**
 * Class ResizeHandlerFactory
 * @package svsoft\yii\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeHandlerFactory extends AbstractFactory
{
    public $width;

    public $height;

    function create()
    {
        return new \svsoft\thumbnails\handlers\ResizeHandler($this->width, $this->height);
    }
}