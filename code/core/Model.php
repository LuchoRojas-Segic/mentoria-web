<?php

namespace app\core;

//No van a crearse objetos desde esta clase por el hecho de ser Abstract
abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL= 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value){
            if (property_exists($this, $key)){
                $this->$key = $value;
                //$this->firstname = "juan";
            }
        }
    }

    //Obliga a las clases hijas a utilizar si o si la siguiente función
    abstract public function rules(): array;

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules){
            $value = $this->$attribute; //$this->firstname
            foreach ($rules as $rule){
                $rulename = $rule;

                //!is     No es
                if (!is_string($rulename)){
                    $rulename = $rule[0];
                }

                if ($rulename === self::RULE_REQUIRED && !$value){
                    //agregar error
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
              
                if ($rulename === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    //agregar error
                    $this->addError($attribute, self::RULE_EMAIL);
                }    

                if ($rulename === self::RULE_MIN && strlen($value) < $rule['min']){
                    //agregar error
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }  

                if ($rulename === self::RULE_MAX && strlen($value) > $rule['max']){
                    //agregar error
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }  

                if ($rulename === self::RULE_MATCH && $value != $this->{$rule['match']}){
                    //agregar error
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }  
            }
        }

        return empty($this->errors);
    }
    public function addError($attribute, $rule, $params = [])
    {                                            //Si existe hace lo primero sino devuelvo un ''
        $message = $this->errorMessages()[$rule] ?? '';
        
        foreach ($params as $key => $param){
            //{{}} quita expresiones como las {}
            $message = str_replace("{{$key}}", $param, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return[
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be an email',
            self::RULE_MIN => 'Min length of the field must be {min}',
            self::RULE_MAX => 'Max length of the field must be {max}',
            self::RULE_MATCH => 'This fields must be same as {attribute}',
        ];
    }   
    
    public function hasError($attribute)
    {
        return isset($this->errors[$attribute][0]);
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}