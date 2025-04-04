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
 * Theme Boost Union Child - Settings file
 *
 * @package    theme_mooin4
 * @copyright  2023 Daniel Poggenpohl <daniel.poggenpohl@fernuni-hagen.de> and Alexander Bias <bias@alexanderbias.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig || has_capability('theme/boost_union:configure', context_system::instance())) {

        // How this file works:
        // Boost Union's settings are divided into multiple settings pages which resides in its own settings category.
        // You will understand it as soon as you look at /theme/boost_union/settings.php.
        // This settings file here is built in a way that it adds another settings page to this existing settings
        // category. You can add all child-theme-specific settings to this settings page here.

        // However, there is still the $settings variable which is expected by Moodle core to be filled with the theme
        // settings and which is automatically linked from the theme selector page.
        // To avoid that there appears a broken "Boost Union Child" settings page, we redirect the user to a settings
        // overview page if he opens this page.
        $mainsettingspageurl = new moodle_url('/admin/settings.php', ['section' => 'themesettingmooin4']);
        if ($ADMIN->fulltree && $PAGE->has_set_url() && $PAGE->url->compare($mainsettingspageurl)) {
                redirect(new moodle_url('/admin/settings.php', ['section' => 'theme_mooin4']));
        }

        // Create empty settings page structure to make the site administration work on non-admin pages.
        if (!$ADMIN->fulltree) {
                // Create Boost Union Child settings page
                // (and allow users with the theme/boost_union:configure capability to access it).
                $tab = new admin_settingpage(
                        'theme_mooin4',
                        get_string('configtitle', 'theme_mooin4', null, true),
                        'theme/boost_union:configure'
                );
                $ADMIN->add('theme_boost_union', $tab);
        }

        // Create full settings page structure.
        // phpcs:disable moodle.ControlStructures.ControlSignature.Found
        else if ($ADMIN->fulltree) {

                // Require the necessary libraries.
                require_once($CFG->dirroot . '/theme/boost_union/lib.php');
                require_once($CFG->dirroot . '/theme/boost_union/locallib.php');
                require_once($CFG->dirroot . '/theme/mooin4/lib.php');
                require_once($CFG->dirroot . '/theme/mooin4/locallib.php');

                // Prepare options array for select settings.
                // Due to MDL-58376, we will use binary select settings instead of checkbox settings throughout this theme.
                $yesnooption = [
                        THEME_BOOST_UNION_SETTING_SELECT_YES => get_string('yes'),
                        THEME_BOOST_UNION_SETTING_SELECT_NO => get_string('no'),
                ];


                // Create Boost Union Child settings page with tabs
                // (and allow users with the theme/boost_union:configure capability to access it).
                $page = new theme_boost_admin_settingspage_tabs(
                        'theme_mooin4',
                        get_string('configtitle', 'theme_mooin4', null, true),
                        'theme/boost_union:configure'
                );


                // Create general settings tab.
                $tab = new admin_settingpage(
                        'theme_mooin4_general',
                        get_string('generalsettings', 'theme_boost', null, true)
                );

                // Create inheritance heading.
                $name = 'theme_mooin4/inheritanceheading';
                $title = get_string('inheritanceheading', 'theme_mooin4', null, true);
                $setting = new admin_setting_heading($name, $title, null);
                $tab->add($setting);

                // Prepare inheritance options.
                $inheritanceoptions = [
                        THEME_MOOIN4_SETTING_INHERITANCE_INHERIT =>
                        get_string('inheritanceinherit', 'theme_mooin4'),
                        THEME_MOOIN4_SETTING_INHERITANCE_DUPLICATE =>
                        get_string('inheritanceduplicate', 'theme_mooin4'),
                ];

                // Setting: Pre SCSS inheritance setting.
                $name = 'theme_mooin4/prescssinheritance';
                $title = get_string('prescssinheritancesetting', 'theme_mooin4', null, true);
                $description = get_string('prescssinheritancesetting_desc', 'theme_mooin4', null, true) . '<br />' .
                        get_string('inheritanceoptionsexplanation', 'theme_mooin4', null, true);
                $setting = new admin_setting_configselect(
                        $name,
                        $title,
                        $description,
                        THEME_MOOIN4_SETTING_INHERITANCE_INHERIT,
                        $inheritanceoptions
                );
                $setting->set_updatedcallback('theme_reset_all_caches');
                $tab->add($setting);

                // Setting: Extra SCSS inheritance setting.
                $name = 'theme_mooin4/extrascssinheritance';
                $title = get_string('extrascssinheritancesetting', 'theme_mooin4', null, true);
                $description = get_string('extrascssinheritancesetting_desc', 'theme_mooin4', null, true) . '<br />' .
                        get_string('inheritanceoptionsexplanation', 'theme_mooin4', null, true);
                $setting = new admin_setting_configselect(
                        $name,
                        $title,
                        $description,
                        THEME_MOOIN4_SETTING_INHERITANCE_INHERIT,
                        $inheritanceoptions
                );
                $setting->set_updatedcallback('theme_reset_all_caches');
                $tab->add($setting);

                // Add tab to settings page.
                $page->add($tab);

                /**********************************************************
                 * EXTENSION POINT:
                 * Add your Boost Union Child settings here.
                 *********************************************************/

                // Add settings page to the admin settings category.
                $ADMIN->add('theme_boost_union', $page);
        }
}

if ($ADMIN->fulltree) {
        $temp = new admin_settingpage('themesettingmooin4', get_string('configtitle', 'theme_mooin4'));

        //Dropdown for Color Palettes
        $name = 'theme_mooin4/colorpalette';
        $title = get_string('colorpalette', 'theme_mooin4');
        $description = get_string('colorpalette_desc', 'theme_mooin4');
        $default = 'palette-green';
        $choices = [
                'palette-green' => get_string('palette_green', 'theme_mooin4'),
                'palette-blue' => get_string('palette_blue', 'theme_mooin4'),
                'palette-pastellblue' => get_string('palette_pastellblue', 'theme_mooin4'),
                'custom' => get_string('palette_custom', 'theme_mooin4')
        ];
        $temp->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

        // Infobox
        $temp->add(new admin_setting_heading(
                'custompalette_info',
                '',
                '<div id="custom-palette-info" class="alert alert-info">
                <strong>Hinweis:</strong> Du kannst hier eigene Farben definieren. Wähle dazu die gewünschten Werte in den Farbpickern aus.
                <br><strong>Tipp für Barrierefreiheit:</strong> Prüfe die eingesetzten Farben mit Barrierefreiheits-Tools wie 
                <a href="https://color.adobe.com/de/create/color-contrast-analyzer" target="_blank" 
                style="text-decoration: underline; color: var(--link-color); font-weight: bold;">
                Adobe Color</a>
                <br>
                - Mindest Kontrast für Schrift ≤ 17pt: 4,5 zu 1
                <br>
                - Mindest Kontrast für Schrift ≥ 17pt und Grafikkomponenten: 3 zu 1
                <br><br>
                Um Farbänderungen zu speichern und sichtbar zu machen, unten auf "Save changes" klicken und dann unter 
                "Site administration > Development > Purge caches" den Cache leeren.
            </div>'
        ));


        $temp->add(new admin_setting_configcolourpicker(
                "theme_mooin4/primarycolor",
                get_string('primarycolor', 'theme_mooin4'),
                get_string("primarycolor_desc", 'theme_mooin4'),
                '#488709'
        ));

        $temp->add(new admin_setting_configcolourpicker(
                "theme_mooin4/primarylight",
                get_string('primarylight', 'theme_mooin4'),
                get_string("primarylight_desc", 'theme_mooin4'),
                get_config('theme_mooin4', 'primarylight_display') // Only stores the 6-digit HEX
        ));


        $temp->add(new admin_setting_configtext(
                "theme_mooin4/primarylight_opacity",
                get_string('primarylight_opacity', 'theme_mooin4'),
                get_string("primarylight_opacity_desc", 'theme_mooin4'),
                '50',
                PARAM_INT
        ));


        $colors = [
                'secondarycolor' => '#FF5733',
                'backgroundcolor' => '#F0F0F0',
                'innerprogress' => '#00FF00',
                'backgroundprogress' => '#CCCCCC',
                'signalcolor' => '#FF0000',
                'linkcolor' => '#0000FF',
                'generalcolor' => '#808080',
                'bordergeneral' => '#999999',
                'importantcolor' => '#FFD700',
                'borderimportant' => '#FFA500',
                'taskcolor' => '#00CED1',
                'bordertask' => '#008B8B',
                'factcolor' => '#8A2BE2',
                'borderfact' => '#4B0082'
        ];

        // Loop through each color setting and create a color picker input for the admin
        foreach ($colors as $name => $default) {
                $temp->add(new admin_setting_configcolourpicker(
                        "theme_mooin4/{$name}",
                        get_string($name, 'theme_mooin4'),
                        get_string("{$name}_desc", 'theme_mooin4'),
                        $default
                ));
        }

        $ADMIN->add('themes', $temp);
}
