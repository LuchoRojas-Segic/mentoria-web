<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attributes(): array;

    public function save()
    {
        $pdo = Application::$app->db->pdo;
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr",$attributes);
        

        //INSERT INTO users () VALUES();
        $statement = $pdo->prepare("
            INSERT INTO $tableName
            (" . implode(",",$attributes) . ")
            VALUES
            (" . implode(",",$params) . ")
        ");

        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
            //$statement->bindParam
        }

        $statement->execute();
        return true;
    }
}