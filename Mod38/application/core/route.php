<?php

class Route
{
    public static function start()
    {
        // контроллер и действие по умолчанию
        $controller_filename = 'home';
        $model = null;
        $action_name = 'index';
        $action_id = '0';
        $routes = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);

        // var_dump($routes);
        // die();

        if (!empty($routes[1])) {
            $controller_filename = $routes[1];
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }
        // получаем id
        if (!empty($routes[3])) {
            $action_id = $routes[3];
        }

        // добавляем префиксы
        // $model_name = 'model_' . $controller_name;
        $controller_name = ucfirst($controller_filename) . 'Controller';
        // $action_name = 'action_' . $action_name;
        $model_name =  $controller_name;
        // $controller_name =  $controller_name;
        // $action_name = $action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = strtolower($model_name) . '.php';
        $model_path = MODEL . $model_file;
        if (file_exists($model_path)) {
            include_once MODEL . $model_file;
            die(var_dump($model));
            $model =  new $model_name;
        }
        
        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_filename) . '.php';
        $controller_path = CONTROLLER . $controller_file;
        
        if (file_exists($controller_path)) {
            include_once CONTROLLER . $controller_file;
        // die(var_dump($controller_file));
        } else {
            (new Route)->ErrorPage404();
        }
    
        // создаем контроллер
    
        $controller = new $controller_name($model);
        $action = $action_name;
        // die(var_dump($action));
        
        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action($action_id);
            
        // print_r($action_id);
        } else {
            die(var_dump($controller, $action));
            (new Route)->ErrorPage404();
        }
    }

    public function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'error');
    }
}
