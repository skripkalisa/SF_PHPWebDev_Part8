<?php

namespace App\core;

// use App\controllers\Home;
// use App\controllers\Webmaster;
// use App\controllers\Admin;
// use App\controllers\Error;
// use App\controllers\Auth;

define('CONTROLLERS_NAMESPACE', 'App\\controllers\\');

class Route
{
    public static function start()
    {
        // контроллер и действие по умолчанию
        $controller_classname = 'home';
        $model = null;
        $action_name = 'index';
        $action_id = '';
        $routes = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controller_classname = $routes[1];
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }
        // получаем id
        if (!empty($routes[3])) {
            $action_id = $routes[3];
        }
        // (var_dump($action_id));
        // добавляем префиксы
        $controller_name = CONTROLLERS_NAMESPACE . ucfirst($controller_classname);
        // $controller_name = ucfirst($controller_filename).'Controller';
        $model_name = $controller_name;

        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = strtolower($model_name).'.php';
        $model_path = MODEL.$model_file;
        if (file_exists($model_path)) {
            include_once MODEL.$model_file;
            $model = new $model_name();
        }

        // подцепляем файл с классом контроллера
        $controller_file = ucfirst(strtolower($controller_classname)).'.php';
        $controller_path = CONTROLLER.$controller_file;

        if (file_exists($controller_path)) {
            include_once CONTROLLER.$controller_file;
        } else {
            Route::ErrorPage404();
        }

        // создаем контроллер

        $controller = new  $controller_name($model);
        $action = $action_name;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action($action_id);
        } else {
            Route::ErrorPage404();
        }
    }

    public function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location:'.$host.'error');
    }
}
