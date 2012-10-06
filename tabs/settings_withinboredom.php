<?php
/**
 * Displays a settings page
 * @author Robert Landers (landers.robert@gmail.com)
 * @package TheMap
 * @version 0.1
 */

//do not allow hijackers
if (!defined("WP_CONTENT_DIR")) exit();

/**
 * This class handles display of all options
 */
class tabs__settings_withinboredom
{
	function __construct() {
        
    }
    
    // display admin stuff ...
    function settings() {
        echo "HELLO!!";
    }
}
