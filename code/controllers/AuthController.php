<?php

namespace app\controllers;
use app\core\Request;
use app\core\Controller;
use app\models\RegisterModel;


class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {       
        $this->setLayout('auth');
        $registerModel = new RegisterModel();

        if ($request->isPost()) { 
            
            //var_dump($request->getBody());

            $registerModel->loadData($request->getBody());  
            //var_dump($registerModel);

            if ($registerModel->validate() && $registerModel->save())  {
                return 'Success';
            }

            //return "Procesando datos del formulario";
            
        }    
        return $this->render('register', [
            'model' => $registerModel
        ]); 
    }

}