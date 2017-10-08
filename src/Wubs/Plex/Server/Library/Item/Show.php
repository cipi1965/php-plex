<?php
namespace Wubs\Plex\Server\Library\Item;

use Wubs\Plex\Server\Library\ItemGrandparentAbstract;

/**
 * Plex Library Show
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
 * Represents a Plex show.
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Show
    extends ItemGrandparentAbstract
{
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
    }

    /**
     * Returns an array of all the season objects for the intstantiated show.
     *
     * @uses Library::getItems()
     * @uses ItemAbstract::buildChildrenEndpoint()
     *
     * @return Item_Season[] An array of Plex library season
     * objects.
     */
    public function getSeasons()
    {
        return $this->getItems(
            $this->buildChildrenEndpoint()
        );
    }

    /**
     * Returns a single season by index, key, or exact title match.
     *
     * @param integer|string $polymorphicData Either an index, a key, or a title
     * for an exact title match that will be used to retrieve a single season.
     *
     * @uses ItemAbstract::getPolymorphicItem()
     *
     * @return Item_Season A single season.
     */
    public function getSeason($polymorphicData)
    {
        return $this->getPolymorphicItem($polymorphicData);
    }

    /**
     * Returns all the episodes for a given show.
     *
     * @uses Library::getItems()
     * @uses ItemAbstract::buildAllLeavesEndpoint()
     *
     * @ return Item_Episode[] Array of all the episodes for
     * a given show.
     */
    public function getAllEpisodes()
    {
        return $this->getItems(
            $this->buildAllLeavesEndpoint()
        );
    }

    /**
     * Returns a single random episode for a given show.
     *
     * @uses Item_Show::getAllEpisodes()
     *
     * @return Item_Episode A single random episode.
     */
    public function getRandomEpisode()
    {
        $allEpisodes = $this->getAllEpisodes();
        $ceiling = count($allEpisodes) - 1;
        $randomNumber = mt_rand(0, $ceiling);
        return $allEpisodes[$randomNumber];
    }
}
