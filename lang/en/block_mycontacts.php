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

// Moodle component metadata
$string['pluginname'] = 'My contacts';

// Capabilities
$string['mycontacts:addinstance']   = 'Add a new "my contacts" block';
$string['mycontacts:myaddinstance'] = 'Add a new "my contacts" block to My home';

// Instance configuration
$string['editform']       = 'My contacts block';
$string['editform_title'] = 'Title';
$string['editform_roles'] = 'Roles';
$string['config_roles_role'] = '{$a->name} ({$a->archetype})';
