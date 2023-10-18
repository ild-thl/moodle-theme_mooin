<?php

class theme_mooin4_core_renderer extends core_renderer
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


    // $coursecontext = context_course::instance($this->page->course->id);
    // if (has_capability('moodle/course:update', $coursecontext)) {
    //   return $this->render_from_template('core/full_header', $header);
    // }

    return $this->render_from_template('core/full_header', $header);

  }

   /**
     * This renders the navbar.
     * Uses bootstrap compatible html.
     */
    public function navbar() {
      global $PAGE, $OUTPUT, $COURSE;
     $items = $PAGE->navbar->get_items();
     $short_items = [];

    //Split the navbar array at coursehome
     foreach($items as $item) {
        if ($item->key === $COURSE->id) {
            $short_items = array_splice($items, intval(array_search($item, $items)));
        }
     }
     $templatecontext = array(
      'get_items'=> $short_items
  );
      return $this->render_from_template('core/navbar', $templatecontext);
  }

  /**
     * Renders the "breadcrumb" for all pages in boost.
     *
     * @return string the HTML for the navbar.
     */
    public function coreNavbar(): string {
      $newnav = new \theme_mooin4\boostnavbar($this->page);
      return $this->render_from_template('core/navbar', $newnav);
  }

  /**
     * Renders the context header for the page.
     *
     * @param array $headerinfo Heading information.
     * @param int $headinglevel What 'h' level to make the heading.
     * @return string A rendered context header.
     */
    public function context_header($headerinfo = null, $headinglevel = 1): string {
      global $DB, $USER, $CFG, $SITE;
      require_once($CFG->dirroot . '/user/lib.php');
      $context = $this->page->context;
      $heading = null;
      $imagedata = null;
      $subheader = null;
      $userbuttons = null;

      // Make sure to use the heading if it has been set.
      if (isset($headerinfo['heading'])) {
          $heading = $headerinfo['heading'];
      } else {
          $heading = $this->page->heading;
      }

      // The user context currently has images and buttons. Other contexts may follow.
      if ((isset($headerinfo['user']) || $context->contextlevel == CONTEXT_USER) && $this->page->pagetype !== 'my-index') {
          if (isset($headerinfo['user'])) {
              $user = $headerinfo['user'];
          } else {
              // Look up the user information if it is not supplied.
              $user = $DB->get_record('user', array('id' => $context->instanceid));
          }

          // If the user context is set, then use that for capability checks.
          if (isset($headerinfo['usercontext'])) {
              $context = $headerinfo['usercontext'];
          }

          // Only provide user information if the user is the current user, or a user which the current user can view.
          // When checking user_can_view_profile(), either:
          // If the page context is course, check the course context (from the page object) or;
          // If page context is NOT course, then check across all courses.
          $course = ($this->page->context->contextlevel == CONTEXT_COURSE) ? $this->page->course : null;

          if (user_can_view_profile($user, $course)) {
              // Use the user's full name if the heading isn't set.
              if (empty($heading)) {
                  $heading = fullname($user);
              }

              $imagedata = $this->user_picture($user, array('size' => 100));

              // Check to see if we should be displaying a message button.
              if (!empty($CFG->messaging) && has_capability('moodle/site:sendmessage', $context)) {
                  $userbuttons = array(
                      'messages' => array(
                          'buttontype' => 'message',
                          'title' => get_string('message', 'message'),
                          'url' => new moodle_url('/message/index.php', array('id' => $user->id)),
                          'image' => 'message',
                          'linkattributes' => \core_message\helper::messageuser_link_params($user->id),
                          'page' => $this->page
                      )
                  );

                  if ($USER->id != $user->id) {
                      $iscontact = \core_message\api::is_contact($USER->id, $user->id);
                      $contacttitle = $iscontact ? 'removefromyourcontacts' : 'addtoyourcontacts';
                      $contacturlaction = $iscontact ? 'removecontact' : 'addcontact';
                      $contactimage = $iscontact ? 'removecontact' : 'addcontact';
                      $userbuttons['togglecontact'] = array(
                              'buttontype' => 'togglecontact',
                              'title' => get_string($contacttitle, 'message'),
                              'url' => new moodle_url('/message/index.php', array(
                                      'user1' => $USER->id,
                                      'user2' => $user->id,
                                      $contacturlaction => $user->id,
                                      'sesskey' => sesskey())
                              ),
                              'image' => $contactimage,
                              'linkattributes' => \core_message\helper::togglecontact_link_params($user, $iscontact),
                              'page' => $this->page
                          );
                  }

                  $this->page->requires->string_for_js('changesmadereallygoaway', 'moodle');
              }
          } else {
              $heading = null;
          }
      }

      $prefix = null;
      if ($context->contextlevel == CONTEXT_MODULE) {
          if ($this->page->course->format === 'singleactivity') {
              $heading = format_string($this->page->course->fullname, true, ['context' => $context]);
          } else {
              $heading = $this->page->cm->get_formatted_name();
              $iconurl = $this->page->cm->get_icon_url();
              $iconclass = $iconurl->get_param('filtericon') ? '' : 'nofilter';
              $iconattrs = [
                  'class' => "icon activityicon $iconclass",
                  'aria-hidden' => 'true'
              ];
              $imagedata = html_writer::img($iconurl->out(false), '', $iconattrs);
              $purposeclass = plugin_supports('mod', $this->page->activityname, FEATURE_MOD_PURPOSE);
              $purposeclass .= ' activityiconcontainer';
              $purposeclass .= ' modicon_' . $this->page->activityname;
              $imagedata = html_writer::tag('div', $imagedata, ['class' => $purposeclass]);
              if (!empty($USER->editing)) {
                  $prefix = get_string('modulename', $this->page->activityname);
              }
          }
      }


      $contextheader = new \context_header($heading, $headinglevel, $imagedata, $userbuttons, $prefix);
      return $this->render_context_header($contextheader);
  }

   /**
      * Renders the header bar.
      *
      * @param context_header $contextheader Header bar object.
      * @return string HTML for the header bar.
      */
      protected function render_context_header(\context_header $contextheader) {

        // Generate the heading first and before everything else as we might have to do an early return.
        if (!isset($contextheader->heading)) {
            $heading = $this->heading($this->page->heading, $contextheader->headinglevel, 'h2');
        } else {
            $heading = $this->heading($contextheader->heading, $contextheader->headinglevel, 'h2');
        }

        // All the html stuff goes here.
        $html = html_writer::start_div('page-context-header');

        // Image data.
        if (isset($contextheader->imagedata)) {
            // Header specific image.
            $html .= html_writer::div($contextheader->imagedata, 'page-header-image mr-2');
        }

        // Headings.
        if (isset($contextheader->prefix)) {
            $prefix = html_writer::div($contextheader->prefix, 'text-muted text-uppercase small line-height-3');
            $heading = $prefix . $heading;
        }
        $html .= html_writer::tag('div', $heading, array('class' => 'page-header-headings'));

        // Buttons.
        if (isset($contextheader->additionalbuttons)) {
            $html .= html_writer::start_div('btn-group header-button-group');
            foreach ($contextheader->additionalbuttons as $button) {
                if (!isset($button->page)) {
                    // Include js for messaging.
                    if ($button['buttontype'] === 'togglecontact') {
                        \core_message\helper::togglecontact_requirejs();
                    }
                    if ($button['buttontype'] === 'message') {
                        \core_message\helper::messageuser_requirejs();
                    }
                    $image = $this->pix_icon($button['formattedimage'], $button['title'], 'moodle', array(
                        'class' => 'iconsmall',
                        'role' => 'presentation'
                    ));
                    $image .= html_writer::span($button['title'], 'header-button-title');
                } else {
                    $image = html_writer::empty_tag('img', array(
                        'src' => $button['formattedimage'],
                        'role' => 'presentation'
                    ));
                }
                $html .= html_writer::link($button['url'], html_writer::tag('span', $image), $button['linkattributes']);
            }
            $html .= html_writer::end_div();
        }
        $html .= html_writer::end_div();

        return $html;
    }
}
