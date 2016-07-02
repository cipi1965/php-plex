<?php

namespace Wubs\Plex\Controller\Application;

use Wubs\Plex\Client\Controller\ControllerAbstract;
use Wubs\Plex\Server\Library\ItemAbstract\ItemAbstract;
use Wubs\Plex\Server\Library\Library;

/**
 * Plex Client Application Controller
 *
 * @category plex
 * @package Client
 * @subpackage Controller
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
 * Represents a Plex client on the network.
 *
 * @category plex
 * @package Client
 * @subpackage Controller
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Application extends ControllerAbstract
{
    /**
     * Given a Plex server library item, this method plays the given item on
     * the Plex client.
     *
     * @param ItemAbstract $item The item to be played.
     * @param integer $viewOffset The point from which to play the item in
     * milliseconds.
     *
     * @uses Library::ENDPOINT_LIBRARY
     * @uses Library::ENDPOINT_METADATA
     * @uses ItemAbstract::getRatingKey()
     * @uses Client::getServer()
     * @uses Server::getBaseUrl()
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function playMedia(
        ItemAbstract $item,
        $viewOffset = null
    ) {
        $key = sprintf(
            '/%s/%s/%d',
            Library::ENDPOINT_LIBRARY,
            Library::ENDPOINT_METADATA,
            $item->getRatingKey()
        );
        $params = array(
            'key' => $key,
            'path' => sprintf(
                '%s%s',
                $this->getServer()->getBaseUrl(),
                $key
            )
        );
        if ($viewOffset) {
            $params['viewOffset'] = $viewOffset;
        }

        $this->executeCommand($params);
    }

    /**
     * Sets the volume to the given percentage level.
     *
     * @param integer $level The percentage level to which teh voume is to be
     * set.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function setVolume($level)
    {
        $params = array(
            'level' => $level
        );

        $this->executeCommand($params);
    }
}
