TheMap
======

TheMap is a project to create a physical site locator using Bing Maps as a wordpress plugin

Available hooks
===============

Filters
-------

* themap(getFolders) 
* * Gets an array containing the location of the plugin by directory and url
* themap(applyConfig)
* * Gets an array describing the configuration of the plugin
* themap(shortcode(themap))
* * answers to the shortcode "themap"
* themap(default_options)
* * loads the default options for the plugin if no options are set
* themap(getSettings)
* * Returns the settings for the plugin

Actions
-------
* themap(update)
* * Called when the plugin has been updated
* * takes two args (old_version, new_version)

Cool Features
=============
Uses autoloading

```php
static public function autoload($classname) {
    $file = str_replace("__", "/", $classname);
    $folders = apply_filters("themap(getFolders)", array());
    if (file_exists($folders['PluginDir'] . $file . ".php"))
        include_once($folders['PluginDir'] . $file . ".php");
}
```