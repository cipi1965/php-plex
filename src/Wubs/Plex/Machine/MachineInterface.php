<?php

namespace Wubs\Plex\Machine;

    /**
     * Plex Machine
     *
     * @category plex
     * @package Plex_Machine
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
 * Interface that defines the structure of Plex machines.
 *
 * @category plex
 * @package Plex_Machine
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
interface MachineInterface
{
    /**
     * Returns the name of the Plex machine.
     *
     * @return string The name of the Plex machine.
     */
    public function getName();

    /**
     * Returns the IP address of the Plex machine.
     *
     * @return string The IP address of the Plex machine.
     */
    public function getAddress();

    /**
     * Returns the port on which the Plex machine listens.
     *
     * @return integer The port on which the Plex machine listens.
     */
    public function getPort();
}
