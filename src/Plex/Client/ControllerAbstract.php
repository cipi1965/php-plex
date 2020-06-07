<?php

namespace Plex\Client\Controller;

use Plex\Client\Client;

/**
 * Plex Client Controller
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
abstract class ControllerAbstract extends Client
{
    /**
     * String representing the navigation controller type.
     */
    const TYPE_NAVIGATION = 'navigation';

    /**
     * String representing the playback controller type.
     */
    const TYPE_PLAYBACK = 'playback';

    /**
     * String representing the applicaton controller type.
     */
    const TYPE_APPLICATION = 'application';

    /**
     * Returns the URL representing a Plex client controller command.
     *
     * @param string $controller The controller whose command is to be executed.
     * @param string $command The command to be executed.
     *
     * @uses Client::getServer()
     * @uses Client::getAddress()
     * @uses Server::getBaseUrl()
     *
     * @return string The URL of the Plex client controller command.
     */
    private function buildUrl($controller, $command)
    {
        return sprintf(
            '%s/system/players/%s/%s/%s',
            $this->getServer()->getBaseUrl(),
            $this->getAddress(),
            $controller,
            $command
        );
    }

    /**
     * Using the calling class and function builds and calls the URL for the
     * Plex client controller command.
     *
     * @param array $params An array of parameters that will be used to build an
     * http query string.
     *
     * @uses MachineAbstract::getCallingFunction()
     * @uses MachineAbstract::makeCall()
     * @uses ControllerAbstract::buildUrl()
     *
     * @return void
     */
    protected function executeCommand($params = array())
    {
        $controller = strtolower(array_pop(explode('_', get_class($this))));
        $command = $this->getCallingFunction();
        $url = $this->buildUrl($controller, $command);
        if (count($params) > 0) {
            $url = sprintf(
                '%s?%s',
                $url,
                http_build_query($params)
            );
        }
        $this->makeCall($url);
    }

    /**
     * Static factory method for instantiating and returning a child controller
     * class.
     *
     * @param string $type The type of the controller to be returned.
     * @param string $name The name of the Plex client.
     * @param string $address The IP address of the Plex client.
     * @param integer $port The port on which the Plex client is listening.
     * @param Server $server The server that registered teh client.
     *
     * @uses Client::setServer()
     *
     * @return ControllerAbstract The requested controller object.
     */
    public static function factory(
        $type,
        $name,
        $address,
        $port,
        Server $server
    ) {
        $classString = sprintf(
            'Controller_%s',
            ucfirst($type)
        );
        $controller = new $classString(
            $name,
            $address,
            $port
        );
        $controller->setServer($server);
        return $controller;
    }
}
