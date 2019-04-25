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

/**
 *
 * Factory for creating \svsoft\thumbnails\handlers\ResizeCropHandler
 *
 * Class ResizeFillingHandlerFactory
 * @package svsoft\yii\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeCropHandlerFactory extends AbstractFactory
{
    public $width;

    public $height;

    public $mode;

    function create()
    {
        $handler = new \svsoft\thumbnails\handlers\ResizeCropHandler($this->width, $this->height ?: $this->width);

        if ($this->mode)
            $handler->mode = $this->mode;

        return $handler;
    }
}