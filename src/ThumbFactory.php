<?php

namespace svsoft\yii\thumbnails;

use svsoft\yii\thumbnails\handlers\ResizeHandlerFactory;

/**
 * Class ThumbFactory
 * @package svsoft\yii\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ThumbFactory extends AbstractFactory
{
    /**
     * @var AbstractFactory[]
     */
    public $handlers;

    function create()
    {
        $handlers = [];
        foreach($this->handlers as $key=>$handler)
        {
            if (is_array($handler))
            {
                if (empty($handler['class']))
                    $handler['class'] = ResizeHandlerFactory::class;

                $handler = \Yii::createObject($handler);
            }

            $handlers[] = $handler->create();
        }

        return new \svsoft\thumbnails\Thumb($handlers);
    }
}