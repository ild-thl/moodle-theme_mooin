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
 * Theme Boost Union Child - Library
 *
 * @package    theme_mooin4
 * @copyright  2023 Daniel Poggenpohl <daniel.poggenpohl@fernuni-hagen.de> and Alexander Bias <bias@alexanderbias.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Constants which are use throughout this theme.
define('THEME_MOOIN4_SETTING_INHERITANCE_INHERIT', 0);
define('THEME_MOOIN4_SETTING_INHERITANCE_DUPLICATE', 1);

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_mooin4_get_main_scss_content($theme) {
    global $CFG;

    // Require the necessary libraries.
    require_once($CFG->dirroot . '/theme/boost_union/lib.php');

    // As a start, get the compiled main SCSS from Boost Union.
    // This way, Boost Union Child will ship the same SCSS code as Boost Union itself.
    $scss = theme_boost_union_get_main_scss_content(\core\output\theme_config::load('boost_union'));
    // And add Boost Union Child's main SCSS file to the stack.
    $scss .= file_get_contents($CFG->dirroot . '/theme/mooin4/scss/post.scss');

    return $scss;
}

/**
 * Get SCSS to prepend.
 *
 * @param \core\output\theme_config $theme The theme config object.
 * @return string
 */
function theme_mooin4_get_pre_scss($theme) {
    global $CFG;

    // Require the necessary libraries.
    require_once($CFG->dirroot . '/theme/boost_union/lib.php');

    // As a start, initialize the Pre SCSS code with an empty string.
    $scss = '';

    // Then, if configured, get the compiled pre SCSS code from Boost Union.
    // This should not be necessary as Moodle core calls the *_get_pre_scss() functions from all parent themes as well.
    // However, as soon as Boost Union would use $theme->settings in this function, $theme would be this theme here and
    // not Boost Union. The Boost Union developers are aware of this topic, but faults can always happen.
    // If such a fault happens, the Boost Union Child administrator can switch the inheritance to 'Duplicate'.
    // This way, we will add the pre SCSS code with the explicit use of the Boost Union configuration to the stack.
    $inheritanceconfig = get_config('theme_mooin4', 'prescssinheritance');
    if ($inheritanceconfig == THEME_MOOIN4_SETTING_INHERITANCE_DUPLICATE) {
        $scss .= theme_boost_union_get_pre_scss(\core\output\theme_config::load('boost_union'));
    }

    // And add Boost Union Child's pre SCSS file to the stack.
    $scss .= file_get_contents($CFG->dirroot . '/theme/mooin4/scss/pre.scss');

    /**********************************************************
     * EXTENSION POINT:
     * Compose and add additional pre-SCSS code here.
     * It will be added on top of Boost Union's pre-SCSS code.
     *********************************************************/

    return $scss;
}

/**
 * Inject additional SCSS.
 *
 * @param \core\output\theme_config $theme The theme config object.
 * @return string
 */
function theme_mooin4_get_extra_scss($theme) {
    global $CFG;

    // Require the necessary libraries.
    require_once($CFG->dirroot . '/theme/boost_union/lib.php');

    // As a start, initialize the Extra SCSS code with an empty string.
    $scss = '';

    // Then, if configured, get the compiled extra SCSS code from Boost Union.
    // This should not be necessary as Moodle core calls the *_get_extra_scss() functions from all parent themes as well.
    // However, as soon as Boost Union would use $theme->settings in this function, $theme would be this theme here and
    // not Boost Union. The Boost Union developers are aware of this topic, but faults can always happen.
    // If such a fault happens, the Boost Union Child administrator can switch the inheritance to 'Duplicate'.
    // This way, we will add the extra SCSS code with the explicit use of the Boost Union configuration to the stack.
    $inheritanceconfig = get_config('theme_mooin4', 'extrascssinheritance');
    if ($inheritanceconfig == THEME_MOOIN4_SETTING_INHERITANCE_DUPLICATE) {
        $scss .= theme_boost_union_get_extra_scss(\core\output\theme_config::load('boost_union'));
    }

    /**********************************************************
     * EXTENSION POINT:
     * Compose and add additional SCSS code here.
     * It will be added on top of Boost Union's SCSS code.
     *********************************************************/

    return $scss;
}

/**
 * Callback function for theme_boost_union to allow Boost Union Child to add cards to the Boost Union settings overview page.
 * This function is expected to return an array of arrays containing values with the keys 'label', 'desc', 'btn' and 'url'.
 *
 * @return array
 */
function theme_mooin4_extend_busettingsoverview() {

    $cards[] = [
        'label' => get_string('pluginname', 'theme_mooin4'),
        'desc' => get_string('settingsoverview_buc_desc', 'theme_mooin4'),
        'btn' => 'primary',
        'url' => new \core\url('/admin/settings.php', ['section' => 'theme_mooin4']),
    ];

    return $cards;
}

/**
 * Callback function which allows themes to alter the CSS URLs.
 * We use this function to change the CSS URL to the flavour CSS URL if a flavour applies to the current page.
 *
 * @copyright 2024 Alexander Bias <bias@alexanderbias.de>
 *
 * @param mixed $urls The CSS URLs (passed as reference).
 */
function theme_mooin4_alter_css_urls(&$urls) {
    global $CFG;

    // Require Boost Union library.
    require_once($CFG->dirroot.'/theme/boost_union/lib.php');

    // Call Boost Union's theme_boost_union_alter_css_urls() function which implements the logic to change the CSS URL for flavours.
    theme_boost_union_alter_css_urls($urls);
}

/**
 * Page init callback to inject custom colors as inline CSS.
 * This avoids SCSS caching issues - inline CSS is not cached and regenerated on every page load.
 *
 * @param moodle_page $page The page object.
 */
function theme_mooin4_page_init(moodle_page $page) {
    $palette = get_config('theme_mooin4', 'colorpalette');
    // Add body class for the selected palette.
    if ($palette) {
        $page->add_body_class($palette);
    }
    // If custom palette is selected, inject inline CSS with custom colors.
    if ($palette === 'custom') {
        // Map theme variable to CSS variable name.
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
            'border-fact' => 'borderfact',
        ];
        // Build inline CSS.
        $customcss = "<style id='theme-mooin4-custom-colors'>\n:root {";
        // Retrieve and apply colors from the database.
        foreach ($colors as $cssvar => $configkey) {
            $value = get_config('theme_mooin4', $configkey);
            if (!empty($value)) {
                $customcss .= "\n  --$cssvar: $value !important;";
            }
        }
        // Handle transparency for primary-light color.
        $opacity = get_config('theme_mooin4', 'primarylight_opacity');
        $primarylight = get_config('theme_mooin4', 'primarylight');
        if (!empty($primarylight) && !empty($opacity)) {
            // Convert opacity percentage (0–100) to HEX format (00–FF).
            $opacityhex = dechex(intval($opacity) * 255 / 100);
            $opacityhex = str_pad($opacityhex, 2, "0", STR_PAD_LEFT);
            // Validate if the primary light color is a correct 6-digit HEX code.
            if (preg_match('/^#[a-fA-F0-9]{6}$/', $primarylight)) {
                $storedvalue = "{$primarylight}{$opacityhex}";
                set_config('primarylight', $storedvalue, 'theme_mooin4');
                $customcss .= "\n  --primary-light: {$storedvalue} !important;";
                // Store only the 6-character HEX for the input field display.
                set_config('primarylight_display', $primarylight, 'theme_mooin4');
            } else {
                $customcss .= "\n  --primary-light: {$primarylight} !important;";
            }
        }
        $customcss .= "\n}\n</style>";
        // Add inline CSS to the page head via $CFG->additionalhtmlhead.
        // This is the standard Moodle way to add custom HTML to the head section.
        global $CFG;
        if (!isset($CFG->additionalhtmlhead)) {
            $CFG->additionalhtmlhead = '';
        }
        // Only add if not already added (check for our style tag ID).
        if (strpos($CFG->additionalhtmlhead, 'theme-mooin4-custom-colors') === false) {
            $CFG->additionalhtmlhead .= "\n" . $customcss;
        }
    }
}
