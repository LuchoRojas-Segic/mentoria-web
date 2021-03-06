<?php

namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public Request $request;
    public Router $router;
    public Response $response;
    public Controller $controller;
    public Database $db;

    public static Application $app;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this; //representa la instancia del objeto
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}