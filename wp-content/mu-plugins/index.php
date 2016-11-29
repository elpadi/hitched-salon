<?php
/*
Plugin Name: Site Base Code
Plugin URI: https://github.com/elpadi/wordpress-library
Description: Base code for the website.
Version: 1.0
Author: Carlos Padilla
Author URI: https://github.com/elpadi
License: GPLv3.0
*/
define('MU_SITE_CLASS_NAME', 'Hitched');
define('MU_PLUGINS_DIR', __DIR__);
require_once(dirname(ABSPATH).'/vendor/elpadi/wordpress-library/src/mu-plugins/index.php');
require_once(__DIR__.'/autoloader.php');
require_once(__DIR__.'/src/Hitched.php');
Hitched\Hitched::instance();
