<?php
/**
 * SKEL is a ui managment library
 * @author Robert Landers (landers.robert@gmail.com)
 * @copyright 2012 GPLV2+
 * @package TheMap
 * @subpackage skel
 * @version 0.1
 */

if (!defined("WP_CONTENT_DIR")) exit();

class skel__skel
{
    /**
     * The configuration of skel stored
     */
    private $config;
    
    /**
     * Lays out the skel framework
     */
	function __construct()
    {
    	$this->config = apply_filters("themap(applyConfig)", array());
        echo "Incredible<pre>";
        var_dump($this->config);
        
        if (isset($this->config['config'])) {
            if (isset($this->config['config']['settings']) && $this->config['config']['settings']) {
                if (is_admin()) {
                    
                    //now we add a settings menu item
                    add_action('admin_menu', array($this, 'buildSettings'));
                }
            }
        }
        
        echo "</pre>";
    }
    
    /**
     * Displays the admin page for a given tab, and defaults to tab 0
     * Calls stuff
     */
    public function display() {
        if(!isset($_GET['tab']))
        {
            $_GET['tab'] = 1;
        }
        
        echo "viewing: " . $this->config['tabs'][0][1] . " <- here";
        $display = new $this->config['tabs'][0][1];
        $display->settings();
    }
    
    /**
     * Builds the settings menu stuff
     */
    public function buildSettings() {
        add_options_page($this->config['config']['page_title'], $this->config['config']['button_title'], 'manage_options', $this->config['config']['slug'], array($this, "display"));
    }
}
