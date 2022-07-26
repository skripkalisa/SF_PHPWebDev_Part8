<?php

namespace App\core;

// include_once VIEW  .'auth/utils/formHandler.php';


define('CONTROLLERS_NAMESPACE', 'App\\controllers\\');

class Route
{
    public static function start()
    {
        // контроллер и действие по умолчанию
        $controlleClassname = 'home';
        $model = null;
        $actionName = 'index';
        $payload = [];
        $routes = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controlleClassname = $routes[1];
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }
        // получаем id
        if (!empty($routes[3])) {
            $payload = array_slice($routes, 2);
        }
        // (var_dump($payload));
        // добавляем префиксы
        $controllerName = CONTROLLERS_NAMESPACE . ucfirst($controlleClassname);
        // $controllerName = ucfirst($controllerFilename).'Controller';
        $modelName = $controllerName;

        // подцепляем файл с классом модели (файла модели может и не быть)
        $modelFile = strtolower($modelName).'.php';
        $modelPath = MODEL.$modelFile;
        if (file_exists($modelPath)) {
            include_once MODEL.$modelFile;
            $model = new $modelName();
        }

        // подцепляем файл с классом контроллера
        $controllerFile = ucfirst(strtolower($controlleClassname)).'.php';
        $controller_path = CONTROLLER.$controllerFile;

        if (file_exists($controller_path)) {
            include_once CONTROLLER.$controllerFile;
        } else {
            Route::ErrorPage404();
        }

        // создаем контроллер

        $controller = new  $controllerName($model);
        $action = $actionName;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action($payload);
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
