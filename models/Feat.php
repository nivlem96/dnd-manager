<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feat".
 *
 * @property int            $id
 * @property string         $name
 * @property string|null    $description
 *
 * @property Race           $race
 * @property CharacterClass $class
 */
class Feat extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'feat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'unlocked_at' => 'Unlocked at level',
        ];
    }

    /**
     * Gets query for [[Race]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRace() {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass() {
        return $this->hasOne(CharacterClass::className(), ['id' => 'class_id']);
    }

    public static function getUserAvailableFeats($id) {
        return Feat::find()
            ->where(['created_by_user_id' => $id])
            ->orWhere(['created_by_user_id' => null]);
    }
}
