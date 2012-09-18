<?php
/**
 * SKEL is a ui managment library
 * @author Robert Landers (landers.robert@gmail.com)
 * @copyright 2012 GPLV2+
 * @package TheMap
 * @subpackage skel
 * @version 0.1
 */

class skel_withinboredom
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
            echo "Config is set\n";
            if (isset($this->config['config']['settings']) && $this->config['config']['settings']) {
                echo "Have settings\n";
                if (is_admin()) {
                    //only process settings stuff if this is a request for an admin page
                    echo "IS ADMIN\n";
                    
                }
            }
        }
        
        echo "</pre>";
    }
    
    /**
     * Builds the settings menu stuff
     */
    public function buildSettings() {
        
    }
}
