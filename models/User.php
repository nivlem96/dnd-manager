<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @var Campaign $campaigns
 * @var int      $id
 * @var string   $username
 * @var string   $password
 * @var string   $authKey
 * @var string   $accessKey
 * @var string   $created_at
 * @var string   $updated_at
 * @var int      $rank
 *
 * @package app\models
 *
 */
class User extends ActiveRecord implements IdentityInterface {
    const RANK_USER = 0;
    const RANK_MANAGER = 1;
    const RANK_ADMIN = 2;

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

    public static function getUserAvailableClass($id, $class) {
        return $class::find()
            ->where(['created_by_user_id' => $id])
            ->orWhere(['created_by_user_id' => null]);
    }

    public static function getUserAvailableClassArray($id, $class, $startEmpty = true) {
        $classes = User::getUserAvailableClass($id, $class)->all();
        $result = [];
        if ($startEmpty) {
            $result[null] = [''];
        }
        foreach ($classes as $class) {
            $result[$class->id] = $class->name;
        }
        return $result;
    }

    public static function getUserAvailableFeatsByRace($id, $race_id) {
        return Feat::find()
            ->where(['created_by_user_id' => $id])
            ->orWhere(['created_by_user_id' => null])
            ->andWhere(['race_id' => $race_id]);
    }

    public static function getUserAvailableSubRaces($id, $raceId) {
        return Race::find()
            ->where(['parent_id' => $raceId])
            ->andWhere(['created_by_user_id' => $id])
            ->orWhere(['created_by_user_id' => null]);
    }
}
