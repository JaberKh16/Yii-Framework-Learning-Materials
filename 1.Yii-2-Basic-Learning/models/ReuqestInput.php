<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RequestInput extends Model{
    public $name;
    public $email;

    public function rules(){
        return [
            [["name", "email"],"required", "string"],
            [["email"],"email", "max"=> "50"],
        ];
    }
}