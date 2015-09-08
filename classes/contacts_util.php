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

namespace block_mycontacts;

use block_mycontacts;
use context_system;

defined('MOODLE_INTERNAL') || die;

/**
 * Contacts utility methods.
 */
class contacts_util {
    /**
     * SQL to obtain contacts in the user's enrolled courses.
     *
     * @var string
     */
    const ENROLLED_COURSES_CONTACTS_SQL = <<<SQL
SELECT DISTINCT contact.*
FROM {role_assignments} role_assignment
INNER JOIN {user} contact
    ON contact.id = role_assignment.userid
WHERE roleid %s
    AND role_assignment.contextid IN (
        SELECT context.id
        FROM {context} context
        INNER JOIN {course} course
            ON course.id = context.instanceid
        WHERE course.id %s
    )
SQL;

    /**
     * Obtain enrolled courses for the specified user.
     *
     * @param integer $userid
     *
     * @return integer[]
     */
    protected static function get_enrolled_course_ids($userid) {
        $courses = enrol_get_all_users_courses($userid, false);

        $courseids = array_reduce($courses, function($courseids, $course) {
            $courseids[] = $course->id;
            return $courseids;
        }, array());

        return $courseids;
    }

    /**
     * Get contacts for the specified user and set of roles.
     *
     * @param integer   $userid
     * @param integer[] $roleids
     */
    public static function get_contacts($userid, $roleids) {
        global $DB;

        $courseids = static::get_enrolled_course_ids($userid);

        if (!$courseids || !$roleids) {
            /* We have no courses/roles to match, so we have to bail and return
             * nothing. We're likely to add a new "sticky contacts" feature to
             * allow content creators to specify persistent contacts. */
            return array();
        }

        list($rolesql,   $roleparams)   = $DB->get_in_or_equal($roleids,   SQL_PARAMS_NAMED, 'role');
        list($coursesql, $courseparams) = $DB->get_in_or_equal($courseids, SQL_PARAMS_NAMED, 'course');

        $sql    = sprintf(static::ENROLLED_COURSES_CONTACTS_SQL, $rolesql, $coursesql);
        $params = array_merge($roleparams, $courseparams);

        return $DB->get_records_sql($sql, $params);
    }

    public static function get_roles_menu() {
        $roles = get_all_roles(context_system::instance());

        $rolesmenu = array_reduce($roles, function($rolesmenu, $role) {
            $rolesmenu[$role->id] = get_string('config_roles_role', block_mycontacts::MOODLE_COMPONENT, $role);
            return $rolesmenu;
        }, array());

        return $rolesmenu;
    }
}
