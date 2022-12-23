<?php

class theme_mooin_core_renderer extends core_renderer
{
  public function full_header()
  {

    if (
      $this->page->include_region_main_settings_in_header_actions() &&
      !$this->page->blocks->is_block_present('settings')
    ) {
      // Only include the region main settings if the page has requested it and it doesn't already have
      // the settings block on it. The region main settings are included in the settings block and
      // duplicating the content causes behat failures.
      $this->page->add_header_action(html_writer::div(
        $this->region_main_settings_menu(),
        'd-print-none',
        ['id' => 'region-main-settings-menu']
      ));
    }

    $header = new stdClass();
    $header->settingsmenu = $this->context_header_settings_menu();
    $header->contextheader = $this->context_header();
    $header->hasnavbar = empty($this->page->layout_options['nonavbar']);
    $header->navbar = $this->navbar();
    $header->pageheadingbutton = $this->page_heading_button();
    $header->courseheader = $this->course_header();
    $header->headeractions = $this->page->get_header_actions();


    $coursecontext = context_course::instance($this->page->course->id);
    if (has_capability('moodle/course:update', $coursecontext)) {
      return $this->render_from_template('core/full_header', $header);
    }

    //return $this->render_from_template('core/full_header', $header);

  }
}
