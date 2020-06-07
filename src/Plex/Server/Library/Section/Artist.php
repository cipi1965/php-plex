<?php namespace Plex\Server\Library\Section;

use Plex\Server\Library\SectionAbstract;

/**
 * Plex Server Library Artist Section
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
 * Class that represents a Plex library artist section and makes available the
 * retrieval of library child and grandchild music items.
 *
 * @category plex
 * @package Server
 * @subpackage Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Artist
    extends SectionAbstract
{
    /**
     * Endpoint for retrieving albums.
     */
    const ENDPOINT_CATEGORY_ALBUM = 'albums';

    /**
     * Endpoint for retrieving albums by decade.
     */
    const ENDPOINT_CATEGORY_DECADE = 'decade';

    /**
     * Returns all the artists for the given section.
     *
     * @uses SectionAbstract::getAllItems()
     *
     * @return Artist[] An array of artists.
     */
    public function getAllArtists()
    {
        return $this->getAllItems();
    }

    /**
     * Returns all the albusm for the given section.
     *
     * @uses Library::getItems()
     * @uses SectionAbstract::buildEndpoint()
     * @uses Library_Section_Artist::ENDPOINT_CATEGORY_ALBUM
     *
     * @return Item_Album[] An array of albums.
     */
    public function getAllAlbums()
    {
        return $this->getItems(
            $this->buildEndpoint(
                self::ENDPOINT_CATEGORY_ALBUM
            )
        );
    }

    /**
     * Returns all the artists categorized under a given genre.
     *
     * @param integer $genreKey Key that represents the genre by which the
     * artists will be retrieved. The genre key can be discovered by using the
     * getGenres() method from the parent class.
     *
     * @uses SectionAbstract::getItemsByGenre()
     *
     * @return Artist[] An array of artists.
     */
    public function getArtistsByGenre($genreKey)
    {
        return $this->getItemsByGenre($genreKey);
    }

    /**
     * Returns all the albums from a given four digit decade.
     *
     * @param integer $decade Four digit decade by which the albums will be
     * retrieved.
     *
     * @uses Library::getItems()
     * @uses SectionAbstract::buildEndpoint()
     * @uses Library_Section_Artist::ENDPOINT_CATEGORY_DECADE
     *
     * @return Item_Album[] An array of albums.
     */
    public function getAlbumsByDecade($decade)
    {
        return $this->getItems(
            $this->buildEndpoint(
                sprintf(
                    '%s/%d',
                    self::ENDPOINT_CATEGORY_DECADE,
                    $decade
                )
            )
        );
    }

    /**
     * Returns all the albums from a given four digit year.
     *
     * @param integer $year Four digit year by which the albums will be
     * retrieved.
     *
     * @uses SectionAbstract::getItemsByYear()
     *
     * @return Item_Album[] An array of albums.
     */
    public function getAlbumsByYear($year)
    {
        return $this->getItemsByYear($year);
    }

    /**
     * Returns all the artists contained in a given collection.
     *
     * @param integer $collectionKey Key that represents the collection by which
     * the artists will be retrieved. The genre key can be discovered by using
     * the getGenres() method from the parent class.
     *
     * @uses SectionAbstract::getItemsByCollection()
     *
     * @return Artist[] An array of artists.
     */
    public function getArtistsByCollection($collectionKey)
    {
        return $this->getItemsByCollection($collectionKey);
    }

    /**
     * Returns an array of albums recently added to the section.
     *
     * @uses SectionAbstract::getRecentlyAddedSectionItems()
     *
     * @return Item_Album[] An array of albums.
     */
    public function getRecentlyAddedAlbums()
    {
        return $this->getRecentlyAddedSectionItems();
    }

    /**
     * Searches artist titles for the passed query and returns the artists that
     * match.
     *
     * @param string $query The search term against which the artists will be
     * matched.
     *
     * @uses Library::getItems()
     * @uses SectionAbstract::buildSearchEndpoint()
     * @uses SectionAbstract::SEARCH_TYPE_ARTIST
     *
     * @return Artist[] An array of artist objects.
     */
    public function searchArtists($query)
    {
        return $this->getItems(
            $this->buildSearchEndpoint(
                SectionAbstract::SEARCH_TYPE_ARTIST,
                $query
            )
        );
    }

    /**
     * Searches track titles for the passed query and returns the tracks that
     * match.
     *
     * @param string $query The search term against which the tracks will be
     * matched.
     *
     * @uses Library::getItems()
     * @uses SectionAbstract::buildSearchEndpoint()
     * @uses SectionAbstract::SEARCH_TYPE_TRACK
     *
     * @return Track[] An array of track objects.
     */
    public function searchTracks($query)
    {
        return $this->getItems(
            $this->buildSearchEndpoint(
                SectionAbstract::SEARCH_TYPE_TRACK,
                $query
            )
        );
    }

    /**
     * Returns a single artist by its rating key, key, or exact title match.
     *
     * @param integer|string $polymorphicData Either a rating key, a key, or a
     * title for an exact title match that will be used to retrieve a single
     * artist.
     *
     * @uses SectionAbstract::getPolymorphicItem()
     *
     * @retrun Artist A Plex library artist object.
     */
    public function getArtist($polymorphicData)
    {
        return $this->getPolymorphicItem($polymorphicData);
    }

    /**
     * Returns a single track by its rating key, key, or exact title match.
     *
     * @param integer|string $polymorphicData Either a rating key, a key, or a
     * title for an exact title match that will be used to retrieve a single
     * track.
     *
     * @uses SectionAbstract::getPolymorphicItem()
     *
     * @retrun Track A Plex library track object.
     */
    public function getTrack($polymorphicData)
    {
        return $this->getPolymorphicItem($polymorphicData);
    }
}
