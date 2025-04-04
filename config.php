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
 * Theme Boost Union Child - Theme config
 *
 * @package    theme_mooin4
 * @copyright  2024 Alexander Bias <bias@alexanderbias.de>
 *             based on code by Lars Bonczek
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// mooin4 original

$THEME->sheets = [];                                                             
$THEME->editor_sheets = [];                                                              
$THEME->enable_dock = false;                                                                                                                                                                                                                           
$THEME->yuicssmodules = array();                                                                                                      
$THEME->requiredblocks = '';   
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->haseditswitch = true;
$THEME->activityheaderconfig = [
    'notitle' => true
];
$THEME->requiredblocks = '';

// Let codechecker ignore some sniffs for this file as we do not need a login check here..
// phpcs:disable moodle.Files.RequireLogin.Missing

// As a start, inherit the whole theme config from Boost Union.
// This move will save us from duplicating all lines from Boost Union's config.php into Boost Union Child's config.php.
// This statement uses require (and not require_once) by purpose to make sure that all Boost Union settings are added
// to the $THEME object even if the Boost Union config was already included in some other place.
require($CFG->dirroot . '/theme/boost_union/config.php');

// Then, we require Boost Union Child's locallib.php to make sure that it's always loaded.
require_once($CFG->dirroot . '/theme/mooin4/locallib.php');

// Next, we overwrite only the settings which differ between Boost Union and Boost Union Child.
$THEME->name = 'mooin4';
$THEME->scss = function($theme) {
    return theme_mooin4_get_main_scss_content($theme);
};
$THEME->parents = ['boost_union', 'boost'];
$THEME->extrascsscallback = 'theme_mooin4_get_extra_scss';
$THEME->prescsscallback = 'theme_mooin4_get_pre_scss';

// We need to duplicate the rendererfactory even if it is set to the same value as in Boost Union.
// The theme_config::get_renderer() method needs it to be directly in the theme_config object.
$THEME->rendererfactory = 'theme_overridden_renderer_factory';

// Lastly, we replicate some settings from Boost Union at runtime into Boost Union Child's settings.
// This becomes necessary if Moodle core code accesses a theme setting at $this->page->theme->settings->*.
// In this case, the setting must exist in the currently active theme, otherwise it won't be found.
// While Boost Union duplicates all settings from Boost Core and does not suffer from this issue,
// it would be quite ugly to duplicate all of these settings again to Boost Union Child.
// Currently, this affects these Boost Core settings:
// unaddableblocks - called from blocklib.php.
$unaddableblocks = get_config('theme_boost_union', 'unaddableblocks');
if (!empty($unaddableblocks)) {
    $THEME->settings->unaddableblocks = $unaddableblocks;
}
unset($unaddableblocks);
// SCSS - called in theme_boost_get_extra_scss.
$scss = get_config('theme_boost_union', 'scss');
if (!empty($scss)) {
    $THEME->settings->scss = $scss;
}
unset($scss);
// SCSSpre - called in theme_boost_get_pre_scss.
$scsspre = get_config('theme_boost_union', 'scsspre');
if (!empty($scsspre)) {
    $THEME->settings->scsspre = $scsspre;
}
unset($scsspre);

$THEME->javascripts = ['custom'];

//NEW
// integrate settings.php
if (is_siteadmin()) {
    require_once(__DIR__ . '/settings.php');
}

//integrate Custom-Palette
$THEME->scss = function($theme) {
    $palette = get_config('theme_mooin4', 'colorpalette');

    //initialize :root
    $customcss = ":root {";

    if ($palette === 'custom') {
       // Map theme variable to CSS variable name
        $colors = [
            'primary-color' => 'primarycolor',
            'primary-light' => 'primarylight',
            'secondary-color' => 'secondarycolor',
            'secondary-light' => 'secondarylight',
            'background-color' => 'backgroundcolor',
            'inner-progress' => 'innerprogress',
            'background-progress' => 'backgroundprogress',
            'signal-color' => 'signalcolor',
            'link-color' => 'linkcolor',
            'general-color' => 'generalcolor',
            'border-general' => 'bordergeneral',
            'important-color' => 'importantcolor',
            'border-important' => 'borderimportant',
            'task-color' => 'taskcolor',
            'border-task' => 'bordertask',
            'fact-color' => 'factcolor',
            'border-fact' => 'borderfact'
        ];

       // Retrieve and apply colors from the database
        foreach ($colors as $cssVar => $configKey) {
            $value = get_config('theme_mooin4', $configKey);
            if (!empty($value)) {
                $customcss .= " --$cssVar: $value !important;";
            }
        }

        // Handle transparency for primary-light color
        $opacity = get_config('theme_mooin4', 'primarylight_opacity');
        $primaryLight = get_config('theme_mooin4', 'primarylight');

        if (!empty($primaryLight) && !empty($opacity)) {
            // Convert opacity percentage (0–100) to HEX format (00–FF)
            $opacityHex = dechex(intval($opacity) * 255 / 100);
            $opacityHex = str_pad($opacityHex, 2, "0", STR_PAD_LEFT); // Immer 2 Zeichen lang

            // Validate if the primary light color is a correct 6-digit HEX code
            if (preg_match('/^#[a-fA-F0-9]{6}$/', $primaryLight)) {
                $storedValue = "{$primaryLight}{$opacityHex}"; // Generate 8-character HEX value
                set_config('primarylight', $storedValue, 'theme_mooin4'); 
                $customcss .= " --primary-light: {$storedValue} !important;";

                // Store only the 6-character HEX for the input field display
                set_config('primarylight_display', $primaryLight, 'theme_mooin4');
            } else {
                $customcss .= " --primary-light: {$primaryLight} !important;";
            }
        }
    }

    //close :root 
    $customcss .= " }";

    return theme_mooin4_get_main_scss_content($theme) . $customcss;
};

