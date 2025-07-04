<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\VarDumper;

class RegisterForm extends Model{

    // properties
    public $username;
    public $email;
    public $password;
    public $confirm_password;

    const STATUS_ACTIVE = 1; // Assuming you have a constant for active status
    const STATUS_INACTIVE = 0; // Assuming you have a constant for inactive status
    const STATUS_DELETED = 2; // Assuming you have a constant for deleted status

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

    public function register()
    {
        if ($this->validate()) {
            // Here you would typically save the user to the database
            // For example:
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            // $user->setPassword($this->password);
            $user->password = \Yii::$app->security->generatePasswordHash($this->password);
            $user->access_token =  \Yii::$app->security->generateRandomString();
            $user->status = RegisterForm::STATUS_ACTIVE; // Assuming you have a status field
            $user->created_at = date('Y-m-d H:i:s'); // Format the current date and time
            $user->updated_at = date('Y-m-d H:i:s'); // Format the current date and time
            $user->auth_key = \Yii::$app->security->generateRandomString();
            $status =  $user->save(); // Save the user to the database and return the status TRUE or FALSE
            
            if (!$status) {
                // Handle the error, e.g., log it or return an error message
                \Yii::error('User registration failed: ' . json_encode($user->getErrors()));

                // \Yii::error('User registration failed: ' . VarDumper::dumpAsString($user->errors)); // using VarDumper helper to dump as string
                return false; // Registration failed
            }

            return $status; // Simulating successful registration
        }
        return false; // Validation failed
    }

}