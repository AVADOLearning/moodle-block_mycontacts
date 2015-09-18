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
 * My contacts block renderer.
 */
class block_mycontacts_renderer extends plugin_renderer_base {
    /**
     * Render a single contact.
     *
     * @param \stdClass $contact
     *
     * @return string
     */
	public function contact(stdClass $contact) {
		$url = new moodle_url('/user/profile.php', array('id' => $contact->id));
		$userpic = $this->output->user_picture($contact, array('size'=>'100', 'class'=>'profilepicture'));
		$description = format_text($contact->description, $contact->descriptionformat);

		return html_writer::start_tag('li', array('class' => 'contact'))
			 .     html_writer::start_tag('div', array('class' => 'contactpic'))
			 . 	   	   $userpic
			 .     html_writer::end_tag('div')
			 .     html_writer::start_tag('a', array('href' => $url))
			 .         fullname($contact)
			 .     html_writer::end_tag('a')
			 .     html_writer::start_tag('div', array('class' => 'contactdetails'))    
			 .		   $description
			 .     html_writer::end_tag('div')
			 . html_writer::end_tag('li');
	}

	/**
	 * Render the block's body content.
	 *
	 * @param \block_mycontacts $block
	 *
	 * @return string
	 */
	public function body(block_mycontacts $block) {
		$contacts  = $block->get_contacts();
		$innerhtml = '';

		foreach ($contacts as $contact) {
			$innerhtml .= $this->contact($contact);
		}

		return html_writer::start_tag('ul')
			 .     $innerhtml
			 . html_writer::end_tag('ul');
	}

	/**
	 * Render the block's footer content.
	 *
	 * @param \block_mycontacts $block
	 *
	 * @return string
	 */
	public function footer(block_mycontacts $block) {}
}
