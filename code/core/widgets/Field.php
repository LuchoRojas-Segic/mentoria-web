<?php

namespace app\core\widgets;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_MAIL = 'email';
    public const TYPE_PASSWORD = 'password';


    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attirbute = $attribute;
        $this->type = self::TYPE_TEXT;
    }

    public function __toString()
    {
        return sprintf('
        <div class="mb-3">
            <label class="form-label">%s</label>
            <input type="%s" name="%s" value ="%s" class="form-control %s>
    
            <div class="invalid-feedback">
             %s   
            </div>
    
        </div>
        ',
        $this->attribute,
        $this->type,
        $this->attribute,
        $this->model->{$this->attribute}, //$this->model->firtname
        $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        $this->model->getFirstError($this->attribute)
    );
    }
    public function passwordField()
    {
        $this->Type = self::TYPE_PASSWORD;
        return $this;
    }

    public function mailField
    {
        $this->Type = self::TYPE_MAIL;
        return $this;
    }
}
