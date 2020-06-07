<?php

namespace Plex\Server\Library\Item\Media;

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
 * Interface that defines the structure of item media info.
 *
 * @category plex
 * @package Library
 * @subpackage Item
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 */
interface MediaInterface
{
    /**
     * Returns the ID of the media info.
     *
     * @return integer The ID of the media info.
     */
    public function getId();

    /**
     * Sets the ID of the media info.
     *
     * @param integer $id The ID of the media info.
     *
     * @return void
     */
    public function setId($id);

    /**
     * Returns the length of the file.
     *
     * @return integer The length of the file.
     */
    public function getDuration();

    /**
     * Sets the length of the file.
     *
     * @param integer $duration The length of the file.
     *
     * @return void
     */
    public function setDuration($duration);

    /**
     * Returns the bitrate of the file.
     *
     * @return integer The bitrate of the file.
     */
    public function getBitrate();

    /**
     * Sets the bitrate of the file.
     *
     * @param integer $bitrate The bitrate of the file.
     *
     * @return void
     */
    public function setBitrate($bitrate);

    /**
     * Returns the width of the file's video.
     *
     * @return integer The width of the file's video.
     */
    public function getWidth();

    /**
     * Sets the width of the file's video.
     *
     * @param integer $width The width of the file's video.
     *
     * @return void
     */
    public function setWidth($width);

    /**
     * Returns the height of the file's video.
     *
     * @return integer The height of the file's video.
     */
    public function getHeight();

    /**
     * Sets the height of the file's video.
     *
     * @param integer $height The height of the file's video.
     *
     * @return void
     */
    public function setHeight($height);

    /**
     * Returns the aspect ratio of the file's video.
     *
     * @return float The aspect ratio of the file's video.
     */
    public function getAspectRatio();

    /**
     * Sets the aspect ratio of the file's video.
     *
     * @param float $aspectRatio The aspect ratio of the file's video.
     *
     * @return void
     */
    public function setAspectRatio($aspectRatio);

    /**
     * Returns the video resolution of the file's video.
     *
     * @return integer The video resolution of the file's video.
     */
    public function getVideoResolution();

    /**
     * Sets the video resolution of the file's video.
     *
     * @param integer $videoResolution The video resolution of the file's video.
     *
     * @return void
     */
    public function setVideoResolution($videoResolution);

    /**
     * Returns the container of the file.
     *
     * @return string The container of the file.
     */
    public function getContainer();

    /**
     * Sets the container of the file.
     *
     * @param string $container The container of the file.
     *
     * @return void
     */
    public function setContainer($container);

    /**
     * Returns the frame rate of the file's video
     *
     * @return string The frame rate of the file's video.
     */
    public function getVideoFrameRate();

    /**
     * Sets the frame rate of the file's video
     *
     * @param string $videoFrameRate The frame rate of the file's video.
     *
     * @return void
     */
    public function setVideoFrameRate($videoFrameRate);

    /**
     * Returns the files associated with the item.
     *
     * @return Item_Media_File[] Array of media files.
     */
    public function getFiles();

    /**
     * Sets the files associated with the item.
     *
     * @param Item_Media_File[] $files Array of media files.
     *
     * @return void
     */
    public function setFiles($files);
}
