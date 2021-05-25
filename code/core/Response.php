<?php

namespace app\core;

class Response
{
    public function setStatusCode(int $code) //metodo
    {
        http_response_code($code);
    }
}