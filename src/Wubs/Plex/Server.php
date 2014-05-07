<?php

namespace Wubs\Plex;

use Wubs\Plex\Machine\MachineAbstract;
//use Wubs\Plex\Client;
use Wubs\Plex\Server\Library;


/**
 * Plex Server
 *
 * @category plex
 * @package Server
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
 * Represents a Plex server on the network.
 *
 * @category plex
 * @package Server
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Server extends MachineAbstract
{
    /**
     * The default port on which a Plex server listens.
     */
    const DEFAULT_PORT = 32400;

    /**
     * The Plex HTTP API endpoint for client listing.
     */
    const ENDPOINT_CLIENT = 'clients';

    /**
     * Sets up our Plex server using the minimum amount of data required to
     * interact.
     *
     * @param string $name The name of the Plex server.
     * @param string $address The IP address of the Plex server.
     * @param integer $port The port on which the Plex server is listening.
     *
     * @uses MachineAbstract::$name
     * @uses MachineAbstract::$address
     * @uses MachineAbstract::$port
     * @uses Server::DEFAULT_PORT
     *
     * @return \Wubs\Plex\Server
     */
    public function __construct($name, $address, $port)
    {
        $this->name = $name;
        $this->address = $address;
        $this->port = $port ? $port : self::DEFAULT_PORT;
    }

    /**
     * Returns all the available clients to which the Plex server has access
     * indexed by the Plex client name.
     *
     * @uses MachineAbstract::getBaseUrl()
     * @uses MachineAbstract::makeCall()
     * @uses MachineAbstract::xmlAttributesToArray()
     * @uses Server::ENDPOINT_CLIENT
     * @uses Client::setHost()
     * @uses Client::setMachineIdentifier()
     * @uses Client::setVersion()
     * @uses Client::setServer()
     *
     * @return Client[] An array of Plex clients indexed by the Plex client
     * name.
     */
    public function getClients()
    {
        $url = sprintf(
            '%s/%s',
            $this->getBaseUrl(),
            self::ENDPOINT_CLIENT
        );

        $clients = array();
        $clientArray = $this->makeCall($url);

        foreach ($clientArray as $attribute) {
            $client = new Client(
                $attribute['name'],
                $attribute['address'],
                (int)$attribute['port']
            );
            $client->setHost($attribute['host']);
            $client->setMachineIdentifier($attribute['machineIdentifier']);
            $client->setVersion($attribute['version']);
            $client->setServer($this);
            $clients[$attribute['name']] = $client;
        }

        return $clients;
    }

    /**
     * Returns the Plex library belonging to the instantiated Plex server.
     *
     * @uses MachineAbstract::$name
     * @uses MachineAbstract::$address
     * @uses MachineAbstract::$port
     *
     * @return Library The Plex library belonging to the
     * instantiated Plex server.
     */
    public function getLibrary()
    {
        return new Library(
            $this->name,
            $this->address,
            $this->port
        );
    }

    /**
     * Returns the Plex server's name.
     *
     * @uses MachineAbstract::$name
     *
     * @return string The name of the Plex server.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the Plex server's IP address.
     *
     * @uses MachineAbstract::$address
     *
     * @return string The IP address of the Plex server.
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Returns the port on which the Plex server listens.
     *
     * @uses MachineAbstract::$port
     *
     * @return integer The port on which the Plex client server.
     */
    public function getPort()
    {
        return $this->port;
    }
}
