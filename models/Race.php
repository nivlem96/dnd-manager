<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "race".
 *
 * @property int         $id
 * @property string      $name
 * @property string|null $description
 * @property int|null    $created_by_user_id
 *
 * @property Character[] $characters
 * @property Npc[]       $npcs
 * @property Feat[]      $feats
 */
class Race extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'race';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['created_by_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Characters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters() {
        return $this->hasMany(Character::className(), ['race_id' => 'id']);
    }

    /**
     * Gets query for [[Npcs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNpcs() {
        return $this->hasMany(Npc::className(), ['race_id' => 'id']);
    }

    /**
     * Gets query for [[Feats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeats() {
        return $this->hasMany(Feat::className(), ['race_id' => 'id']);
    }

    public static function getUserAvailableRaces($id) {
        return Race::find()
            ->where(['created_by_user_id' => $id])
            ->orWhere(['created_by_user_id' => null]);
    }
}
