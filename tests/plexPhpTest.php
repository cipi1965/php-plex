<?php
date_default_timezone_set("UTC");
use Wubs\PlexPhp\Plex;



class plexPhpTest extends \PHPUnit_Framework_TestCase{

	public function testCanFindServer(){
		$plex = new Plex();
		$servers = ['doctor' => ['address' => '192.168.1.201']];
		$plex->registerServers($servers);
		$server = $plex->getServer('doctor');
		$this->assertInstanceOf('Wubs\\PlexPhp\\Server', $server);
	}

	public function testCanLoadLibrary(){
		$plex = new Plex();
		$servers = ['doctor' => ['address' => '192.168.1.201']];
		$plex->registerServers($servers);
		$server = $plex->getServer('doctor');
		$library = $server->getLibrary();
		$this->assertInstanceOf('Wubs\\PlexPhp\\Server\\Library', $library);
	}

	public function testCanLoadSections(){
		$plex = new Plex();
		$servers = ['doctor' => ['address' => '192.168.1.201']];
		$plex->registerServers($servers);
		$server = $plex->getServer('doctor');
		$library = $server->getLibrary();
		$sections = $library->getSections();
		$this->assertInternalType('array', $sections);
	}

	public function testCanLoadFirstSection(){
		$plex = new Plex();
		$servers = ['doctor' => ['address' => '192.168.1.201']];
		$plex->registerServers($servers);
		$server = $plex->getServer('doctor');
		$library = $server->getLibrary();
		$sections = $library->getSections();
		$tvShows = $library->getSection($sections[0]);
		$this->assertInstanceOf('Wubs\\PlexPhp\\Server\\Library\\Section\\Show', $tvShows);
	}
}

//testCanFindServer();