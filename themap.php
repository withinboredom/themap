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

if (!defined("WP_CONTENT_DIR")) exit();

class TheMap_withinboredom {
    
    private $folders;
    
    public $settings;
    
    public function getFolders($folders )
    {
        return array_merge_recursive($this->folders, $folders);
    }
    
    public function applyConfig($config) {
        $config['tabs'] = array(
            0 => array( 'Settings', 'tabs__settings_withinboredom'),
            1 => array('About', 'tabs__about_withinboredom'),
            );
        $config['help'] = array(
            'settings' => array(
                    'Overview' => "Stuff here",
                )
            );
        $config['config'] = array(
                'settings' => true,
                'page_title' => 'TheMap',
                'button_title' => 'TheMap',
                'slug' => 'themap',
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
        
        spl_autoload_register(array($this, "autoload"));
        
        $this->settings = new skel__settings();
        
        $skel = new skel__skel();
    }
    
    static public function autoload($classname) {
        $file = str_replace("__", "/", $classname);
        $folders = apply_filters("themap(getFolders)", array());
        if (file_exists($folders['PluginDir'] . $file . ".php"))
            include_once($folders['PluginDir'] . $file . ".php");
        else
            echo "file no exists: " . $folders['PluginDir'] . $file . ".php\n";
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

//we don't want to autoload later on
//spl_autoload_unregister(array($GLOBALS['TheMap_withinboredom'], 'autoload'));