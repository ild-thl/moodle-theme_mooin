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
 * Theme Boost Union Child - Language pack
 *
 * @package    theme_mooin4
 * @copyright  2023 Daniel Poggenpohl <daniel.poggenpohl@fernuni-hagen.de> and Alexander Bias <bias@alexanderbias.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Let codechecker ignore some sniffs for this file as it is perfectly well ordered, just not alphabetically.
// phpcs:disable moodle.Files.LangFilesOrdering.UnexpectedComment
// phpcs:disable moodle.Files.LangFilesOrdering.IncorrectOrder

// General.
$string['pluginname'] = 'Mooin 4.x ALS Boost Union Child';
$string['choosereadme'] = 'Theme mooin4 is a child theme of Boost Union.'; 
$string['configtitle'] = 'Mooin4 ALS Boost Union Child';
$string['settingsoverview_buc_desc'] = 'Mooin4 customizes Boost Union.';

// Settings: General settings tab.
// ... Section: Inheritance.
$string['inheritanceheading'] = 'Inheritance';
$string['inheritanceinherit'] = 'Inherit';
$string['inheritanceduplicate'] = 'Duplicate';
$string['inheritanceoptionsexplanation'] = 'Most of the time, inheriting will be perfectly fine. However, it may happen that imperfect code is integrated into Boost Union which prevents simple SCSS inheritance for particular Boost Union features. If you encounter any issues with Boost Union features which seem not to work in Boost Union Child as well, try to switch this setting to \'Dupliate\' and, if this solves the problem, report an issue on Github (see the README.md file for details how to report an issue).';
// ... ... Setting: Pre SCSS inheritance setting.
$string['prescssinheritancesetting'] = 'Pre SCSS inheritance';
$string['prescssinheritancesetting_desc'] = 'With this setting, you control if the pre SCSS code from Boost Union should be inherited or duplicated.';
// ... ... Setting: Extra SCSS inheritance setting.
$string['extrascssinheritancesetting'] = 'Extra SCSS inheritance';
$string['extrascssinheritancesetting_desc'] = 'With this setting, you control if the extra SCSS code from Boost Union should be inherited or duplicated.';

/**************************************************************
 * EXTENSION POINT:
 * Add your language strings for your settings here.
 *************************************************************/

// Privacy API.
$string['privacy:metadata'] = 'The Boost Union Child theme does not store any personal data about any user.';

// Strings für Farbpaletten 
$string['colorpalette'] = 'Color palette';
$string['colorpalette_desc'] = 'Choose the color palette for the theme.';
$string['classic_mooin'] = 'Classic mooin';
$string['palette_green'] = 'Green';
$string['palette_blue'] = 'Blue';
$string['palette_pastellblue'] = 'Pastell Blue';
$string['palette_custom'] = 'Custom (editable)';

//Strings für Colorpicker der Custom-Palette
$string['primarycolor'] = 'Primary Color';
$string['primarycolor_desc'] = 'Set the primary color of your theme';
$string['secondarycolor'] = 'Secondary Color';
$string['secondarycolor_desc'] = 'Set the secondary color of your theme';
$string['backgroundcolor'] = 'Background Color';
$string['backgroundcolor_desc'] = 'Set the background color of your theme';
$string['innerprogress'] = 'Inner Progressbar Color';
$string['innerprogress_desc'] = 'Set the inner progress color';
$string['backgroundprogress'] = 'Background Progressbar Color';
$string['backgroundprogress_desc'] = 'Set the background progress color';
$string['signalcolor'] = 'Signal Color';
$string['signalcolor_desc'] = 'Set the signal color';
$string['linkcolor'] = 'Link Color';
$string['linkcolor_desc'] = 'Set the link color';
$string['generalcolor'] = 'General-Box Color';
$string['generalcolor_desc'] = 'Set the general-box color';
$string['bordergeneral'] = 'Bordercolor General-Box';
$string['bordergeneral_desc'] = 'Set the general-box border color';
$string['importantcolor'] = 'Important-Box Color';
$string['importantcolor_desc'] = 'Set the important-box color';
$string['borderimportant'] = 'Bordercolor Important-Box';
$string['borderimportant_desc'] = 'Set the important-box border color';
$string['taskcolor'] = 'Task-Box Color';
$string['taskcolor_desc'] = 'Set the task-box color';
$string['bordertask'] = 'Bordercolor Task-Box';
$string['bordertask_desc'] = 'Set the task-box border color';
$string['factcolor'] = 'Fact-Box Color';
$string['factcolor_desc'] = 'Set the fact-box color';
$string['borderfact'] = 'Bordercolor Fact-Box';
$string['borderfact_desc'] = 'Set the fact-box border color';
$string['primarylight'] = 'Primary Light';
$string['primarylight_desc'] = 'Set a lighter version of the primary color through the transparency in the second input.';
$string['primarylight_opacity'] = 'Transparency Primary Light';
$string['primarylight_opacity_desc'] = 'Set the transparency of primary light (0-100%).';

$string['color_heading'] = 'mooin4 Color settings';
$string['settings_alert'] = 'To save color changes for custom colors and make them visible, click on “Save changes” at the bottom and then under 
                “Site administration > Development > Purge caches” to empty the cache.';

$string['custompalette_info'] = '
<div id="custom-palette-info" class="alert alert-info">
                <strong>Note:</strong> You can define your own colors here. To do this, select the desired values in the color pickers.
                <br><strong>Tip for accessibility:</strong> Check the colors used with accessibility tools such as 
                <a href="https://color.adobe.com/de/create/color-contrast-analyzer" target="_blank" 
                style="text-decoration: underline; color: var(--link-color); font-weight: bold;">
                Adobe Color</a>
                <br>
                - Minimum contrast for font ≤ 17pt: 4.5 to 1
                <br>
                - Minimum contrast for font ≥ 17pt and graphic components: 3 to 1
                <br><br>
               To save color changes and make them visible, click on “Save changes” below and then empty the cache 
               under “Site administration > Development > Purge caches”. 
            </div>';
