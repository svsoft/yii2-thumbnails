<?php

namespace svsoft\yii\thumbnails;

use svsoft\thumbnails\ImageStorageInterface;
use svsoft\thumbnails\ThumbnailsInterface;
use svsoft\thumbnails\ThumbCreator;
use svsoft\thumbnails\ThumbCreatorInterface;
use svsoft\thumbnails\ThumbManager;
use svsoft\thumbnails\ThumbManagerInterface;
use svsoft\thumbnails\ThumbStorageInterface;
use yii\base\BaseObject;

/**
 * Class Thumbnails
 * @package svsoft\yii\thumbnails
 *
 * @property \svsoft\thumbnails\ThumbCreatorInterface $creator
 * @property \svsoft\thumbnails\ThumbManagerInterface $manager
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class Thumbnails extends BaseObject implements ThumbnailsInterface
{
    /**
     * @var AbstractFactory[]
     */
    public $thumbs;

    /**
     * Путь до папки где будут хранится превьюшки
     * Передается в thumbStorage если он не описан
     *
     * @var
     */
    public $dirPath;

    /**
     * Урл по которому будут доступны превьюхи
     * Передается в thumbStorage если он не описан
     *
     * @var
     */
    public $webDirPath;


    /**
     * @var AbstractFactory|ImageStorageInterface
     */
    public $imageStorage;

    /**
     * @var AbstractFactory|ThumbStorageInterface
     */
    public $thumbStorage;


    /**
     * @var ThumbManagerInterface
     */
    private $_manager;

    /**
     * @var ThumbCreatorInterface
     */
    private $_creator;

    public function getManager() : ThumbManagerInterface
    {
        if ($this->_manager === null)
        {
            $this->_manager = new ThumbManager();

            $thumbs = $this->normalizeThumbs($this->thumbs);

            $ownerThumbs = [];
            foreach($thumbs as $key=>$thumb)
            {
                $ownerThumbs[$key] = $thumb->create();
            }

            $this->_manager->setThumbs($ownerThumbs);

            unset($this->thumbs);
        }

        return $this->_manager;
    }

    public function getCreator(): ThumbCreatorInterface
    {
        if ($this->_creator === null)
        {
            if (!$this->thumbStorage instanceof ThumbStorageInterface)
            {
                /** @var AbstractFactory|array $adapter */
                $factory = $this->thumbStorage;

                if (!$factory)
                {
                    // Если не описан thumbStorage, то инициализируем из dirPath и webDirPath
                    $factory = [
                        'class'      => ThumbLocalStorageFactory::class,
                        'dirPath'    => $this->dirPath,
                        'webDirPath' => $this->webDirPath,
                    ];
                }

                /** @var AbstractFactory $adapter */
                $factory = \Yii::createObject($factory);

                $this->thumbStorage = $factory->create();
            }

            if (!$this->imageStorage instanceof ImageStorageInterface)
            {
                $factory = $this->imageStorage;
                if (empty($factory['class']))
                    $factory['class'] = ImageLocalStorageFactory::class;

                /** @var AbstractFactory $adapter */
                $factory = \Yii::createObject($factory);

                $this->imageStorage = $factory->create();
            }

            $this->_creator = new ThumbCreator($this->imageStorage, $this->thumbStorage);
        }

        return $this->_creator;
    }

    /**
     * @param $thumbs
     *
     * @return ThumbFactory[]
     * @throws \yii\base\InvalidConfigException
     */
    private function normalizeThumbs($thumbs)
    {
        foreach($thumbs as $key=>$thumb)
        {
            if (empty($thumb['handlers']))
            {
                if (!is_int(key($thumb)))
                    $handlers = [$thumb];
                else
                    $handlers = $thumb;

                $thumb = [
                    'handlers' => $handlers,
                ];
            }

            if ( empty($thumb['class']))
                $thumb['class'] = ThumbFactory::class;

            $thumb = \Yii::createObject($thumb);

            $thumbs[$key] = $thumb;
        }

        return $thumbs;
    }

    function thumb(string $imageUri, string $thumbId) : string
    {
        $thumb = $this->getManager()->getThumb($thumbId);

        return $this->getCreator()->create($imageUri, $thumb);
    }

}