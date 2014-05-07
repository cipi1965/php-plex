<?php
namespace Wubs\Plex\Server\Library;

use Wubs\Plex\Server\Library\ItemGrandparentAbstract;

/**
 * Plex Library Parent Item
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
 * Base class that represents a Plex library item in the middle of the
 * hierarchy. This includes items such as seasons and albums. The methods and
 * members, however, are still inherited by the child items.
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
abstract class ItemParentAbstract
    extends ItemGrandparentAbstract

{
    /**
     * Unique integer that represents a parent item and helps build its key
     * string.
     * @var integer
     */
    protected $parentRatingKey;

    /**
     * Parent item's key.
     * @var string
     */
    protected $parentKey;

    /**
     * Parent item's title.
     * @var string
     */
    protected $parentTitle;

    /**
     * Parent item's index.
     * @var integer
     */
    protected $parentIndex;

    /**
     * Reference to the parent item's thumb.
     * @var string
     */
    protected $parentThumb;

    /**
     * Date the item was made originally available.
     * @var \DateTime
     */
    protected $originallyAvailalbleAt;

    /**
     * Sets an array of attribues, if they exist, to the corresponding class
     * member.
     *
     * @param array $attribute An array of item attributes as passed back by the
     * Plex HTTP API.
     *
     * @uses ItemParentAbstract::setParentRatingKey()
     * @uses ItemParentAbstract::setParentKey()
     * @uses ItemParentAbstract::setParentTitle()
     * @uses ItemParentAbstract::setParentIndex()
     * @uses ItemParentAbstract::setParentThumb()
     * @uses ItemParentAbstract::originallyAvailableAt()
     *
     * @return void
     */
    public function setAttributes($attribute)
    {
        parent::setAttributes($attribute);

        if (isset($attribute['parentRatingKey'])) {
            $this->setParentRatingKey($attribute['parentRatingKey']);
        }
        if (isset($attribute['parentKey'])) {
            $this->setParentKey($attribute['parentKey']);
        }
        if (isset($attribute['parentTitle'])) {
            $this->setParentTitle($attribute['parentTitle']);
        }
        if (isset($attribute['parentIndex'])) {
            $this->setParentIndex($attribute['parentIndex']);
        }
        if (isset($attribute['parentThumb'])) {
            $this->setParentThumb($attribute['parentThumb']);
        }
        if (isset($attribute['originallyAvailableAt'])) {
            $this->setOriginallyAvailableAt(
                $attribute['originallyAvailableAt']
            );
        }
    }

    /**
     * Returns the parent item's rating key.
     *
     * @uses ItemParentAbstract::$parentRatingKey
     *
     * @return integer The parent item's rating key.
     */
    public function getParentRatingKey()
    {
        return (int)$this->parentRatingKey;
    }

    /**
     * Sets the parent item's rating key.
     *
     * @param integer $parentRatingKey The parent item's rating key.
     *
     * @uses ItemParentAbstract::$parentRatingKey
     *
     * @return void
     */
    public function setParentRatingKey($parentRatingKey)
    {
        $this->parentRatingKey = (int)$parentRatingKey;
    }

    /**
     * Returns the parent item's key.
     *
     * @uses ItemParentAbstract::$parentKey
     *
     * @return string The parent item's key.
     */
    public function getParentKey()
    {
        return $this->parentKey;
    }

    /**
     * Sets the parent item's key.
     *
     * @param string $parentKey The parent item's key.
     *
     * @uses ItemParentAbstract::$parentKey
     *
     * @return void
     */
    public function setParentKey($parentKey)
    {
        $this->parentKey = $parentKey;
    }

    /**
     * Returns the parent item's title.
     *
     * @uses ItemParentAbstract::$parentTitle
     *
     * @return string The parent item's title.
     */
    public function getParentTitle()
    {
        return $this->parentTitle;
    }

    /**
     * Sets the parent item's title.
     *
     * @param string $parentTitle string The parent item's title.
     *
     * @uses ItemParentAbstract::$parentTitle
     *
     * @return void
     */
    public function setParentTitle($parentTitle)
    {
        $this->parentTitle = $parentTitle;
    }

    /**
     * Returns the parent item's index.
     *
     * @uses ItemParentAbstract::$parentIndex
     *
     * @return integer The parent item's index.
     */
    public function getParentIndex()
    {
        return (int)$this->parentIndex;
    }

    /**
     * Sets the parent item's index.
     *
     * @param integer $parentRatingKey The parent item's index.
     *
     * @uses ItemParentAbstract::$parentIndex
     *
     * @return void
     */
    public function setParentIndex($parentIndex)
    {
        $this->parentIndex = (int)$parentIndex;
    }

    /**
     * Returns the parent item's thumb.
     *
     * @uses ItemParentAbstract::$parentThumb
     *
     * @return string The parent item's thumb.
     */
    public function getParentThumb()
    {
        return $this->parentThumb;
    }

    /**
     * Sets the parent item's thumb.
     *
     * @param string $parentTitle string The parent item's thumb.
     *
     * @uses ItemParentAbstract::$parentThumb
     *
     * @return void
     */
    public function setParentThumb($parentThumb)
    {
        $this->parentThumb = $parentThumb;
    }

    /**
     * Returns the date at which the item was made available.
     *
     * @uses ItemAbstract::$originallyAvailableAt
     *
     * @return \DateTime The time at which the item was made available.
     */
    public function getOriginallyAvailalbleAt()
    {
        return $this->originallyAvailableAt;
    }

    /**
     * Sets the time at which the item was made available.
     *
     * @param integer $updatedAtTs The unix timestamp representing the time the
     * item was made available. This will be turned into a \DateTime object.
     *
     * @uses ItemAbstract::$originallyAvailableAt
     *
     * @return void
     */
    public function setOriginallyAvailableAt($originallyAvailableAtTs)
    {
        $originallyAvailableAt = new \DateTime($originallyAvailableAtTs);
        $this->originallyAvailableAt = $originallyAvailableAt;
    }
}
