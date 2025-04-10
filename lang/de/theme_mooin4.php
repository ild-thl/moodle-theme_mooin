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
$string['choosereadme'] = 'Theme mooin4 ist ein child theme von Boost Union.'; 
$string['configtitle'] = 'Mooin4 ALS Boost Union Child';
$string['settingsoverview_buc_desc'] = 'Mooin4 passt Boost Union individuell an.';

// Settings: General settings tab.
// ... Section: Inheritance.
$string['inheritanceheading'] = 'Vererbung';
$string['inheritanceinherit'] = 'Erben';
$string['inheritanceduplicate'] = 'Duplizieren';
$string['inheritanceoptionsexplanation'] = 'In den meisten Fällen ist die Vererbung völlig in Ordnung. Es kann jedoch vorkommen, dass unvollkommener Code in Boost Union integriert ist, der die einfache SCSS-Vererbung für bestimmte Boost Union-Funktionen verhindert. Wenn Sie auf Probleme mit Boost Union-Funktionen stoßen, die auch in Boost Union Child nicht zu funktionieren scheinen, versuchen Sie, diese Einstellung auf \'Dupliate\' umzuschalten, und wenn dies das Problem löst, melden Sie ein Problem auf Github (siehe die Datei README.md für Einzelheiten zum Melden eines Problems).';
// ... ... Setting: Pre SCSS inheritance setting.
$string['prescssinheritancesetting'] = 'Pre SCSS inheritance';
$string['prescssinheritancesetting_desc'] = 'Mit dieser Einstellung steuern Sie, ob der vorbereitete SCSS-Code von Boost Union geerbt oder dupliziert werden soll.';
// ... ... Setting: Extra SCSS inheritance setting.
$string['extrascssinheritancesetting'] = 'Extra SCSS inheritance';
$string['extrascssinheritancesetting_desc'] = 'Mit dieser Einstellung steuern Sie, ob der zusätzliche SCSS-Code von Boost Union geerbt oder dupliziert werden soll.';

/**************************************************************
 * EXTENSION POINT:
 * Add your language strings for your settings here.
 *************************************************************/

// Privacy API.
$string['privacy:metadata'] = 'Das Boost Union Child-Theme speichert keine persönlichen Daten der Nutzer.';

// Strings für Farbpaletten 
$string['colorpalette'] = 'Farbpalette';
$string['colorpalette_desc'] = 'Wählen Sie die Farbpalette für das Theme.';
$string['classic_mooin'] = 'Classic mooin';
$string['palette_green'] = 'Green';
$string['palette_blue'] = 'Blue';
$string['palette_pastellblue'] = 'Pastell Blue';
$string['palette_custom'] = 'Custom (bearbeitbar)';

//Strings für Colorpicker der Custom-Palette
$string['primarycolor'] = 'Primärfarbe';
$string['primarycolor_desc'] = 'Legen Sie die Grundfarbe des Themes fest';
$string['secondarycolor'] = 'Sekundärfarbe';
$string['secondarycolor_desc'] = 'Legen Sie die Sekundärfarbe des Themes fest';
$string['backgroundcolor'] = 'Hintergrundfarbe';
$string['backgroundcolor_desc'] = 'Legen Sie die Hintergrundfarbe des Themes fest';
$string['innerprogress_desc'] = 'Legen Sie die Farbe der inneren Fortschrittsleiste fest';
$string['innerprogress'] = 'Farbe der inneren Fortschrittsleiste';
$string['backgroundprogress'] = 'Hintergrundfarbe der Fortschrittsleiste';
$string['backgroundprogress_desc'] = 'Legen Sie die Hintergrundfarbe der Fortschrittsleiste fest';
$string['signalcolor'] = 'Signalfarbe';
$string['signalcolor_desc'] = 'Legen Sie die Signalfarbe fest';
$string['linkcolor'] = 'Link Farbe';
$string['linkcolor_desc'] = 'Legen Sie die Link Farbe fest';
$string['generalcolor'] = 'General-Box Farbe';
$string['generalcolor_desc'] = 'Legen Sie die General-Box Farbe fest';
$string['bordergeneral'] = 'Umrandungsfarbe General-Box';
$string['bordergeneral_desc'] = 'Legen Sie die Umrandungsfarbe General-Box fest';
$string['importantcolor'] = 'Important-Box Farbe';
$string['importantcolor_desc'] = 'Legen Sie die Important-Box Farbe fest';
$string['borderimportant'] = 'Umrandungsfarbe Important-Box';
$string['borderimportant_desc'] = 'Legen Sie die Umrandungsfarbe Important-Box fest';
$string['taskcolor'] = 'Task-Box Farbe';
$string['taskcolor_desc'] = 'Legen Sie die Task-Box Farbe fest';
$string['bordertask'] = 'Umrandungsfarbe Task-Box';
$string['bordertask_desc'] = 'Legen Sie die Umrandungsfarbe Task-Box fest';
$string['factcolor'] = 'Fact-Box Farbe';
$string['factcolor_desc'] = 'Legen Sie die Fact-Box Farbe fest';
$string['borderfact'] = 'Umrandungsfarbe Fact-Box';
$string['borderfact_desc'] = 'Legen Sie die Umrandungsfarbe Fact-Box fest';
$string['primarylight'] = 'Primärfarbe Light';
$string['primarylight_desc'] = 'Setzen Sie eine hellere Version der Primärfarbe durch die Transparenz in der zweiten Eingabe.';
$string['primarylight_opacity'] = 'Transparenz Primärfarbe Light';
$string['primarylight_opacity_desc'] = 'Legen Sie die Transparenz der Primärfarbe Light fest (0-100%).';

$string['color_heading'] = 'mooin4 Farbeinstellungen';
$string['settings_alert'] = 'Um Farbänderungen zu speichern und sichtbar zu machen, unten auf "Speichern" klicken und dann unter 
                "Site administration > Development > Purge caches" den Cache leeren.';

$string['custompalette_info'] = '
<div id="custom-palette-info" class="alert alert-info">
                <strong>Hinweis:</strong> Sie können hier eigene Farben definieren. Wählen Sie dazu die gewünschten Werte in den Farbpickern aus.
                <br><strong>Tipp für Barrierefreiheit:</strong> Prüfen Sie die eingesetzten Farben mit Barrierefreiheits-Tools wie 
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
            </div>';
