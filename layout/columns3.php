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
 * A two column layout for the boost theme.
 *
 * @package   theme_boost
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');
require_once($CFG->dirroot.'/course/format/mooin/locallib.php');


if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $navdraweropen = false;
}
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions();
// If the settings menu will be included in the header then don't add it here.
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'navdraweropen' => $navdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu)
];
//incourse

$nav = $PAGE->flatnav;
$adminnode = $nav -> get('sitesettings');
$mycourses = $nav -> get('mycourses');
$coursehome = $nav -> get('coursehome');
$mooin_newsforum = $nav -> get('format_mooin_newsforum');
$mooin_badges = $nav -> get('format_mooin_badges');
$mooin_certificates = $nav -> get('format_mooin_certificates');
$mooin_discussion = $nav -> get('format_mooin_discussions');
$participantsnode = $nav -> get('participants');
$calendar = $nav -> get('calendar');
$privatefiles = $nav -> get('privatefiles');
$contentbank = $nav -> get('contentbank');
$coursenodes = $nav -> type(30);
$home = $nav -> get('home');
$home ->set_showdivider(false);
$myhome = $nav -> get('myhome');



foreach ($nav as $node) {
    $nav -> remove($node->key);
}

if($home) {
    $home ->set_showdivider(false);
    $nav->add($home);
}

if($myhome) {
    $myhome ->set_showdivider(false);
    $nav->add($myhome);
}
//$nav->add($myhome);

if($mycourses) {
    $nav->add($mycourses);
}
//$nav->add($mycourses);
if($coursehome) {
    $coursehome->set_showdivider(true);
    //$coursehome->make_active();
    $nav->add($coursehome);
}
if($mooin_newsforum) {
    //$mooin_newsforum -> make_active();
    $nav->add($mooin_newsforum);
}
//$nav->add($mooin_newsforum);

if($mooin_badges) {
    $nav->add($mooin_badges);
}

if($mooin_certificates) {
    $nav->add($mooin_certificates);
}
//$nav->add($mooin_certificates);
if($mooin_discussion) {
    $nav->add($mooin_discussion);
}
//$nav->add($mooin_discussion);
//$nav->add($participantsnode);
if($participantsnode) {
    $nav->add($participantsnode);
}
foreach($coursenodes as $node) {

    if(is_last_section_of_chapter($node->key)) {
        $node -> set_showdivider(true);
    }
    $nav->add($node);
    //$nav -> add($node);
}
if($adminnode) {
    $nav->add($adminnode);
}

//Remove the Activity Nodes
$nodes = $nav -> type(40);
foreach($nodes as $node) {
    $nav -> remove($node -> key);
}
//$nav->remove('calendar');
$templatecontext['flatnavigation'] = $nav;
$templatecontext['firstcollectionlabel'] = $nav->get_collectionlabel();


    $coursecontext = context_course::instance($this->page->course->id);
    if (has_capability('moodle/course:update', $coursecontext)) {
        $templatecontext['showfullheader'] = true;
    }

//Evtl ins Kursformat verschieben
//$PAGE->requires->js_call_amd('theme_mooin/test', 'init');
echo $OUTPUT->render_from_template('theme_mooin/columns3', $templatecontext);

