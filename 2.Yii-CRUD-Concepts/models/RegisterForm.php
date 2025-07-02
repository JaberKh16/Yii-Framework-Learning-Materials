<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model{

    // properties
    public $username;
    public $email;
    public $password;
    public $confirm_password;

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'confirm_password'], 'required'],
            ['email', 'email'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
        ];
    }

}