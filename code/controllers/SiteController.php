<?php

namespace app\controllers;

use app\core\Application;

class SiteController
{
    public function home()//Metodo
    {
        Application::$app->router->renderView('home');
    }
    
    public function contact()//Metodo
    {
        Application::$app->router->renderView('contact');
    }    

    public function handleContact()//Metodo
    {
        return "Procesando información";
    }  
}