<?php

define('ROOT', dirname(__DIR__, 2) . DIRECTORY_SEPARATOR);
define('APP', ROOT. 'app' . DIRECTORY_SEPARATOR);
define('CORE', ROOT. 'app' . DIRECTORY_SEPARATOR . 'core'. DIRECTORY_SEPARATOR);
define('DATA', ROOT. 'app' . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR);
define('MODEL', ROOT. 'app' . DIRECTORY_SEPARATOR . 'models'. DIRECTORY_SEPARATOR);
define('VIEW_MODEL', ROOT. 'app' . DIRECTORY_SEPARATOR . 'view_models'. DIRECTORY_SEPARATOR);
define('VIEW', ROOT. 'app' . DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT. 'app' . DIRECTORY_SEPARATOR . 'controllers'. DIRECTORY_SEPARATOR);
define('LAYOUT', VIEW .  'layout'. DIRECTORY_SEPARATOR);

$secret_word = 'woodchuck';
define('SECRET_WORD', $secret_word);

$passwordRegExp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
define('PASSWORD_REGEXP', $passwordRegExp);
