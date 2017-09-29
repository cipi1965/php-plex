<?php

namespace Wubs\Plex\Server\Library\Item;

use Wubs\Plex\Server\Library\ItemChildAbstract;

/**
 * Plex Library Movie
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
 * Represents a Plex movie.
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Movie
    extends ItemChildAbstract
{
    /**
     * Studio that released the movie.
     * @var string
     */
    private $studio;

    /**
     * Tagline of the movie.
     * @var string
     */
    private $tagline;

    /**
     * Sets an array of attributes, if they exist, to the corresponding class
     * member.
     *
     * @param array $attribute An array of item attributes as passed back by the
     * Plex HTTP API.
     *
     * @uses ItemAbstract::setAttributes()
     * @uses Item_Movie::setStudio()
     * @uses Item_Movie::setTagline()
     *
     * @return void
     */
    public function setAttributes($attribute)
    {
        parent::setAttributes($attribute);

        if (isset($attribute['studio'])) {
            $this->setStudio($attribute['studio']);
        }
        if (isset($attribute['tagline'])) {
            $this->setTagline($attribute['tagline']);
        }
    }

    /**
     * Returns the studio of the movie.
     *
     * @uses Item_Movie::$studio
     *
     * @return string The studio of the movie.
     */
    public function getStudio()
    {
        return $this->studio;
    }

    /**
     * Sets the studio of the movie.
     *
     * @param string $studio The studio of the movie.
     *
     * @uses Item_Movie::$studio
     *
     * @return void
     */
    public function setStudio($studio)
    {
        $this->studio = $studio;
    }

    /**
     * Returns the tagline of the movie.
     *
     * @uses Item_Movie::$tagline
     *
     * @return string The tagline of the movie.
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Sets the tagline of the movie.
     *
     * @param string $tagline The tagline of the movie.
     *
     * @uses Item_Movie::$tagline
     *
     * @return void
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;
    }
}
