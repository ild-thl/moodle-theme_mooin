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

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

$THEME->layouts = [
      // Main course page.
      'course' => array(
        'file' => 'columns2.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true)
    ),
    // Part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
];

$THEME->name = 'mooin';
$THEME->sheets = ['bootstrap-icons'];
$THEME->editor_sheets = [];
$THEME->parents = ['boost'];
$THEME->enable_dock = false;
$THEME->yuicssmodules = array();
$THEME->requiredblocks = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->hidefromselector = false;
$THEME->scss = function ($theme) {
    return theme_mooin_get_main_scss_content($theme);
};
// Override Renderer.
$THEME->rendererfactory = 'theme_overridden_renderer_factory';


$THEME->rarrow ='&#xF231';
$THEME->larrow ='&#xF22D';
$THEME->uarrow ='&#xF235';
$THEME->darrow ='&#xF229';





//delete later
$CFG->cachejs = false;
