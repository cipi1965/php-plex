<?php

namespace Wubs\Plex\Controller\Playback;

use Wubs\Plex\Client\Controller\ControllerAbstract;

/**
 * Plex Client Playback Controller
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
class Playback extends ControllerAbstract
{
    /**
     * Executes the play command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function play()
    {
        $this->executeCommand();
    }

    /**
     * Executes the pause command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function pause()
    {
        $this->executeCommand();
    }

    /**
     * Executes the stop command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function stop()
    {
        $this->executeCommand();
    }

    /**
     * Executes the rewind command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function rewind()
    {
        $this->executeCommand();
    }

    /**
     * Executes the fast forward command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function fastForward()
    {
        $this->executeCommand();
    }

    /**
     * Executes the step forward command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function stepForward()
    {
        $this->executeCommand();
    }

    /**
     * Executes the big step forward command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function bigStepForward()
    {
        $this->executeCommand();
    }

    /**
     * Executes the step back command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function stepBack()
    {
        $this->executeCommand();
    }

    /**
     * Executes the big step back command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function bigStepBack()
    {
        $this->executeCommand();
    }

    /**
     * Executes the skip next command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function skipNext()
    {
        $this->executeCommand();
    }

    /**
     * Executes the skip previous command.
     *
     * @uses ControllerAbstract::executeCommand()
     *
     * @return void
     */
    public function skipPrevious()
    {
        $this->executeCommand();
    }
}
