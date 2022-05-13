<?php
ini_set('display_errors', 1);

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT. 'app' . DIRECTORY_SEPARATOR);
define('MODEL', ROOT. 'app' . DIRECTORY_SEPARATOR . 'model'. DIRECTORY_SEPARATOR);
define('VIEW', ROOT. 'app' . DIRECTORY_SEPARATOR . 'view'. DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT. 'app' . DIRECTORY_SEPARATOR . 'controller'. DIRECTORY_SEPARATOR);
define('DATA', ROOT. 'app' . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR);
define('CORE', ROOT. 'app' . DIRECTORY_SEPARATOR . 'core'. DIRECTORY_SEPARATOR);

$modules = [ROOT,APP,CORE,CONTROLLER,DATA];

// set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));

spl_autoload_register(function ($class) use (&$modules) {
    foreach ($modules as $key => $value) {
        if (is_file($value. $class. '.php')) {
            require_once($value. $class. '.php');
        }
    }
});

new Application;
