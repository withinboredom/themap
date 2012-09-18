<?php
/**
 * @package TheMap
 * @version 0.1
 * @author Robert Landers (landers.robert@gmail.com)
 */
/*
Plugin Name: TheMap
Plugin URI: http://wordpress.org/extend/plugins/themap/
Description: Display your multiple locations easily using Bing Maps
Author: withinboredom
Version: 0.1
Author URI: http://withinboredom.info
 */

class TheMap_withinboredom {
    
    private $folders;
    
    public function getFolders($folders )
    {
        return array_merge_recursive($this->folders, $folders);
    }
    
    public function applyConfig($config) {
        $config = array();
        $config['tabs'] = array(
            'settings' => 'settings.php',
            'about' => 'about.php',
            );
        $config['help'] = array(
            'settings' => array(
                    'Overview' => "Stuff here",
                )
            );
        $config['config'] = array(
                'settings' => true,
                'shortcodes' => array(
                    'themap'
                ),
            );
        return $config;
    }
    
    private function shortcode($atts) {
    }
    
    /**
     * Creates a map structure
     */
    function __construct() {
        $this->BuildFolderList();
        
        add_filter("themap(getFolders)", array(&$this, "getFolders"), 1);
        add_filter("themap(applyConfig)", array(&$this, "applyConfig"), 1);
        add_filter("themap(shortcode(themap))", array(&$this, "shortcode"), 1);
        
        require_once($this->folders['PluginDir'] . 'skel/skel.php');
        $skel = new skel_withinboredom();
    }
    
    private function BuildFolderList() {
        $this->folders = array();
        $this->folders['PluginDir'] = plugin_dir_path(__FILE__);
        $this->folders['PluginUrl'] = plugins_url('', __FILE__);
        $this->folders['PluginAdmin'] = admin_url() . 'admin.php?page=';
        $this->folders['Basename'] = plugin_basename(__FILE__);
    }
}

$GLOBALS['TheMap_withinboredom'] = new TheMap_withinboredom();