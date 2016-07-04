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
    protected $token;
	public function login($username, $password) { 
		$host = "https://plex.tv/users/sign_in.json"; 
		$header = array( 
			'Content-Type: application/xml; charset=utf-8', 
			'Content-Length: 0', 
			'X-Plex-Client-Identifier: 8334-8A72-4C28-FDAF-29AB-479E-4069-C3A3', 
			'X-Plex-Product: PhpPlexAPI', 'X-Plex-Version: v1_00', );
		$process = curl_init($host); 
		curl_setopt($process, CURLOPT_HTTPHEADER, $header); 
		curl_setopt($process, CURLOPT_HEADER, 0); 
		curl_setopt($process, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
		curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password); 
		curl_setopt($process, CURLOPT_TIMEOUT, 30); 
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($process, CURLOPT_POST, 1); 
		curl_setopt($process, CURLOPT_RETURNTRANSFER, true); 
		$data = curl_exec($process); 
		$curlError = curl_error($process); 
		$json = json_decode($data, true);
		$this->token= $json['user']['authentication_token'];
	}
    /**
     * A list of Plex server machines on the network. This is defined by the
     * instantiating software.
     * @var Server[]
     */
    public static $servers = array();

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
        self::$servers[$serverName]->setToken($this->token);

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
    
    public function addServersFromMyPlex()
    {
        if ($this->token !== null && $this->token !== "") {
            $host = "https://plex.tv/pms/servers.xml"; 
    		$header = array( 
    			'Content-Type: application/xml; charset=utf-8', 
    			'Content-Length: 0', 
    			'X-Plex-Client-Identifier: 8334-8A72-4C28-FDAF-29AB-479E-4069-C3A3', 
    			'X-Plex-Product: PhpPlexAPI', 'X-Plex-Version: v1_00',
    			'X-Plex-Token: '.$this->token );
    		$process = curl_init($host); 
    		curl_setopt($process, CURLOPT_HTTPHEADER, $header); 
    		curl_setopt($process, CURLOPT_HEADER, 0); 
    		curl_setopt($process, CURLOPT_TIMEOUT, 30); 
    		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0); 
    		curl_setopt($process, CURLOPT_RETURNTRANSFER, true); 
    		$data = curl_exec($process); 
    		$curlError = curl_error($process); 
    		$xml = simplexml_load_string($data);
    		$servers = [];
    		print_r($xml);
    		foreach ($xml as $server) {
				$servers[trim(strval($server->attributes()["name"]))] = [
					'address' => trim(strval($server->attributes()["address"])),
					'port' => trim(strval($server->attributes()["port"]))
				];
			}
        }
    }
}
