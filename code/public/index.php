<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\core\Application;


//echo __DIR__;
//echo "<br>";
//echo dirname(__DIR__);

/*$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DSN'],
        'user' => $_ENV['USERNAME'],
        'password' => $_ENV['PASSWORD'],
    ]
 ];*/

$app = new Application(dirname(__DIR__), $config);

/*$app->router->get('/','home');
$app->router->get('/contact', 'contact');
$app->router->post('/contact', function(){
    return "Procesando información";
});*/

$app->router->get('/',[\app\controllers\SiteController::class,'home']);//entrega el nombre completo de la clase
$app->router->get('/contact',[\app\controllers\SiteController::class,'contact']);//entrega el nombre completo de la clase
$app->router->post('/contact',[\app\controllers\SiteController::class,'handleContact']);//entrega el nombre completo de la clase

$app->router->get('/register',[\app\controllers\AuthController::class,'register']);//entrega el nombre completo de la clase
$app->router->post('/register',[\app\controllers\AuthController::class,'register']);//entrega el nombre completo de la clase
   
$app->router->get('/login',[\app\controllers\AuthController::class,'login']);//entrega el nombre completo de la clase
$app->router->post('/login',[\app\controllers\AuthController::class,'login']);//entrega el nombre completo de la clase
   
$app->run();