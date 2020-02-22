<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface {
    public $confirmPassword;


    //TODO add registration function


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
     * @throws \yii\db\Exception
     */
    public static function findIdentity($id) {
        $query = new Query;
        return $query->select('*')->from('user')->where('id=:id', [':id' => $id])->createCommand()->queryAll();
    }

    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        $query = new Query;
        return $query->select('*')->from('user')->where('accessToken=:token', [':token' => $token])->createCommand()->queryAll();
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
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return bool if password provided is valid for current user
     * @throws Exception
     */
    public function validatePassword($password) {
        try {
            $hash = $data['confirmPassword'] = Yii::$app->getSecurity()->generatePasswordHash($password);
            return Yii::$app->getSecurity()->validatePassword($password, $hash);
        } catch (Exception $e) {
        }
        return false;
    }


    public function saveModel($data = []) {
        //because the hashes needs to match
        if (!empty($data['password']) && !empty($data['confirmPassword'])) {
            try {
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
