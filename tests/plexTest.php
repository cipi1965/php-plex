<?php
date_default_timezone_set("UTC");

use Plex\Plex;
use Plex\Server;
use Plex\Server\Library;


class plexPhpTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var Plex;
     */
    private $plex = null;

    /**
     * @var Server
     */
    private $server = null;

    /**
     * @var Library;
     */
    private $library = null;

	public function setUp(){
		$this->plex = new Plex();
		$servers = ['doctor' => ['address' => '192.168.1.201']];
		$this->plex->registerServers($servers);
		$this->server = $this->plex->getServer('doctor');
		$this->library = $this->server->getLibrary();
	}

	public function tearDown(){
		$this->plex = null;
		$this->server = null;
	}

	public function testCanFindServer(){
		$server = $this->plex->getServer('doctor');
		$this->assertInstanceOf('Wubs\\Plex\\Server', $server);
	}

	public function testCanLoadLibrary(){
		$library = $this->server->getLibrary();
		$this->assertInstanceOf('Wubs\\Plex\\Server\\Library', $library);
	}

	public function testCanLoadSections(){
		$sections = $this->library->getSections();
		$this->assertInternalType('array', $sections);
	}

	public function testCanLoadTVShowSection(){
		$tvShows = $this->library->getSection('TV Shows');
		$this->assertInstanceOf('Wubs\\Plex\\Server\\Library\\Section\\Show', $tvShows);
	}

	public function testCanLoadMusicSection(){
		$music = $this->library->getSection("Music");
		$this->assertInstanceOf('Wubs\\Plex\\Server\\Library\\Section\\Artist', $music);
	}

	public function testCanLoadMoviesSection(){
		$movies = $this->library->getSection("Movies");
		$this->assertInstanceOf('Wubs\\Plex\\Server\\Library\\Section\\Movie', $movies);
	}

	public function testCanLoadPhotosSection(){
		$photos = $this->library->getSection("Photos");
		$this->assertInstanceOf('Wubs\\Plex\\Server\\Library\\Section\\Photo', $photos);
	}

	public function testCanLoadAlbum(){
		$artists = $this->library->getSection("Music")->getAllArtists();
        $firstArtist = $artists[0];
        $this->assertInstanceOf('Wubs\\Plex\\Server\\Library\\Item\\Artist', $firstArtist);


	}

}