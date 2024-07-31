<?php

                                                           
defined('MOODLE_INTERNAL') || die();

                                                                                          
$THEME->name = 'mooinboost';                                                                                                             
                                                                                                                                                                                                                                                       
$THEME->sheets = [];                                                                                                                
                                                                                                                                    
                                                               
$THEME->editor_sheets = [];                                                                                                         
                                                                      
$THEME->parents = ['boost'];                                                                                                        
                                                                                                                                                      
$THEME->enable_dock = false;                                                                                                        
                                                                                                                                                       
$THEME->yuicssmodules = array();                                                                                                    
                                                                                                                                                
$THEME->rendererfactory = 'theme_overridden_renderer_factory';                                                                      
                                                                                                                                               
$THEME->requiredblocks = '';   

$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;

$THEME->haseditswitch = true;

// $THEME->larrow = '<i class="bi bi-caret-left"></i>';
// $THEME->rarrow = '<i class="bi bi-caret-right-fill"></i>';

$THEME->scss = function($theme) {                                                                                                   
    return theme_mooinboost_get_main_scss_content($theme);                                                                               
};