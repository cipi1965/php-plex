<?php
namespace Plex\Server\Library\Item\Media;

use Plex\Server\Library\Item\Media\MediaInterface;

/**
 * Plex Library Item Media
 *
 * @category plex
 * @package Library
 * @subpackage Item
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 *
 * This file is part of plex.
 *
 * plex is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * plex is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Class that represents the media info a Plex Server Library Item.
 *
 * @category plex
 * @package Library
 * @subpackage Item
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 */
class Media
    implements MediaInterface
{
    /**
     * ID of the media info.
     * @var integer
     */
    private $id;

    /**
     * Length of the file in milliseconds.
     * @var integer
     */
    private $duration;

    /**
     * Bitrate of the file in kilobytes per second.
     * @var integer
     */
    private $bitrate;

    /**
     * Width of the file's video in pixels.
     * @var integer
     */
    private $width;

    /**
     * Height of the file's video in pixels.
     * @var integer
     */
    private $height;

    /**
     * Aspect ration of the file's video.
     * @var float
     */
    private $aspectRatio;

    /**
     * Resolution of the file's video.
     * @var integer
     */
    private $videoResolution;

    /**
     * Container of the file.
     * @var string
     */
    private $container;

    /**
     * Frame rate of the file's video.
     * @var string
     */
    private $videoFrameRate;

    /**
     * The files associated with the item.
     * @var Item_Media_File[]
     */
    private $files;

    /**
     * Sets an array of media info to their corresponding class members.
     *
     * @param array $rawMedia An array of the raw media info returned from the
     * Plex HTTP API.
     *
     * @uses Item_Media::setId()
     * @uses Item_Media::setDuration()
     * @uses Item_Media::setBitrate()
     * @uses Item_Media::setWidth()
     * @uses Item_Media::setHeight()
     * @uses Item_Media::setAspectRatio()
     * @uses Item_Media::setVideoResolution()
     * @uses Item_Media::setContainer()
     * @uses Item_Media::setVideoFrameRate()
     * @uses Item_Media::setFiles()
     * @uses Item_Media_File()
     *
     * @return void
     */
    public function __construct($rawMedia)
    {
        if (isset($rawMedia['id'])) {
            $this->setId($rawMedia['id']);
        }
        if (isset($rawMedia['duration'])) {
            $this->setDuration($rawMedia['duration']);
        }
        if (isset($rawMedia['bitrate'])) {
            $this->setBitrate($rawMedia['bitrate']);
        }
        if (isset($rawMedia['width'])) {
            $this->setWidth($rawMedia['width']);
        }
        if (isset($rawMedia['height'])) {
            $this->setHeight($rawMedia['height']);
        }
        if (isset($rawMedia['aspectRatio'])) {
            $this->setAspectRatio($rawMedia['aspectRatio']);
        }
        if (isset($rawMedia['videoResolution'])) {
            $this->setVideoResolution($rawMedia['videoResolution']);
        }
        if (isset($rawMedia['container'])) {
            $this->setContainer($rawMedia['container']);
        }
        if (isset($rawMedia['videoFrameRate'])) {
            $this->setVideoFrameRate($rawMedia['videoFrameRate']);
        }

        $files = array();
        foreach ($rawMedia['Part'] as $file) {
            $files[] = new File\File($file);
        }

        if (!empty($files)) {
            $this->setFiles($files);
        }
    }

    /**
     * Returns the ID of the media info.
     *
     * @uses Item_Media::$id
     *
     * @return integer The ID of the media info.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the ID of the media info.
     *
     * @param integer $id The ID of the media info.
     *
     * @uses Item_Media::$id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns the length of the file.
     *
     * @uses Item_Media::$duration
     *
     * @return integer The length of the file.
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the length of the file.
     *
     * @param integer $duration The length of the file.
     *
     * @uses Item_Media::$duration
     *
     * @return void
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * Returns the bitrate of the file.
     *
     * @uses Item_Media::$bitrate
     *
     * @return integer The bitrate of the file.
     */
    public function getBitrate()
    {
        return $this->bitrate;
    }

    /**
     * Sets the bitrate of the file.
     *
     * @param integer $bitrate The bitrate of the file.
     *
     * @uses Item_Media::$bitrate
     *
     * @return void
     */
    public function setBitrate($bitrate)
    {
        $this->bitrate = $bitrate;
    }

    /**
     * Returns the width of the file's video.
     *
     * @uses Item_Media::$width
     *
     * @return integer The width of the file's video.
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the width of the file's video.
     *
     * @uses Item_Media::$width
     *
     * @param integer $width The width of the file's video.
     *
     * @return void
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Returns the height of the file's video.
     *
     * @uses Item_Media::$height
     *
     * @return integer The height of the file's video.
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the height of the file's video.
     *
     * @uses Item_Media::$height
     *
     * @param integer $height The height of the file's video.
     *
     * @return void
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Returns the aspect ratio of the file's video.
     *
     * @uses Item_Media::$aspectRatio
     *
     * @return float The aspect ratio of the file's video.
     */
    public function getAspectRatio()
    {
        return $this->aspectRatio;
    }

    /**
     * Sets the aspect ratio of the file's video.
     *
     * @uses Item_Media::$aspectRatio
     *
     * @param float $aspectRatio The aspect ratio of the file's video.
     *
     * @return void
     */
    public function setAspectRatio($aspectRatio)
    {
        $this->aspectRatio = $aspectRatio;
    }

    /**
     * Returns the video resolution of the file's video.
     *
     * @uses Item_Media::$videoResolution
     *
     * @return integer The video resolution of the file's video.
     */
    public function getVideoResolution()
    {
        return $this->videoResolution;
    }

    /**
     * Sets the video resolution of the file's video.
     *
     * @uses Item_Media::$videoResolution
     *
     * @param integer $videoResolution The video resolution of the file's video.
     *
     * @return void
     */
    public function setVideoResolution($videoResolution)
    {
        $this->videoResolution = $videoResolution;
    }

    /**
     * Returns the container of the file.
     *
     * @uses Item_Media::$container
     *
     * @return string The container of the file.
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Sets the container of the file.
     *
     * @uses Item_Media::$container
     *
     * @param string $container The container of the file.
     *
     * @return void
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * Returns the frame rate of the file's video
     *
     * @uses Item_Media::$videoFrameRate
     *
     * @return string The frame rate of the file's video.
     */
    public function getVideoFrameRate()
    {
        return $this->videoFrameRate;
    }

    /**
     * Sets the frame rate of the file's video
     *
     * @uses Item_Media::$videoFrameRate
     *
     * @param string $videoFrameRate The frame rate of the file's video.
     *
     * @return void
     */
    public function setVideoFrameRate($videoFrameRate)
    {
        $this->videoFrameRate = $videoFrameRate;
    }

    /**
     * Returns the files associated with the item.
     *
     * @uses Item_Media::$files
     *
     * @return Item_Media_File[] Array of media files.
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Sets the files associated with the item.
     *
     * @uses Item_Media::$files
     *
     * @param Item_Media_File[] $files Array of media files.
     *
     * @return void
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }
}
