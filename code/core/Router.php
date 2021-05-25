<?php

namespace app\core;

class Router
{
    public Request $request;
    protected array $routes = [];

    public function __construct(\app\core\Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        /*echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';
        exit;*/

        $path  =$this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback  === false){
            Application::$app->response->setStatusCode(404);
            return "Not Found";                        
        }

        if (is_string($callback)){
            return $this->renderView($callback);
        }

        //print_r($this->routes);

        //var_dump($path);
        //var_dump($method);

        return call_user_func($callback);
    }
    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        include_once Application::$ROOT_DIR . "/views/$view.php";

        return str_replace('{{content}}', $viewContent, $layoutContent) ;

    }
    public function layoutContent() //metodo
    {
        ob_start(); //Se guarda el memoria temporal
        include_once Application::$ROOT_DIR . "/views/layouts/main.php"; 
        return ob_get_clean(); //la variables guardadas se limpian
    }
    public function renderOnlyView($view) //metodo
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";    
        return ob_get_clean();
    }
}