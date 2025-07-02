<?php

namespace app\models;

use yii\db\ActiveRecord;
use \yii\web\IdentityInterface; // Import IdentityInterface for user identity management

// change to ActiveRecord if you are using a database
// use yii\base\Model; // Uncomment if you are not using ActiveRecord
class User extends ActiveRecord implements IdentityInterface
{
    // public $id;
    // public $username;
    // public $password;
    // public $authKey;
    // public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    // table name is based on the class name by default in ActiveRecord
    // if you are using a different table name, you can override the tableName() method
    public static function tableName()
    {
        return 'users'; // Change this to your actual table name if using ActiveRecord
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::find()->where(['id' => $id])->one();
        // return self::findOne($id); // shorthand version
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // foreach (self::$users as $user) {
        //     if ($user['accessToken'] === $token) {
        //         return new static($user);
        //     }
        // }

        // return null;
        $usr_info = self::find()->where(['accessToken' => $token])->one();
        if ($usr_info) {
            return new static($usr_info);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        // foreach (self::$users as $user) {
        //     if (strcasecmp($user['username'], $username) === 0) {
        //         return new static($user);
        //     }
        // }

        // return null;
        $usr_info = self::findOne(['username' => $username]);
        // or you can use find()->where(['username' => $username])->one();
        // if you are using ActiveRecord, the above line will return an instance of User or null
        if ($usr_info) {
            return $usr_info; // return the ActiveRecord instance directly
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
