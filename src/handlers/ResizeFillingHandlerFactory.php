<?php

namespace svsoft\yii\thumbnails\handlers;

use svsoft\yii\thumbnails\AbstractFactory;


/**
 * Factory for creating \svsoft\thumbnails\handlers\ResizeFillingHandler
 *
 * Class ResizeFillingHandlerFactory
 * @package svsoft\yii\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeFillingHandlerFactory extends AbstractFactory
{
    public $width;

    public $height;

    public $color;

    public $opacity;

    function create()
    {
        $handler = new \svsoft\thumbnails\handlers\ResizeFillingHandler($this->width, $this->height);

        if ($this->opacity)
            $handler->opacity = $this->opacity;

        if ($this->color)
            $handler->color = $this->color;

        return $handler;
    }
}