<?php

//do not allow hijackers
if (!defined("WP_CONTENT_DIR")) exit();

class skel__settings
{
    /**
     * This is the settings array (do not modify directly)
     * @var mixed $settings_array
     */
    private $settings_array;
    
    /**
     * The default starting location
     * @var string $default_location
     */
    public $default_location;
    
    /**
     * The saved version from the last time this plugin was loaded
     * @var string $version
     */
    public $version;
    
    /**
     * The version of this code
     */
    private $coded_version = "0.1";
    
    /**
     * Loads default options or gets them from the db if they already exist
     * @var mixed $default The default options to load
     * @return mixed The options from the db or the defaults
     */
    function options($default) {
        if (get_option("skel_themap_options", false) === false) {
            $default = array_merge_recursive($default, array(
                    "default_location" => "United States",
                    "version" => "0.0"
                ));
            return $default;
        }
        else {
            return get_option("skel_themap_options");
        }
    }
    
    /**
     * Reduces the class's settings to an array and returns them
     * @var mixed $settings Other settings to merge these with (for addons)
     * @return mixed The settings array
     */
    function getSettings($settings) {
        $this->reduceSettings();
        return array_merge_recursive($settings, $this->settings_array);
    }
    
    /**
     * Run update code here
     * @var string $version The version that was installed previously
     * @var string $coded_version The version that is currently running (or to update to)
     */
    function update($version, $coded_version) {
        //do update stuff here
    }
    
    /**
     * Create a settings class
     */
	function __construct() {
        //load all settings
        add_filter("themap(default_options)", array($this, "options"));
        add_action("themap(update)", array($this, "update"), 1, 2);
        add_filter("themap(getSettings)", array($this, "getSettings"));
        
        $this->settings_array = apply_filters("themap(default_options)", array());
        
        foreach ($this->settings_array as $setting => $setto) {
            $this->$setting = $setto;
        }
        
        if ($this->version != $this->coded_version) {
            do_action("themap(update)", $this->version, $this->coded_version);
            $this->version = $this->coded_version;
        }
        
        add_action("shutdown", array($this, "save"));
    }
    
    /**
     * Reduces all class vars into an array for saving or distribution
     */
    private function reduceSettings() {
        foreach ($this->settings_array as $setting => $setto) {
            $this->settings_array[$setting] = $this->$setting;
        }
    }
    
    /**
     * Reduces class vars and then saves them to the db
     */
    function save() {
        $this->reduceSettings();
        
        update_option("skel_themap_options", $this->settings_array);
    }
}
