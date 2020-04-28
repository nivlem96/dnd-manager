<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "default_skill".
 *
 * @property int $id
 * @property int $skill_id
 * @property int|null $race_id
 * @property int|null $class_id
 * @property int|null $background_id
 *
 * @property Background $background
 * @property CharacterClass $class
 * @property Race $race
 * @property Skill $skill
 */
class DefaultSkill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'default_skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skill_id'], 'required'],
            [['skill_id', 'race_id', 'class_id', 'background_id'], 'integer'],
            [['background_id'], 'exist', 'skipOnError' => true, 'targetClass' => Background::className(), 'targetAttribute' => ['background_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => CharacterClass::className(), 'targetAttribute' => ['class_id' => 'id']],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
            [['skill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['skill_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skill_id' => 'Skill ID',
            'race_id' => 'Race ID',
            'class_id' => 'Class ID',
            'background_id' => 'Background ID',
        ];
    }

    /**
     * Gets query for [[Background]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBackground()
    {
        return $this->hasOne(Background::className(), ['id' => 'background_id']);
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(CharacterClass::className(), ['id' => 'class_id']);
    }

    /**
     * Gets query for [[Race]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }

    /**
     * Gets query for [[Skill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id' => 'skill_id']);
    }
}
