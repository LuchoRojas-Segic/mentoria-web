<?php

namespace app\core\widgets;

class Form 
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">',$action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, string $attribute)
    {

        return new Field($model, $attribute);
    }
}