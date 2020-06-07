<?php
namespace Plex\Server\Library\Item;

use Plex\Server\Library\ItemChildAbstract;

/**
 * Plex Library Track
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
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
 * Represents a Plex track.
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Track
    extends ItemChildAbstract
{
    /**
     * Original title of the artist.
     * @var string
     */
    private $originalTitle;

    /**
     * Sets an array of attributes, if they exist, to the corresponding class
     * member.
     *
     * @param array $attribute An array of item attributes as passed back by the
     * Plex HTTP API.
     *
     * @uses ItemAbstract::setAttributes()
     *
     * @return void
     */
    public function setAttributes($attribute)
    {
        parent::setAttributes($attribute);

        if (isset($attribute['originalTitle'])) {
            $this->setOriginalTitle($attribute['originalTitle']);
        }
    }

    /**
     * Returns the original title.
     *
     * @uses Track::$originalTitle
     *
     * @return string The original title.
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * Sets the original title.
     *
     * @param string $originalTitle The original title.
     *
     * @uses Track::$originalTitle
     *
     * @return void
     */
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;
    }
}
