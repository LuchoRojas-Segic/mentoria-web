<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function home()//Metodo
    {
        //return Application::$app->router->renderView('home');
        return $this->render('home');
    }

    public function contact()//Metodo
    {
        //return Application::$app->router->renderView('contact');
        return $this->render('contact');
    }    

    public function handleContact()//Metodo
    {
        return "Procesando información";
    }      
}