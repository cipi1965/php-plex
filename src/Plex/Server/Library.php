<?php
namespace Plex\Server;

use Plex\Exception\Server as ServerException;
use Plex\Exception\Server\Library as LibraryException;
use Plex\Server;
use Plex\Server\Library\ItemAbstract;
use Plex\Server\Library\SectionAbstract;

/**
 * Plex Server Library
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2
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
 * Class that represents a Plex library and allows interaction with its sections
 * and items.
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2
 */
class Library extends Server
{
    /**
     * URL endpoint for Plex server library.
     */
    const ENDPOINT_LIBRARY = 'library';

    /**
     * URL endpoint for library sections.
     */
    const ENDPOINT_SECTION = 'sections';

    /**
     * URL endpoint for a library's recently added items.
     */
    const ENDPOINT_RECENTLY_ADDED = 'recentlyAdded';

    /**
     * URL endpoint for a library's on deck items.
     */
    const ENDPOINT_ON_DECK = 'onDeck';

    /**
     * URL endpoint for single library items.
     */
    const ENDPOINT_METADATA = 'metadata';

    /**
     * String that identifies a Plex library movie item type.
     */
    const TYPE_MOVIE = 'movie';

    /**
     * String that identifies a Plex library artist item type.
     */
    const TYPE_ARTIST = 'artist';

    /**
     * String that identifies a Plex library album item type.
     */
    const TYPE_ALBUM = 'album';

    /**
     * String that identifies a Plex library track item type.
     */
    const TYPE_TRACK = 'track';

    /**
     * String that identifies a Plex library photo item type.
     */
    const TYPE_PHOTO = 'photo';

    /**
     * String that identifies a Plex library TV show item type.
     */
    const TYPE_SHOW = 'show';

    /**
     * String that identifies a Plex library TV season item type.
     */
    const TYPE_SEASON = 'season';

    /**
     * String that identifies a Plex library episode item type.
     */
    const TYPE_EPISODE = 'episode';

    /**
     * Generic way of building a url agains the Plex library.
     *
     * @uses MachineAbstract::getBaseUrl()
     * @uses Library::ENDPOINT_LIBRARY
     *
     * @param $endpoint
     * @return string A Plex library URL based on the given endpoint.
     */
    protected function buildUrl($endpoint)
    {
        $endpoint = sprintf(
            '%s/%s',
            self::ENDPOINT_LIBRARY,
            $endpoint
        );

        // Some of the polymorphic methods leave double slashes, so here we
        // simply clean them up.
        $endpoint = str_replace('///', '/', $endpoint);
        $endpoint = str_replace('//', '/', $endpoint);

        $url = sprintf(
            '%s/%s',
            $this->getBaseUrl(),
            $endpoint
        );

        return $url;
    }

    /**
     * Generic way of requesting Plex library items.
     *
     * @uses MachineAbstract::$name
     * @uses MachineAbstract::$address
     * @uses MachineAbstract::$port
     * @uses MachineAbstract::makeCall()
     * @uses Library::buildUrl()
     * @uses ItemAbstract::factory()
     * @uses ItemInterface::setAttributes()
     *
     * @param $endpoint
     * @returns Item[] An array of plex library items.
     */
    protected function getItems($endpoint)
    {
        $items = array();
        $itemArray = $this->makeCall($this->buildUrl($endpoint));
        
        foreach ($itemArray as $attribute) {
            // Not all attributes at this point have a 'type.' Sometimes they
            // represent a different sort of list like 'All episodes.' In this
            // case we skip it by checking the integrity of the 'type' index.
            // If there is no type index then it is not an item.
            if (isset($attribute['type'])) {
                $item = ItemAbstract::factory(
                    $attribute['type'],
                    $this->name,
                    $this->address,
                    $this->port,
                    $this->token
                );
                $item->setAttributes($attribute);
                $items[] = $item;
            }
        }
        return $items;
    }

    /**
     * Given a function name, uses that name to decide what Plex library item
     * item type with whic the function is associated. This is useful when
     * trying to polymorphically request items because we can use the calling
     * function to abstractly identify what type of item with which we are
     * dealing.
     *
     * @uses Library::TYPE_MOVIE
     * @uses Library::TYPE_ARTIST
     * @uses Library::TYPE_ALBUM
     * @uses Library::TYPE_TRACK
     * @uses Library::TYPE_PHOTO
     * @uses Library::TYPE_SHOW
     * @uses Library::TYPE_SEASON
     * @uses Library::TYPE_EPISODE
     *
     * @param $function
     * @return string The type of item with which the given function is
     * associated.
     */
    public function functionToType($function)
    {
        $availableTypes = array(
            self::TYPE_MOVIE,
            self::TYPE_ARTIST,
            self::TYPE_ALBUM,
            self::TYPE_TRACK,
            self::TYPE_PHOTO,
            self::TYPE_SHOW,
            self::TYPE_SEASON,
            self::TYPE_EPISODE
        );

        foreach ($availableTypes as $type) {
            if (strpos(strtolower($function), $type) != false) {
                return $type;
            }
        }
    }

    /**
     * Returns an array of user defined Plex library sections that can be used
     * to interact with th eitems contained within.
     *
     * @uses MachineAbstract::$name
     * @uses MachineAbstract::$address
     * @uses MachineAbstract::$port
     * @uses MachineAbstract::makeCall()
     * @uses Library::ENDPOINT_SECTION
     * @uses Library::buildUrl()
     * @uses SectionAbstract::factory()
     * @uses SectionAbstract::setAttributes()
     *
     * @return Section[] An array of user defined Plex
     * library sections.
     */
    public function getSections()
    {
        $sections = array();
        $sectionArray = $this->makeCall(
            $this->buildUrl(self::ENDPOINT_SECTION)
        );
        foreach ($sectionArray as $attribute) {
            $section = SectionAbstract::factory(
                $attribute['type'],
                $this->name,
                $this->address,
                $this->port,
                $this->token
            );
            $section->setAttributes($attribute);

            $sections[] = $section;
        }

        return $sections;
    }

    /**
     * Returns a Plex library section by its given key. Here we simpoly run
     * self::getSections() because the endpoint /library/sections/ID does not
     * return full section data, it returns the categories below the section.
     *
     * @param integer $key The key of the requested section.
     *
     * @return SectionAbstract The request library section.
     *
     * @throws \Plex\Exception\Server\Library
     * @uses Section::getKey()
     *
     * @uses Library::getSections()
     * @deprecated This method is deprecated in lieu of the new getSection()
     * method.
     */
    public function getSectionByKey($key)
    {
        foreach ($this->getSections() as $section) {
            if ($section->getKey() === $key) {
                return $section;
            }
        }

        throw new LibraryException(
            'RESOURCE_NOT_FOUND',
            array('section', $key)
        );
    }

    /**
     * Returns a Plex library section by its given key or by a exact match on
     * title. Here we simply run self::getSections() because the endpoint
     * /library/sections/ID does not return full section data, it returns the
     * categories below the section.
     *
     * @param integer|string $polymorphicData The key or title of the requested
     * section.
     *
     * @uses Library::getSections()
     * @uses Section::getKey()
     * @uses Section::getTitle()
     *
     * @return SectionAbstract The request library section.
     *
     * @throws LibraryException()
     */
    public function getSection($polymorphicData)
    {
        // If we have an integer we are getting the section by key.
        if (is_int($polymorphicData)) {
            foreach ($this->getSections() as $section) {
                if ($section->getKey() === $polymorphicData) {
                    return $section;
                }
            }
            // If we have a string we are getting the section by title.
        } else {
            if (is_string($polymorphicData)) {
                foreach ($this->getSections() as $section) {
                    if ($section->getTitle() === $polymorphicData) {
                        return $section;
                    }
                }
            }
        }

        throw new LibraryException(
            'RESOURCE_NOT_FOUND',
            array('section', $polymorphicData)
        );
    }

    /**
     * Returns the recently added items at the library level.
     *
     * @uses Library::getItem()
     * @uses Library::ENDPOINT_RECENTLY_ADDED
     *
     * return Item[] An array of plex library items.
     */
    public function getRecentlyAddedItems()
    {
        return $this->getItems(self::ENDPOINT_RECENTLY_ADDED);
    }

    /**
     * Returns the on deck items at the library level.
     *
     * @uses Library::getItem()
     * @uses Library::ENDPOINT_RECENTLY_ADDED
     *
     * return Item[] An array of plex library items.
     */
    public function getOnDeckItems()
    {
        return $this->getItems(self::ENDPOINT_ON_DECK);
    }
}
