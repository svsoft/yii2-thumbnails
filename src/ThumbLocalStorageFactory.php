<?php

namespace svsoft\yii\thumbnails;

/**
 * Factory for \svsoft\thumbnails\ThumbLocalStorage
 *
 * Class ThumbLocalStorageFactory
 * @package svsoft\yii\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ThumbLocalStorageFactory extends AbstractFactory
{
    public $dirPath;

    public $webDirPath;

    public $mode = 0755;

    /**
     * @return object
     */
    public function create()
    {
        $owner = new \svsoft\thumbnails\ThumbLocalStorage(\Yii::getAlias($this->dirPath), \Yii::getAlias($this->webDirPath));
        $owner->mode = $this->mode;

        return $owner;
    }
}