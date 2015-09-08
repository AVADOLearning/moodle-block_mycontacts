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

use block_mycontacts\contacts_util;

defined('MOODLE_INTERNAL') || die;

/**
 * My contacts block edit form.
 */
class block_mycontacts_edit_form extends block_edit_form {
    /**
     * @override \block_edit_form
     */
    protected function specific_definition($mform) {
        $mform->addElement(
                'header', 'config_header',
                get_string('editform', block_mycontacts::MOODLE_COMPONENT));

        $mform->addElement(
                'text', 'config_title',
                get_string('editform_title', block_mycontacts::MOODLE_COMPONENT));
        $mform->setType('config_title', PARAM_TEXT);

        $select = $mform->addElement(
                'select', 'config_roles',
                get_string('editform_roles', block_mycontacts::MOODLE_COMPONENT),
                contacts_util::get_roles_menu());
        $select->setMultiple(true);
    }
}
