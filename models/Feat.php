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
            ['class_id', 'either', 'params' => ['other' => 'race_id']],
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

    public function either($attribute_name, $params)
    {
        $field1 = $this->getAttributeLabel($attribute_name);
        $field2 = $this->getAttributeLabel($params['other']);
        if (empty($this->$attribute_name) && empty($this->{$params['other']})) {
            $this->addError($attribute_name, "either {$field1} or {$field2} is required.");
        }
    }
}
