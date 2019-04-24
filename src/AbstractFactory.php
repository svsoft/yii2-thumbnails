<?php

namespace svsoft\yii\thumbnails;

use yii\base\BaseObject;

/**
 * Class AbstractFactory
 * @package svsoft\yii\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
abstract class AbstractFactory extends BaseObject
{
    /**
     * @return object
     */
    abstract public function create();
}