<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * My Contacts block.
 *
 * @author Luke Carrier <luke@carrier.im>
 * @license GPL v3
 */

defined('MOODLE_INTERNAL') || die;

/**
 * My contacts block.
 */
class block_mycontacts extends block_base {
    /**
     * Moodle component name.
     *
     * @var string
     */
    const MOODLE_COMPONENT = 'block_mycontacts';

    /**
     * @override \block_base
     */
    public function init() {
        $this->title = get_string('pluginname', static::MOODLE_COMPONENT);
    }

    /**
     * @override \block_base
     */
    public function specialization() {}

    /**
     * @override \block_base
     */
    public function get_content() {
        $renderer = $this->page->get_renderer(static::MOODLE_COMPONENT);

        if ($this->content === null) {
            $this->content = (object) array(
                'text'   => $renderer->body($this),
                'footer' => $renderer->footer($this),
            );
        }

        return $this->content;
    }
}
