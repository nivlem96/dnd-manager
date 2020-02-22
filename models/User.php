<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;


    //TODO add registration function

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $command = Yii::app()->db->createCommand();
        return $command->select('*')->from('user')->where('id=:id', array(':id' => $id))->queryAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $command = Yii::app()->db->createCommand();
        return $command->select('*')->from('user')->where('accessToken=:token', array(':token' => $token))->queryAll();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $command = Yii::app()->db->createCommand();
        return $command->select('*')->from('user')->where('username=:username', array(':username' => $username))->queryAll();
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
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
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
