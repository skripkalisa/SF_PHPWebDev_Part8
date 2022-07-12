<?php

namespace App;

session_start();

require_once 'core/config.php';
require_once dirname(__DIR__, 1).'/vendor/autoload.php';
// require_once 'core/model.php';
// require_once 'core/view.php';
// require_once 'core/controller.php';
// require_once 'core/route.php';

require_once 'data/db.php';
// class_alias('\RedBeanPHP\R', '\R');
// use App\core\Controller;
// use App\core\Model;
// use App\core\View;

core\Route::start(); // запускаем маршрутизатор
