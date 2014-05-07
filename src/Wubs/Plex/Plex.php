<?php namespace Wubs\Plex;


use Wubs\Plex\Exception\Server as ServerException;


/**
 * Bootstrap class for using plex to interact with the Plex HTTP API.
 *
 * @category plex
 * @package Plex
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 */
class Plex
{
    /**
     * A list of Plex server machines on the network. This is defined by the
     * instantiating software.
     * @var Server[]
     */
    private static $servers = array();

    /**
     * A list of the Plex client machines on the network This is found upon
     * registring of Plex server. The first registered Plex server will go out
     * and get the list of available clients and register them accordingly.
     * @var Client[]
     */
    private static $clients = array();

    /**
     * Allows an instantiating software to define a list of Plex servers on the
     * network. In addition, the first server listed will be used to find the
     * list of available clients and will register them accordingly.
     *
     * @param array $servers An associative array of Plex server machines on the
     * network defined thusly:
     *
     * array (
     *     'server-1-name' => array(
     *         'address' => '192.168.1.5',
     *         'port' => 32400
     *     ),
     *     'server-2-name' => array(
     *         'address' => '192.168.1.10',
     *         'port' => 32400
     *     )
     * )
     *
     * @uses Plex::$servers
     * @uses Plex::registerClients()
     * @uses Plex::getServer()
     * @uses Server::getClient()
     *
     * @return void
     */
    public function registerServers(array $servers)
    {
        // Register each server.
        foreach ($servers as $name => $server) {
            $port = isset($server['port']) ? $server['port'] : null;
            self::$servers[$name] = new Server(
                $name,
                $server['address'],
                $port
            );
        }

        // We are going to use the first server in the list to get a list of the
        // available clients and register those automatically.
        $serverName = reset(array_keys(self::$servers));
        $this->registerClients(
            $this->getServer($serverName)->getClients()
        );
    }

    /**
     * Registers each found client with the bootstrap, so they can be found and
     * used by the instantiating software.
     *
     * @param Client[] $clients An associative array of Plex client machines on the
     * network.
     *
     * @uses Plex::$clients
     *
     * @return void
     */
    private function registerClients(array $clients)
    {
        self::$clients = $clients;
    }

    /**
     * Returns the requested server by the unique name under which it was registered.
     *
     * @param string $serverName The unique name of the requested server.
     *
     * @uses Plex::$servers
     *
     * @return Server The requested Plex server machine.
     *
     * @throws ServerException
     */
    public function getServer($serverName)
    {

        if (!isset(self::$servers[$serverName])) {
            throw new ServerException(
                'RESOURCE_NOT_FOUND',
                array($serverName)
            );
        }

        return self::$servers[$serverName];
    }

    /**
     * Returns the requested client by the unique name under which it was registered.
     *
     * @param string $clientName The unique name of the requested client.
     *
     * @uses Plex::$clients
     *
     * @return Client The requested Plex client machine.
     */
    public function getClient($clientName)
    {
        return self::$clients[$clientName];
    }
}
