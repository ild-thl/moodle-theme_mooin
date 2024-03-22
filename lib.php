<?php
                                                      
defined('MOODLE_INTERNAL') || die();

function theme_mooinboost_get_main_scss_content($theme) {                                                                                
    global $CFG;                                                                                                                    
                                                                                                                                    
    $scss = '';        
    $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.                                        
    $pre = file_get_contents($CFG->dirroot . '/theme/mooinboost/scss/pre.scss');                                                         
    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.                                    
    $post = file_get_contents($CFG->dirroot . '/theme/mooinboost/scss/post.scss');                                                       
                                                                                                                                    
    // Combine them together.                                                                                                       
    return $pre . "\n" . $scss . "\n" . $post;                                                                                      
}