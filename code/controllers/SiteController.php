<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()//Metodo
    {
        /*$params = [
            'name'=> 'Juan',
            'surname' => 'Perez'
        ];*/
        //return Application::$app->router->renderView('home');
        //return $this->render('home', $params);
        return $this->render('home', [
            'name'=> 'Juan',
            'surname' => 'Perez'
        ]);
    }

    public function contact()//Metodo
    {
        //return Application::$app->router->renderView('contact');
        return $this->render('contact');
    }    

    //public function handleContact()//Metodo
    public function handleContact(Request $request)//Metodo
    {
        /*$body = Application::$app->request->getBody();
        var_dump($body);
        exit;*/
        $body = $request->getBody();
        var_dump($body);
        exit;
        return "Procesando información";
    }      
}