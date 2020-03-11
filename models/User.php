<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @var Campaign $campaigns
 * @package app\models
 *
 */
class User extends ActiveRecord implements IdentityInterface {
    public $confirmPassword;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['username', 'password', 'confirmPassword'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['password', 'compare', 'compareAttribute' => 'confirmPassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return array|ActiveRecord
     * @throws \yii\db\Exception
     */
    public static function findByUsername($username) {
        return User::find()
            ->where(['username' => $username])
            ->one();
    }

    public function getCampaigns() {
        return $this->hasMany(Campaign::className(), ['dm_id' => 'id']);
    }

    public function getCharacters() {
        return $this->hasMany(Character::className(), ['player_id' => 'id']);
    }

    public function validatePassword($attribute, $params) {
        return true;
    }


    public function saveModel($data = []) {
        //because the hashes needs to match
        if (!empty($data['password']) && !empty($data['confirmPassword'])) {
            try {
                $data['authKey'] = Yii::$app->getSecurity()->generateRandomKey();
                $data['accessKey'] = Yii::$app->getSecurity()->generateRandomKey();
                $data['password'] = $data['confirmPassword'] = Yii::$app->getSecurity()->generatePasswordHash($data['password']);
            } catch (Exception $e) {
            }
        }
        $this->setAttributes($data);
        if ($this->validate()) {
            $this->save();
            return true;
        } else {
            var_dump($this->getErrors());
        }
    }
}
