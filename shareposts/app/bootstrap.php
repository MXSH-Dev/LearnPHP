<?php

// load configs
require_once('config/config.php');

// load helpers
require_once('helpers/url_helper.php');

// load session helper
require_once('helpers/session_helper.php');

// manual load libraries
// require_once('libraries/Core.php');
// require_once('libraries/Controller.php');
// require_once('libraries/Database.php');

// Autoload Core Libraries
spl_autoload_register(function ($classname) {
    require_once('libraries/' . $classname . '.php');
});
