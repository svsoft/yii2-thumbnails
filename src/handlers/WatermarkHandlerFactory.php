<?php

namespace svsoft\yii\thumbnails\handlers;

use svsoft\thumbnails\handlers\WatermarkHandler;
use svsoft\yii\thumbnails\AbstractFactory;

/**
 * Class WatermarkHandlerFactory
 * @package svsoft\yii\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class WatermarkHandlerFactory extends AbstractFactory
{
    public $watermarkFilePath;

    public $color;

    public $opacity;

    /**
     * @return WatermarkHandler
     */
    function create()
    {
        $handler = new WatermarkHandler(\Yii::getAlias($this->watermarkFilePath));

        if ($this->color)
            $handler->color = $this->color;

        if ($this->opacity)
            $handler->opacity = $this->opacity;

        return $handler;
    }
}