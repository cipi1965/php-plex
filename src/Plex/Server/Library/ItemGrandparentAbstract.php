<?php

namespace Plex\Server\Library;

    /**
     * Plex Library Grandparent Item
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
 * Base class that represents a Plex library item at the top of the hierarchy.
 * This includes items such as shows and artists. The methods and members,
 * however, are still inherited by parent and child items.
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
abstract class ItemGrandparentAbstract
    extends ItemAbstract
{
    /**
     * Reference to the item's art.
     * @var string
     */
    protected $art;

    /**
     * Number of child items (ItemChildAbstract) that are
     * associated with the grandparent. In the case of Shows this is Episodes,
     * in the case of Artists this is blank, and in the case of Albums this is
     * tracks.
     * @var integer
     */
    protected $leafCount;

    /**
     * Number of child items that have been viewed.
     * @var integer
     */
    protected $viewedLeafCount;

    /**
     * Year the item was released.
     * @var integer
     */
    protected $year;

    /**
     * Third party rating of the item.
     * @var float
     */
    protected $rating;

    /**
     * Content rating of the item. For shows it might be 'TV-PG' and for movies
     * it might be something like 'PG-13.'
     * @var string
     */
    protected $contentRating;

    /**
     * Sets an array of attribues, if they exist, to the corresponding class
     * member.
     *
     * @param array $attribute An array of item attributes as passed back by the
     * Plex HTTP API.
     *
     * @uses ItemGrandparentAbstract::setArt()
     * @uses ItemGrandparentAbstract::setLeafCount()
     * @uses ItemGrandparentAbstract::setViewedLeafCount()
     * @uses ItemGrandparentAbstract::setYear()
     * @uses ItemGrandparentAbstract::setRating()
     * @uses ItemGrandparentAbstract::setContentRating()
     *
     * @return void
     */
    public function setAttributes($attribute)
    {
        parent::setAttributes($attribute);

        if (isset($attribute['art'])) {
            $this->setArt($attribute['art']);
        }
        if (isset($attribute['leafCount'])) {
            $this->setLeafCount($attribute['leafCount']);
        }
        if (isset($attribute['viewedLeafCount'])) {
            $this->setViewedLeafCount($attribute['viewedLeafCount']);
        }
        if (isset($attribute['year'])) {
            $this->setYear($attribute['year']);
        }
        if (isset($attribute['rating'])) {
            $this->setRating($attribute['rating']);
        }
        if (isset($attribute['contentRating'])) {
            $this->setContentRating($attribute['contentRating']);
        }
    }

    /**
     * Returns the reference to the item's art.
     *
     * @uses ItemGrandparentAbstract::$art
     *
     * @return string Reference to the item's art.
     */
    public function getArt()
    {
        return $this->art;
    }

    /**
     * Sets the reference to the item's art.
     *
     * @param string $art Reference to the item's art.
     *
     * @uses ItemGrandparentAbstract::$art
     *
     * @return void
     */
    public function setArt($art)
    {
        $this->art = $art;
    }

    /**
     * Returns the item's leaf count.
     *
     * @uses ItemGrandparentAbstract::$leafCount
     *
     * @return integer The item's leaf count.
     */
    public function getLeafCount()
    {
        return (int)$this->leafCount;
    }

    /**
     * Sets the item's leaf count.
     *
     * @param integer $leafCount The item's leaf count.
     *
     * @uses ItemGrandparentAbstract::$leafCount
     *
     * @return void
     */
    public function setLeafCount($leafCount)
    {
        $this->leafCount = (int)$leafCount;
    }

    /**
     * Returns the item's viewed leaf count.
     *
     * @uses ItemGrandparentAbstract::$viewedLeafCount
     *
     * @return integer The item's viewed leaf count.
     */
    public function getViewedLeafCount()
    {
        return (int)$this->viewedLeafCount;
    }

    /**
     * Sets the item's viewed leaf count.
     *
     * @param $viewedLeafCount
     * @internal param int $leafCount The item's viewed leaf count.
     *
     * @uses ItemGrandparentAbstract::$viewedLeafCount
     *
     * @return void
     */
    public function setViewedLeafCount($viewedLeafCount)
    {
        $this->viewedLeafCount = (int)$viewedLeafCount;
    }

    /**
     * Returns the item's year.
     *
     * @uses ItemGrandparentAbstract::$year
     *
     * @return integer The item's year.
     */
    public function getYear()
    {
        return (int)$this->year;
    }

    /**
     * Sets the item's year.
     *
     * @param integer $year The item's year.
     *
     * @uses ItemGrandparentAbstract::$year
     *
     * @return void
     */
    public function setYear($year)
    {
        $this->year = (int)$year;
    }

    /**
     * Returns the item's rating.
     *
     * @uses ItemGrandparentAbstract::$rating
     *
     * @return float The item's rating.
     */
    public function getRating()
    {
        return (float)$this->rating;
    }

    /**
     * Sets the item's rating.
     *
     * @param float $rating The item's rating.
     *
     * @uses ItemGrandparentAbstract::$rating
     *
     * @return void
     */
    public function setRating($rating)
    {
        $this->rating = (float)$rating;
    }

    /**
     * Returns the item's content rating.
     *
     * @uses ItemGrandparentAbstract::$contentRating
     *
     * @return string The item's content rating.
     */
    public function getContentRating()
    {
        return $this->contentRating;
    }

    /**
     * Sets the item's content rating.
     *
     * @param string $contentRating The item's content rating.
     *
     * @uses ItemGrandparentAbstract::$contentRating
     *
     * @return void
     */
    public function setContentRating($contentRating)
    {
        $this->contentRating = $contentRating;
    }
}
