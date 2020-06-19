<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proficiency_relation".
 *
 * @property int $id
 * @property int|null $proficiency_id
 * @property int|null $class_id
 * @property int|null $background_id
 * @property int|null $choice
 *
 * @property Background $background
 * @property CharacterClass $class
 * @property Proficiency $proficiency
 */
class ProficiencyRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proficiency_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proficiency_id', 'class_id', 'background_id', 'choice'], 'integer'],
            [['background_id'], 'exist', 'skipOnError' => true, 'targetClass' => Background::className(), 'targetAttribute' => ['background_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => CharacterClass::className(), 'targetAttribute' => ['class_id' => 'id']],
            [['proficiency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proficiency::className(), 'targetAttribute' => ['proficiency_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proficiency_id' => 'Proficiency ID',
            'class_id' => 'Class ID',
            'background_id' => 'Background ID',
            'choice' => 'Choice',
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
     * Gets query for [[Proficiency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProficiency()
    {
        return $this->hasOne(Proficiency::className(), ['id' => 'proficiency_id']);
    }
}
