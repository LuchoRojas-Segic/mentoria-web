<?php

namespace app\models;

//use app\core\Model;
use app\core\DbModel;

//class RegisterModel extends Model
class RegisterModel extends DbModel
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function save()
    {   
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        //Llama al save del Padre
        return parent::save();
    }
//typeHint
//Se crea function rules y se devuelve un array
    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return [
            'firstname',
            'lastname',
            'email',
            'password'

        ];
    }

}